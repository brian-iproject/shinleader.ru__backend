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
	$arSections = array();
	foreach( $arResult["SECTIONS"] as $arSection )
	{ $arSections[$arSection["IBLOCK_SECTION_ID"]]["CHILD"][] = $arSection; }
	$arResult["SECTIONS"] = $arSections;
?>