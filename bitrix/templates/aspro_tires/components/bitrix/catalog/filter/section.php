<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if($arResult['URL_TEMPLATES']['smart_filter'] && !$arResult['VARIABLES']['SMART_FILTER_PATH'] && strpos($arResult['VARIABLES']['SECTION_CODE_PATH'], 'filter/') !== false && strpos(
	// check smart filter path
	$arResult['VARIABLES']['SECTION_CODE_PATH'], '/apply') !== false){
	$arResult['VARIABLES']['SMART_FILTER_PATH'] = str_replace(array('filter/', '/apply'), '', $arResult['VARIABLES']['SECTION_CODE_PATH']);
	$arResult['VARIABLES']['SECTION_CODE_PATH'] = '';

	include 'sections.php';
}
else{
	header("Location: ".SITE_DIR."search/");
}
?>