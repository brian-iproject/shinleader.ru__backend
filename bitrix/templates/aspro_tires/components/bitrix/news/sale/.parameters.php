<?


$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arProperty = array();
$arIblocksFilter  = array();
if((IntVal($arCurrentValues["CATALOG_IBLOCK_ID1"]) > 0)||(IntVal($arCurrentValues["CATALOG_IBLOCK_ID2"]) > 0)||(IntVal($arCurrentValues["CATALOG_IBLOCK_ID3"]) > 0)||(IntVal($arCurrentValues["CATALOG_IBLOCK_ID4"]) > 0))
{
	if (IntVal($arCurrentValues["CATALOG_IBLOCK_ID1"]) > 0) $arIblocksFilter[] = $arCurrentValues["CATALOG_IBLOCK_ID1"];
	if (IntVal($arCurrentValues["CATALOG_IBLOCK_ID2"]) > 0) $arIblocksFilter[] = $arCurrentValues["CATALOG_IBLOCK_ID2"];
	if (IntVal($arCurrentValues["CATALOG_IBLOCK_ID3"]) > 0) $arIblocksFilter[] = $arCurrentValues["CATALOG_IBLOCK_ID3"];
	if (IntVal($arCurrentValues["CATALOG_IBLOCK_ID4"]) > 0) $arIblocksFilter[] = $arCurrentValues["CATALOG_IBLOCK_ID4"];
}

//if ($arIblocksFilter)
//{
	$arIBlock = array();
	$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_CATALOG_TYPE"], "ACTIVE"=>"Y"));
	while($arr=$rsIBlock->Fetch())
		$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	
	foreach($arIblocksFilter as $key=>$value)
	{
		$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("IBLOCK_ID"=>$value, "ACTIVE"=>"Y"));
		while ($arr=$rsProp->Fetch())
		{
			if($arr["PROPERTY_TYPE"] != "F")
				$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
		}
	}
	$arProperty_LNS = $arProperty;
//}



$arTemplateParameters = array(
	"SEZONNOST" => array(
		"NAME" => GetMessage("SEZONNOST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "SEZONNOST",
	),
	"SHIPY" => array(
		"NAME" => GetMessage("SHIPY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "SHIPY",
	),
	"CATALOG_FILTER_NAME" => Array(
		"NAME" => GetMessage("FILTER_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "arrProductsFilter",
	),
	"IBLOCK_CATALOG_TYPE" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_CATALOG_TYPE"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlockType,
		"REFRESH" => "Y",
	),
	"CATALOG_IBLOCK_ID1" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_IBLOCK"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlock,
		"REFRESH" => "Y",
	),
	"CATALOG_IBLOCK_ID2" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_IBLOCK"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlock,
		"REFRESH" => "Y",
	),
	"CATALOG_IBLOCK_ID3" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_IBLOCK"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlock,
		"REFRESH" => "Y",
	),
	"CATALOG_IBLOCK_ID4" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_IBLOCK"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlock,
		"REFRESH" => "Y",
	),
	"SHOW_BUY_BUTTONS" => array(
		"NAME" => GetMessage("SHOW_BUY_BUTTONS"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"USE_PRODUCT_QUANTITY" => array(
		"NAME" => GetMessage("USE_PRODUCT_QUANTITY"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>