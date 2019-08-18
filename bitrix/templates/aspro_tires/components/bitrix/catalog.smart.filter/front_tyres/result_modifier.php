<?
foreach($arResult["ITEMS"] as $key => $arProperty){
	if(!empty($arProperty["VALUES"])){
		if($arProperty["CODE"] == $arParams["SHIRINA_PROFILYA"]){
			$arResult["PROP"]["SHIRINA_PROFILYA"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["VYSOTA_PROFILYA"]){
			$arResult["PROP"]["VYSOTA_PROFILYA"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["POSADOCHNYY_DIAMETR"]){
			$arResult["PROP"]["POSADOCHNYY_DIAMETR"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["SEZONNOST"]){
			$arResult["PROP"]["SEZONNOST"][] = $arProperty;
		}
		elseif($arProperty["CODE"] == $arParams["SHIPY"]){
			$arResult["PROP"]["SHIPY"][] = $arProperty;
		}
		unset($arResult["ITEMS"][$key]);
	}
}
?>