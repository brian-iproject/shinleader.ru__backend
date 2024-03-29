<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Купить авторезину в интернет-магазине, цена на автопокрышки (автошины) в Москве");
$APPLICATION->SetTitle("Шины");
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"wheels_tires", 
	array(
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID" => "1",
		"HIDE_NOT_AVAILABLE" => "N",
		"BASKET_URL" => "/basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/catalog/tires/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "BASE",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"USE_REVIEW" => "Y",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "N",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "N",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_PROPERTIES" => array(
			0 => "SEZONNOST",
			1 => "SHIPY",
		),
		"USE_PRODUCT_QUANTITY" => "Y",
		"CONVERT_CURRENCY" => "N",
		"QUANTITY_FLOAT" => "N",
		"OFFERS_CART_PROPERTIES" => "",
		"SHOW_TOP_ELEMENTS" => "N",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_TOP_DEPTH" => "1",
		"SECTION_PAGE_ELEMENT" => "10",
		"PAGE_ELEMENT_COUNT" => "200",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "PROPERTY_POSADOCHNYY_DIAMETR",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "VYSOTA_PROFILYA",
			1 => "POSADOCHNYY_DIAMETR",
			2 => "SEZONNOST",
			3 => "SHIRINA_PROFILYA",
			4 => "SHIPY",
			5 => "NOVINKA",
			6 => "AKTSIYA",
			7 => "KHIT_PRODAZH",
			8 => "MEZHBOLTOVOE_RASSTOYANIE",
			9 => "POSADOCHNYY_DIAMETR_DISKA",
			10 => "SHIRINA_DISKA",
			11 => "REST",
			12 => "DESCRIPTION",
			13 => "NEW",
			14 => "HIT",
			15 => "SPIKES",
			16 => "FILES",
			17 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "UF_SEO_KEYWORDS",
		"LIST_META_DESCRIPTION" => "UF_SEO_DESCRIPTION",
		"LIST_BROWSER_TITLE" => "UF_SEO_TITLE",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "5",
		"LIST_DISPLAY_POPUP_IMAGE" => "Y",
		"LIST_DEFAULT_CATALOG_TEMPLATE" => "BLOCK",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "VYSOTA_PROFILYA",
			1 => "RUNFLAT",
			2 => "RELATED_ITEMS",
			3 => "POSADOCHNYY_DIAMETR",
			4 => "SEZONNOST",
			5 => "SHIRINA_PROFILYA",
			6 => "SHIPY",
			7 => "NOVINKA",
			8 => "AKTSIYA",
			9 => "KHIT_PRODAZH",
			10 => "VYLET_DISKA",
			11 => "MEZHBOLTOVOE_RASSTOYANIE",
			12 => "POSADOCHNYY_DIAMETR_DISKA",
			13 => "SHIRINA_DISKA",
			14 => "NEW",
			15 => "HIT",
			16 => "SPIKES",
			17 => "",
		),
		"DETAIL_META_KEYWORDS" => "SEO_KEYWORDS",
		"DETAIL_META_DESCRIPTION" => "SEO_DESCRIPTION",
		"DETAIL_BROWSER_TITLE" => "SEO_TITLE",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"LINK_IBLOCK_TYPE" => "aspro_tires_catalog",
		"LINK_IBLOCK_ID" => "1",
		"LINK_PROPERTY_SID" => "RELATED_ITEMS",
		"LINK_ELEMENTS_URL" => "",
		"USE_ALSO_BUY" => "N",
		"USE_STORE" => "Y",
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "4",
		"STORE_PATH" => "/contacts/#store_id#/",
		"MAIN_TITLE" => "Наличие на складах",
		"MAIN_TITLE_LIST" => "Наличие",
		"MAX_AMOUNT" => "8",
		"USE_ONLY_MAX_AMOUNT" => "Y",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"MAX_COUNT" => "0",
		"DEFAULT_COUNT" => "4",
		"USE_RATING" => "Y",
		"POSADOCHNYY_DIAMETR_DISKA" => "-",
		"SHIRINA_DISKA" => "-",
		"COUNT_OTVERSTIY" => "-",
		"DIAMETR_STUPITSY" => "-",
		"MEZHBOLTOVOE_RASSTOYANIE" => "-",
		"VYLET_DISKA" => "-",
		"SHIRINA_PROFILYA" => "SHIRINA_PROFILYA",
		"VYSOTA_PROFILYA" => "VYSOTA_PROFILYA",
		"POSADOCHNYY_DIAMETR" => "POSADOCHNYY_DIAMETR",
		"SEZONNOST" => "SEZONNOST",
		"SHIPY" => "SHIPY",
		"PROIZVODITEL" => "PROIZVODITEL",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "wheels_tires",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"RUN_ON_FLAT" => "RUNFLAT",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"SHOW_DEACTIVATED" => "N",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"STORES" => array(
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>