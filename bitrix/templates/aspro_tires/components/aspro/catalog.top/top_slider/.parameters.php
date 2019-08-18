<?
$arProperty = array();
$arIblocksFilter  = array();
if((IntVal($arCurrentValues["IBLOCK_ID1"]) > 0)||(IntVal($arCurrentValues["IBLOCK_ID2"]) > 0)||(IntVal($arCurrentValues["IBLOCK_ID3"]) > 0)||(IntVal($arCurrentValues["IBLOCK_ID4"]) > 0))
{
	if (IntVal($arCurrentValues["IBLOCK_ID1"]) > 0) $arIblocksFilter[] = $arCurrentValues["IBLOCK_ID1"];
	if (IntVal($arCurrentValues["IBLOCK_ID2"]) > 0) $arIblocksFilter[] = $arCurrentValues["IBLOCK_ID2"];
	if (IntVal($arCurrentValues["IBLOCK_ID3"]) > 0) $arIblocksFilter[] = $arCurrentValues["IBLOCK_ID3"];
	if (IntVal($arCurrentValues["IBLOCK_ID4"]) > 0) $arIblocksFilter[] = $arCurrentValues["IBLOCK_ID4"];
}

if ($arIblocksFilter)
{
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
}
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
	"FILTER_NAME" => Array(
		"NAME" => GetMessage("FILTER_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "arrTopFilter",
	),
);
?>