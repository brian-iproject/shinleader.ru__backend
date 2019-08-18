<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arCurrentValues["TYPE_FILTER"] == "wheels"){
	$arTemplateParameters["VYLET_DISKA_TYPE"] = array(
		"NAME" => GetMessage("VYLET_DISKA_TYPE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => array("RANGE" => GetMessage("VYLET_DISKA_TYPE_RANGE"), "EQUAL" => GetMessage("VYLET_DISKA_TYPE_EQUAL")),
		"DEFAULT" => "RANGE",
		"REFRESH" => "Y",
		"ADDITIONAL_VALUES" => "N",
		"PARENT" => "BASE",
	);

	if(!isset($arCurrentValues["VYLET_DISKA_TYPE"]) || $arCurrentValues["VYLET_DISKA_TYPE"] == "RANGE"){		
		$arTemplateParameters["VYLET_DISKA_RANGE_MIN"] = array(
			"NAME" => GetMessage("VYLET_DISKA_RANGE_MIN"),
			"TYPE" => "STRING",
			"DEFAULT" => "3",
			"ADDITIONAL_VALUES" => "N",
			"PARENT" => "BASE",
		);
		
		$arTemplateParameters["VYLET_DISKA_RANGE_MAX"] = array(
			"NAME" => GetMessage("VYLET_DISKA_RANGE_MAX"),
			"TYPE" => "STRING",
			"DEFAULT" => "3",
			"ADDITIONAL_VALUES" => "N",
			"PARENT" => "BASE",
		);
	}
	
	$arTemplateParameters["DIAMETR_STUPITSY_TYPE"] = array(
		"NAME" => GetMessage("DIAMETR_STUPITSY_TYPE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => array("RANGE" => GetMessage("DIAMETR_STUPITSY_TYPE_RANGE"), "EQUAL" => GetMessage("DIAMETR_STUPITSY_TYPE_EQUAL")),
		"DEFAULT" => "RANGE",
		"REFRESH" => "Y",
		"ADDITIONAL_VALUES" => "N",
		"PARENT" => "BASE",
	);
	
	if(!isset($arCurrentValues["DIAMETR_STUPITSY_TYPE"]) || $arCurrentValues["DIAMETR_STUPITSY_TYPE"] == "RANGE"){		
		$arTemplateParameters["DIAMETR_STUPITSY_RANGE_MIN"] = array(
			"NAME" => GetMessage("DIAMETR_STUPITSY_RANGE_MIN"),
			"TYPE" => "STRING",
			"DEFAULT" => "0",
			"ADDITIONAL_VALUES" => "N",
			"PARENT" => "BASE",
		);
		
		$arTemplateParameters["DIAMETR_STUPITSY_RANGE_MAX"] = array(
			"NAME" => GetMessage("DIAMETR_STUPITSY_RANGE_MAX"),
			"TYPE" => "STRING",
			"DEFAULT" => "10000",
			"ADDITIONAL_VALUES" => "N",
			"PARENT" => "BASE",
		);
	}
}
?>