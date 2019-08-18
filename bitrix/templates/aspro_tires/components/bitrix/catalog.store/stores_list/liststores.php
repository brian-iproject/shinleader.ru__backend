<?	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$dbProps = CCatalogStore::GetList(array('TITLE' => 'ASC', 'ID' => 'ASC'),array('ACTIVE' => 'Y'),false,false, array("ID"));	
	$currentStore = $dbProps->GetNext();
		$APPLICATION->IncludeComponent(
		"bitrix:catalog.store.detail",
		"store_detail",
		Array(
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"STORE" => $currentStore["ID"],
			"TITLE" => $arParams["TITLE"],
			"PATH_TO_ELEMENT" => $arResult["PATH_TO_ELEMENT"],
			"PATH_TO_LISTSTORES" => $arResult["PATH_TO_LISTSTORES"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"MAP_TYPE" => $arParams["MAP_TYPE"],
		),	$component
	);
?>
<hr />

