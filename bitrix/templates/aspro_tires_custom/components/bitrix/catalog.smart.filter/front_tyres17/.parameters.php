<?

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ID" => $arCurrentValues["IBLOCK_ID"], "ACTIVE"=>"Y"));

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
	"SHIRINA_PROFILYA" => array(
		"NAME" => GetMessage("SHIRINA_PROFILYA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "SHIRINA_PROFILYA",
	),
	"VYSOTA_PROFILYA" => array(
		"NAME" => GetMessage("VYSOTA_PROFILYA"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "VYSOTA_PROFILYA",
	),
	"POSADOCHNYY_DIAMETR" => array(
		"NAME" => GetMessage("POSADOCHNYY_DIAMETR"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "POSADOCHNYY_DIAMETR",
	),
	"SEZONNOST" => array(
		"NAME" => GetMessage("SEZONNOST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "SEZONNOST",
	),
	"SHIPY" => array(
		"NAME" => GetMessage("SHIPY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "SHIPY",
	),
	"RUN_ON_FLAT" => array(
		"NAME" => "Run on flat",
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "RUN_ON_FLAT",
	),
);
?>