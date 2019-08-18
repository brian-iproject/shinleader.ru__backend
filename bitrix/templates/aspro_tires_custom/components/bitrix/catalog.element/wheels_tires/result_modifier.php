<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	global $APPLICATION;
	
	$db_res = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"] ), false, array( "ID", "NAME", "SECTION_PAGE_URL", "DETAIL_PICTURE", "PICTURE", "UF_FILES", "UF_VIDEO", "UF_VIDEO_YOUTUBE", "UF_MORE_FILES", "UF_DESCRIPTION", "IBLOCK_ID", "UF_SEZONNOST", "UF_SHIPY", "DESCRIPTION", "IBLOCK_SECTION_ID", "CODE", "DEPTH_LEVEL" ))->GetNext();
	$arResult["SECTION_FULL"] = $db_res;
	
	$cp = $this->__component;
	if (is_object($cp))
	{
		$cp->arResult["SECTION_FULL"] =$db_res;
		$cp->SetResultCacheKeys("SECTION_FULL");
	}
	
	if($db_res["DEPTH_LEVEL"]==2)
	{
		$db_res = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $db_res["IBLOCK_SECTION_ID"] ), false, array( "ID", "NAME", "SECTION_PAGE_URL", "DETAIL_PICTURE", "PICTURE", "UF_FILES", "UF_VIDEO", "UF_VIDEO_YOUTUBE", "UF_MORE_FILES", "UF_DESCRIPTION", "IBLOCK_ID", "UF_SEZONNOST", "UF_SHIPY", "DESCRIPTION", "IBLOCK_SECTION_ID", "CODE", "DEPTH_LEVEL" ))->GetNext();
	}	

	
	$arResult["PROPERTIES"]["PROIZVODITEL"]["VALUE"] = $db_res;
	$arResult["PROPERTIES"]["PROIZVODITEL"]["NAME"] = $db_res["NAME"];
	if ($db_res["DETAIL_PICTURE"]){$image = $db_res["DETAIL_PICTURE"];}
	elseif ($db_res["PICTURE"]){$image = $db_res["PICTURE"];}
	$img = CFile::ResizeImageGet( $image, array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );
	$arResult["PROPERTIES"]["PROIZVODITEL"]["SRC"] = $img['src'];
	$arResult["PROPERTIES"]["PROIZVODITEL"]["LINK"] = $db_res["SECTION_PAGE_URL"];	
	
	$db_res = CCatalogStore::GetList(array(), array("ACTIVE" => "Y"), false, false, array());
	$arStores = array();
	while ($res = $db_res-> GetNext()) { $arStores = $res;}	
	$arResult["STORES_COUNT"] = count($arStores);
?>

