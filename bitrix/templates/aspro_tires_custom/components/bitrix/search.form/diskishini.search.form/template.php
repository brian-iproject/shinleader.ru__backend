<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="search1">
	<input id="title-search-input" class="search_field1" type="text" name="q" placeholder="<?=GetMessage("placeholder")?>" autocomplete="off" />
	<input id="search-submit-button" type="submit" class="submit"/>	
	<?if ($arParams["USE_SEARCH_TITLE"]=="Y"):?>
		<div id="title-search"></div>
		<?$APPLICATION->IncludeComponent("bitrix:search.title", "", array(
			"NUM_CATEGORIES" => "1",
			"TOP_COUNT" => "5",
			"ORDER" => "date",
			"USE_LANGUAGE_GUESS" => "Y",
			"CHECK_DATES" => "Y",
			"SHOW_OTHERS" => "N",
			"PAGE" => "#SITE_DIR#catalog/search/index.php",
			"CATEGORY_0_TITLE" => GetMessage("CATEGORY_PRODUÑTCS_SEARCH_NAME"),
			"CATEGORY_0" => array(0 => "iblock_aspro_tires_catalog",),
			"CATEGORY_0_iblock_catalog" => array(0 => "all",),
			"SHOW_INPUT" => "N",
			"INPUT_ID" => "title-search-input",
			"CONTAINER_ID" => "title-search"
			),false,array("ACTIVE_COMPONENT" => "Y")
		);?>
	<?endif;?>
</form>