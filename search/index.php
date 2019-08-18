<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Каталог");
?>
<div class="manufacturers-about">
	<?$APPLICATION->IncludeFile(SITE_DIR."include/catalog_about.php", Array(), Array("MODE" => "html", "NAME"  => "О каталоге"));?> 
</div>
<?$APPLICATION->IncludeComponent(
	"aspro:catalog.section.list",
	"all_sections",
	Array(
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID1" => "1",
		"IBLOCK_ID2" => "2",
		"IBLOCK_ID3" => "3",
		"IBLOCK_ID4" => "4",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y"
	)
);?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>