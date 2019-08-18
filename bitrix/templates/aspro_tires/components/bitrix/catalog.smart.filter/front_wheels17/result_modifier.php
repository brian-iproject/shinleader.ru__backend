<?
foreach($arResult["ITEMS"] as $key => $arProperty){
	if(!empty($arProperty["VALUES"])){			
		if($arProperty["CODE"] == $arParams["POSADOCHNYY_DIAMETR_DISKA"]){
			$arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["SHIRINA_DISKA"]){
			$arResult["PROP"]["SHIRINA_DISKA"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["COUNT_OTVERSTIY"]){
			$arResult["PROP"]["COUNT_OTVERSTIY"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["MEZHBOLTOVOE_RASSTOYANIE"]){
			$arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"][] = $arProperty;
		}
		unset($arResult["ITEMS"][$key]);
	}
}
?>