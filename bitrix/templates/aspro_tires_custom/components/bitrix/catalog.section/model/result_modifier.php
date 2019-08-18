<?
	$sDiameterPropertyCode = $arParams["DIAMETER_PROPERTY"];
	$arItems=array();
	$arNoDiameterItems=array();
	
	foreach( $arResult["ITEMS"] as $arItem )
	{
		if ($arItem["DISPLAY_PROPERTIES"][$sDiameterPropertyCode]["VALUE"])
		{ $arItems[ (string)$arItem["DISPLAY_PROPERTIES"][$sDiameterPropertyCode]["VALUE"] ][] = $arItem; } 
		else { $arNoDiameterItems[] = $arItem; }
	}

	$arResult["ITEMS"] = $arItems;
	ksort($arResult["ITEMS"]);
	
	if ($arNoDiameterItems)
	{
		$arResult["ITEMS"]["NO_DIAMETER"]=$arNoDiameterItems;
	}

	$arResult["SECTION"] = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["ID"] ), false, array( "ID", "NAME", "SECTION_PAGE_URL", "DETAIL_PICTURE", "UF_FILES", "UF_VIDEO", "UF_VIDEO_YOUTUBE", "UF_MORE_FILES", "UF_DESCRIPTION", "IBLOCK_ID", "UF_SEZONNOST", "UF_SHIPY", "DESCRIPTION", "IBLOCK_SECTION_ID", "CODE" ))->GetNext();
?>