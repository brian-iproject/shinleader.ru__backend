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
	"POSADOCHNYY_DIAMETR_DISKA" => array(
		"NAME" => GetMessage("POSADOCHNYY_DIAMETR_DISKA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "POSADOCHNYY_DIAMETR_DISKA",
	),
	"SHIRINA_DISKA" => array(
		"NAME" => GetMessage("SHIRINA_DISKA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "SHIRINA_DISKA",
	),
	"COUNT_OTVERSTIY" => array(
		"NAME" => GetMessage("COUNT_OTVERSTIY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "COUNT_OTVERSTIY",
	),
	"DIAMETR_STUPITSY" => array(
		"NAME" => GetMessage("DIAMETR_STUPITSY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "DIAMETR_STUPITSY",
	),
	"MEZHBOLTOVOE_RASSTOYANIE" => array(
		"NAME" => GetMessage("MEZHBOLTOVOE_RASSTOYANIE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "MEZHBOLTOVOE_RASSTOYANIE",
	),
	"VYLET_DISKA" => array(
		"NAME" => GetMessage("VYLET_DISKA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "VYLET_DISKA",
	),
	"SHIRINA_PROFILYA" => array(
		"NAME" => GetMessage("SHIRINA_PROFILYA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "SHIRINA_PROFILYA",
	),
	"VYSOTA_PROFILYA" => array(
		"NAME" => GetMessage("VYSOTA_PROFILYA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "VYSOTA_PROFILYA",
	),
	"POSADOCHNYY_DIAMETR" => array(
		"NAME" => GetMessage("POSADOCHNYY_DIAMETR"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "POSADOCHNYY_DIAMETR",
	),
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
	"RUN_ON_FLAT" => array(
		"NAME" => "Run on flat",
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		"DEFAULT" => "RUN_ON_FLAT",
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
);
?>