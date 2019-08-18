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
			if ($arProperty["CODE"] == $arParams["POSADOCHNYY_DIAMETR_DISKA"])
			{
				$arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"][] = $arProperty;
			} 
			elseif ($arProperty["CODE"] == $arParams["SHIRINA_DISKA"])
			{
				$arResult["PROP"]["SHIRINA_DISKA"][] = $arProperty;
			} 
			elseif ($arProperty["CODE"] == $arParams["COUNT_OTVERSTIY"])
			{
				$arResult["PROP"]["COUNT_OTVERSTIY"][] = $arProperty;
			}
			elseif ($arProperty["CODE"] == $arParams["MEZHBOLTOVOE_RASSTOYANIE"])
			{
				$arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"][] = $arProperty;
			}
			elseif ($arProperty["CODE"] == $arParams["DIAMETR_STUPITSY"])
			{
				$arResult["PROP"]["DIAMETR_STUPITSY"][] = $arProperty;
			} 
			elseif ($arProperty["CODE"] == $arParams["VYLET_DISKA"])
			{
				$arResult["PROP"]["VYLET_DISKA"][] = $arProperty;
			}
			elseif ($arProperty["CODE"] == $arParams["PROIZVODITEL"])
			{
				$arResult["PROP"]["PROIZVODITEL"][] = $arProperty;
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
