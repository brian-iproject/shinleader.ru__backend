<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if($_POST["CLEAR_ALL"]=="Y"){
	Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("basket-allitems-block");
	\Bitrix\Main\Loader::includeModule('sale');
	$dbBasketItems = CSaleBasket::GetList(array("NAME" => "ASC", "ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false, array("ID", "PRODUCT_ID", "DELAY", "SUBSCRIBE", "CAN_BUY"));
	$basket_items=$delay_items=$arDelItems=array();
	$arItems = array();
	while($arBasketItems = $dbBasketItems->GetNext()){
		if($arBasketItems["DELAY"]=="N" && $arBasketItems["CAN_BUY"] == "Y" && $arBasketItems["SUBSCRIBE"] == "N"){
			$arItems["BASKET"][] = $arBasketItems["ID"];
		}
		elseif($arBasketItems["DELAY"]=="Y" && $arBasketItems["CAN_BUY"] == "Y" && $arBasketItems["SUBSCRIBE"] == "N"){
			$arItems["DELAY"][]  = $arBasketItems["ID"];
		}elseif($arBasketItems["SUBSCRIBE"]=="Y"){
			$arItems["SUBSCRIBE"][] = $arBasketItems["ID"];
		}else{
			$arItems["NOT_AVAILABLE"][] = $arBasketItems["ID"];
		}
	}
	$type="BASKET";
	if(isset($_POST["TYPE"]) && $_POST["TYPE"]){
		switch ($_POST["TYPE"]) {
			case 2:
				$type="DELAY";
				break;
			case 3:
				$type="SUBSCRIBE";
				break;
			case 4:
				$type="NOT_AVAILABLE";
				break;
			default:

				break;
		}
	}

	if($_POST["TYPE"]=="delay"){
		$arDelItems=$delay_items;
	}else{
		$arDelItems=$basket_items;
	}
	if($arItems[$type]){
		foreach($arItems[$type] as $id){
			CSaleBasket::Delete($id);
		}
	}
	Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket-allitems-block", "");
}elseif($_POST["ID"]){
	\Bitrix\Main\Loader::includeModule('sale');
	CSaleBasket::Delete($_POST["ID"]);
}?>