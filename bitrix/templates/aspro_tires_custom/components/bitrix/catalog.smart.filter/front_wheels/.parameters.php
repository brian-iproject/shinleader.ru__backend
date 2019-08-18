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
	"POSADOCHNYY_DIAMETR_DISKA" => array(
		"NAME" => GetMessage("POSADOCHNYY_DIAMETR_DISKA"),
		"TYPE" => "LIST",
		"VALUES" => $arProperty_LNS,
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "POSADOCHNYY_DIAMETR_DISKA",
	),
	"SHIRINA_DISKA" => array(
		"NAME" => GetMessage("SHIRINA_DISKA"),
		"TYPE" => "LIST",
		"VALUES" => $arProperty_LNS,
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "SHIRINA_DISKA",
	),
	"COUNT_OTVERSTIY" => array(
		"NAME" => GetMessage("COUNT_OTVERSTIY"),
		"TYPE" => "LIST",
		"VALUES" => $arProperty_LNS,
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "COUNT_OTVERSTIY",
	),
	"MEZHBOLTOVOE_RASSTOYANIE" => array(
		"NAME" => GetMessage("MEZHBOLTOVOE_RASSTOYANIE"),
		"TYPE" => "LIST",
		"VALUES" => $arProperty_LNS,
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "MEZHBOLTOVOE_RASSTOYANIE",
	),
);
?>