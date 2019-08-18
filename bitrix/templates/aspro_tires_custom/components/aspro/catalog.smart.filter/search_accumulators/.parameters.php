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
	"EMKOST" => array(
		"NAME" => GetMessage("EMKOST"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "EMKOST",
	),
	"POLARNOST" => array(
		"NAME" => GetMessage("POLARNOST"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "POLARNOST",
	),
	"KLEMMY" => array(
		"NAME" => GetMessage("KLEMMY"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "KLEMMY",
	),	
	"PROIZVODITEL" => array(
		"NAME" => GetMessage("PROIZVODITEL"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"DEFAULT" => "PROIZVODITEL",
	),
);
?>