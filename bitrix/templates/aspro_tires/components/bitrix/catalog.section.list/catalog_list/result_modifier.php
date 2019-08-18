<?
	if (!function_exists('sort_sections'))
	{
		function sort_sections( $arr )
		{
			$count = count( $arr );
			for( $i = 0; $i < $count; $i++ ){
				for( $j = 0; $j < $count; $j++ ){
					if( strtoupper($arr[$i]["NAME"]) < strtoupper($arr[$j]["NAME"]) ){
						$tmp = $arr[$i];
						$arr[$i] = $arr[$j];
						$arr[$j] = $tmp;
					}
				}
			}
			return $arr;
		}
	}
	$arResult["SECTIONS"] = sort_sections( $arResult["SECTIONS"] );
?>

<?
$countR=count($arResult["SECTIONS"]);
$arParams["PAGE"]=($arParams["PAGE"]!='')?$arParams["PAGE"]:'1';
$page=intval($arParams["PAGE"]);
$arSection=array();
//print_r($arParams);
$limit = $countR < $page * $arParams["SECTION_PAGE_ELEMENT"] ? $countR : $page * $arParams["SECTION_PAGE_ELEMENT"];

for( $i = ($page - 1) * $arParams["SECTION_PAGE_ELEMENT"]; $i < $limit; $i++ ){
	$arSection[] = $arResult["SECTIONS"][$i];
}

$arResult["COUNTS_SECTION"]=$countR;
$arResult["SECTIONS"]=$arSection;

?>