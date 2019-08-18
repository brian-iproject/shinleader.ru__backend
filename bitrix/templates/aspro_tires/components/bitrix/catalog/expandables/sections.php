<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if ($arParams["USE_FILTER"]=="Y"){?>
	<?if(CSite::InDir(SITE_DIR.'search/accumulators')||CSite::InDir(SITE_DIR.'catalog/accumulators')):?>
		<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_accumulators17", array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => "",
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => "N",
			"SAVE_IN_SESSION" => "N",
			"INSTANT_RELOAD" => "Y",
			"PRICE_CODE" => array(
			),
			"EMKOST" => $arParams["EMKOST"],
			"POLARNOST" => $arParams["POLARNOST"],
			"KLEMMY" => $arParams["KLEMMY"],
			"PROIZVODITEL" => $arParams["PROIZVODITEL"],
			"SEF_MODE" => (strlen($arResult["URL_TEMPLATES"]["smart_filter"]) ? "Y" : "N"),
			"SEF_RULE" => str_replace('catalog', 'search', $arResult["FOLDER"]).$arResult["URL_TEMPLATES"]["smart_filter"],
			"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
			),
			false
		);?>
	<?endif;?>
<?}?>


<div class="manufacturers-about">
	<?$APPLICATION->IncludeFile(SITE_DIR."include/catalog_about.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("ABOUT_CATALOG")));?>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"manufacturers",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	), $component
);?>