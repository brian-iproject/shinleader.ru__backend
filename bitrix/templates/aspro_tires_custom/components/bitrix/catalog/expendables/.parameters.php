<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arProperty = array();
if (0 < intval($arCurrentValues["IBLOCK_ID"]))
{
	$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"], "ACTIVE"=>"Y"));
	while ($arr=$rsProp->Fetch())
	{
		if($arr["PROPERTY_TYPE"] != "F")
			$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}
$arProperty_LNS = $arProperty;


$arTemplateParameters = array(

    "MAX_COUNT" => array(
        "NAME" => GetMessage("MAX_BASKET_PRODUCTS"),
        "TYPE" => "STRING",
		"DEFAULT" => "0",
    ),
	"DEFAULT_COUNT" => array(
        "NAME" => GetMessage("DEFAULT_BASKET_PRODUCTS"),
        "TYPE" => "STRING",
		"DEFAULT" => "4",
    ),
	"SECTION_PAGE_ELEMENT" => array(
			"PARENT" => "SECTIONS_SETTINGS",
			"NAME" => GetMessage("SECTION_PAGE_ELEMENT"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
	),
	"USE_RATING" => array(
			"NAME" => GetMessage("USE_RATING"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
	),	
	"MAIN_TITLE_LIST" => array(
		"NAME" => GetMessage("MAIN_TITLE_LIST"),
		"PARENT" => "STORE_SETTINGS",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => GetMessage("MAIN_TITLE_LIST_DEFAULT"),
	),
	"MAX_AMOUNT" => array(
		"NAME" => GetMessage("MAX_AMOUNT"),
		"PARENT" => "STORE_SETTINGS",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "20",
	),
	
	"USE_ONLY_MAX_AMOUNT" => array(
		"NAME" => GetMessage("USE_ONLY_MAX_AMOUNT"),
		"PARENT" => "STORE_SETTINGS",
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "Y",
	),
	"PROIZVODITEL" => array(
		"NAME" => GetMessage("PROIZVODITEL"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "PROIZVODITEL",
	),
	"EMKOST" => array(
		"NAME" => GetMessage("EMKOST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "EMKOST",
	),
	"POLARNOST" => array(
		"NAME" => GetMessage("POLARNOST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "POLARNOST",
	),
	"KLEMMY" => array(
		"NAME" => GetMessage("KLEMMY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "KLEMMY",
	),	
	"SEF_FOLDER_CATALOG" => array(
		"NAME" => GetMessage("SEF_FOLDER_CATALOG"),
		"PARENT" => "SEF_MODE",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "",
	),
	"LIST_DISPLAY_POPUP_IMAGE" => array(
		"NAME" => GetMessage("LIST_DISPLAY_POPUP_IMAGE"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "Y",
	),
	"LIST_DEFAULT_CATALOG_TEMPLATE" => array(
		"NAME" => GetMessage("LIST_DEFAULT_CATALOG_TEMPLATE"),
		"PARENT" => "LIST_SETTINGS",
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array("BLOCK" => GetMessage("LIST_DEFAULT_CATALOG_TEMPLATE_BLOCK"), "LIST" => GetMessage("LIST_DEFAULT_CATALOG_TEMPLATE_LIST")),
		"DEFAULT" => "BLOCK",
	),
	"PROIZVODITEL" => array(
		"NAME" => GetMessage("PROIZVODITEL"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "PROIZVODITEL",
	),
	"SKU_DISPLAY_LOCATION" => Array(
		"NAME" => GetMessage("SKU_DISPLAY_LOCATION"),
		"TYPE" => "LIST",
		"VALUES" => array("RIGHT"=>GetMessage("SKU_DISPLAY_LOCATION_RIGHT"), "BOTTOM"=>GetMessage("SKU_DISPLAY_LOCATION_BOTTOM")),
		"DEFAULT" => "RIGHT",
		"PARENT" => "DETAIL_SETTINGS",
	),
);
?>