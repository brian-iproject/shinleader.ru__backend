<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->IncludeComponent("aspro:auto.list",
	$_REQUEST["template"],
	array(
		"AUTO_MARK" => $_REQUEST["car"],
		"AUTO_MODEL" => $_REQUEST["model"],
		"AUTO_YEAR" => $_REQUEST["year"],
		"AUTO_COMPLECT" => $_REQUEST["modification"],
		"TYPE_FILTER" => $_REQUEST["type_filter"],
		"INSTANT_RELOAD" => $_REQUEST["instant_reload"],
		"VYLET_DISKA_TYPE" => $_REQUEST["VYLET_DISKA_TYPE"],
		"VYLET_DISKA_RANGE_MIN" => $_REQUEST["VYLET_DISKA_RANGE_MIN"],
		"VYLET_DISKA_RANGE_MAX" => $_REQUEST["VYLET_DISKA_RANGE_MAX"],
		"DIAMETR_STUPITSY_TYPE" => $_REQUEST["DIAMETR_STUPITSY_TYPE"],
		"DIAMETR_STUPITSY_RANGE_MIN" => $_REQUEST["DIAMETR_STUPITSY_RANGE_MIN"],
		"DIAMETR_STUPITSY_RANGE_MAX" => $_REQUEST["DIAMETR_STUPITSY_RANGE_MAX"],
	)
);?>