<?
	if (!function_exists('declOfNum')) 
	{
		function declOfNum($number, $titles)
		{
			$cases = array (2, 0, 1, 1, 1, 2);
			return sprintf($titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ], $number);
		}
	}
	
	foreach($arResult["ITEMS"] as $key => $arProperty)
	{
	
		if( !empty( $arProperty["VALUES"] ))
		{			
			if ($arProperty["CODE"] == $arParams["PROIZVODITEL"])
			{
				$arResult["PROP"]["PROIZVODITEL"][] = $arProperty;
			}			
			elseif ($arProperty["CODE"] == $arParams["EMKOST"])
			{
				$arResult["PROP"]["EMKOST"][] = $arProperty;
			}				
			elseif ($arProperty["CODE"] == $arParams["POLARNOST"])
			{
				$arResult["PROP"]["POLARNOST"][] = $arProperty;
			}					
			elseif ($arProperty["CODE"] == $arParams["KLEMMY"])
			{
				$arResult["PROP"]["KLEMMY"][] = $arProperty;
			}			
			unset( $arResult["ITEMS"][$key] );
		}
	}
	
	
	if (!CSite::InDir(SITE_DIR.'catalog'))
	{
		$arFilter = array_merge(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "IBLOCK_LID" => SITE_ID,	"IBLOCK_ACTIVE" => "Y",	"ACTIVE" => "Y"), $GLOBALS["arrFilter"]);
		$arResult["FINDED_COUNT"] = CIBlockElement::GetList( array("SORT"=>"ASC"), $arFilter, false, false, array("ID"))->SelectedRowsCount();
	}
?>
