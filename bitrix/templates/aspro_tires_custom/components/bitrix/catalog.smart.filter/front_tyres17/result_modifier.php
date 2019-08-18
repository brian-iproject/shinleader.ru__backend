<?
$arParams["RUN_ON_FLAT"]=(isset($arParams["RUN_ON_FLAT"]) && $arParams["RUN_ON_FLAT"] ? $arParams["RUN_ON_FLAT"] : "");
foreach($arResult["ITEMS"] as $key => $arItem){
	if( !empty( $arItem["VALUES"] ) && ( $arItem["CODE"] == 'SHIRINA_PROFILYA' || $arItem["CODE"] == 'VYSOTA_PROFILYA' || $arItem["CODE"] == 'POSADOCHNYY_DIAMETR' || $arItem["CODE"] == 'SEZONNOST' || $arItem["CODE"] == 'SHIPY' || $arItem["CODE"] == $arParams["RUN_ON_FLAT"] ) ){
		if ($arItem["CODE"] == $arParams["RUN_ON_FLAT"]){
			$arFormatProperty=array();
			foreach($arItem["VALUES"] as $key=>$arValue){
				if(CTires::isTrue($arValue["VALUE"])){
					$arFormatProperty=$arValue;
					break;
				}
			}
			$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"] = $arItem["NAME"];
			$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"] = $arFormatProperty;
		}else{
			$arResult["PROP"][$arItem["CODE"]][] = $arItem;
		}
		unset( $arResult["ITEMS"][$key] );
	}
}?>