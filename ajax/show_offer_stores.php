<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?if ($_REQUEST["ID"]):?>
	<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "product_stores_amount_popup", array(
			"PER_PAGE" => "10",
			"USE_STORE_PHONE" => $_REQUEST["USE_STORE_PHONE"],
			"SCHEDULE" => $_REQUEST["SCHEDULE"],
			"USE_MIN_AMOUNT" => $_REQUEST["USE_MIN_AMOUNT"],
			"MIN_AMOUNT" => $_REQUEST["MIN_AMOUNT"],
			"ELEMENT_ID" => $_REQUEST["ID"],
			"STORE_PATH"  =>  $_REQUEST["STORE_PATH"],
			"MAIN_TITLE"  =>  $_REQUEST["MAIN_TITLE"],
			"MAX_AMOUNT"=>$_REQUEST["MAX_AMOUNT"],
			"USE_ONLY_MAX_AMOUNT" => $_REQUEST["USE_ONLY_MAX_AMOUNT"],
		),
		$component
	);?>
<?endif;?>