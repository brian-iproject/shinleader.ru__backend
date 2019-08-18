<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Купить авторезину и диски для авто в интернет-магазине, цена на колеса для авто в Москве");
$APPLICATION->SetTitle("Интернет-магазин шин и дисков");?>

<?$APPLICATION->IncludeComponent("aspro:com.banners", "top_slider_banners", array(
	"IBLOCK_TYPE" => "aspro_tires_adv",
	"IBLOCK_ID" => "6",
	"TYPE_BANNERS" => "388",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"PROPERTY_CODE" => array(
		0 => "URL_STRING",
		1 => "TARGETS",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false
);?> 
	
	<div class="main-filter-tabs">
		<div class="tabs-body">
			<div class="tab for-tires">
				<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"front_tyres17", 
	array(
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID" => "1",
		"SECTION_ID" => "",
		"FILTER_NAME" => "arrFilter",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "100000",
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"INSTANT_RELOAD" => "N",
		"PRICE_CODE" => array(
		),
		"SHIRINA_PROFILYA" => "SHIRINA_PROFILYA",
		"VYSOTA_PROFILYA" => "VYSOTA_PROFILYA",
		"POSADOCHNYY_DIAMETR" => "POSADOCHNYY_DIAMETR",
		"SEZONNOST" => "SEZONNOST",
		"SHIPY" => "SHIPY",
		"COMPONENT_TEMPLATE" => "front_tyres17",
		"SECTION_CODE" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"RUN_ON_FLAT" => "RUNFLAT",
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "-",
		"SECTION_DESCRIPTION" => "-"
	),
	false
);?>
			</div>
			<div class="tab for-wheels">
				<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "front_wheels17", array(
					"SMART_FILTER_PATH" => "",
					"SEF_MODE" => "Y",
					"SEF_RULE" => SITE_DIR."search/tires/#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
					"IBLOCK_TYPE" => "aspro_tires_catalog",
					"IBLOCK_ID" => "2",
					"SECTION_ID" => "",
					"FILTER_NAME" => "arrFilter",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "100000",
					"CACHE_GROUPS" => "N",
					"SAVE_IN_SESSION" => "N",
					"INSTANT_RELOAD" => "N",
					"PRICE_CODE" => array(
					),
					"POSADOCHNYY_DIAMETR_DISKA" => "POSADOCHNYY_DIAMETR_DISKA",
					"SHIRINA_DISKA" => "SHIRINA_DISKA",
					"COUNT_OTVERSTIY" => "COUNT_OTVERSTIY",
					"MEZHBOLTOVOE_RASSTOYANIE" => "MEZHBOLTOVOE_RASSTOYANIE"
					),
					false
				);?>
			</div>
		</div>
	</div>
	
	
	<div class="module-products-corusel product-list-items">
		 <?$GLOBALS['arrTopFilter'] = array(
			array(
			  "LOGIC" => "OR", 
			  array("!PROPERTY_KHIT_PRODAZH"=>false), 
			  array("!PROPERTY_NOVINKA"=>false),     
			  array("!PROPERTY_AKTSIYA"=>false)
		   ),
		);?>
		
		<?$APPLICATION->IncludeComponent(
	"aspro:catalog.top", 
	"top_slider", 
	array(
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID1" => "1",
		"IBLOCK_ID2" => "2",
		"IBLOCK_ID3" => "11",
		"IBLOCK_ID4" => "",
		"ELEMENT_SORT_FIELD" => "RAND",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_COUNT" => "20",
		"LINE_ELEMENT_COUNT" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SEZONNOST",
			2 => "SHIPY",
			3 => "NOVINKA",
			4 => "AKTSIYA",
			5 => "KHIT_PRODAZH",
			6 => "",
		),
		"OFFERS_LIMIT" => "20",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "Y",
		"SEZONNOST" => "SEZONNOST",
		"SHIPY" => "SHIPY",
		"FILTER_NAME" => "arrTopFilter",
		"COMPONENT_TEMPLATE" => "top_slider",
		"CURRENCY_ID" => "RUB"
	),
	false
);?>
	
	</div>
							
	<?$APPLICATION->IncludeComponent(
	"aspro:catalog.section.list", 
	"bottom_brand", 
	array(
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID1" => "1",
		"IBLOCK_ID2" => "2",
		"IBLOCK_ID3" => "",
		"IBLOCK_ID4" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "UF_VIEW_BRAND",
			2 => "",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => "bottom_brand"
	),
	false
);?>
	<hr />
    ⁠<?$APPLICATION->IncludeComponent("bitrix:catalog.bigdata.products", ".default", array(
	"COMPONENT_TEMPLATE" => ".default",
		"RCM_TYPE" => "personal",
		"ID" => $_REQUEST["PRODUCT_ID"],
		"IBLOCK_TYPE" => "aspro_tires_catalog",
		"IBLOCK_ID" => "2",
		"SHOW_FROM_SECTION" => "N",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ELEMENT_CODE" => "",
		"DEPTH" => "",
		"HIDE_NOT_AVAILABLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"TEMPLATE_THEME" => "blue",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action_cbdp",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_PRODUCTS_1" => "Y",
		"PROPERTY_CODE_1" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_1" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_1" => "OTHER_PHOTO",
		"LABEL_PROP_1" => "-",
		"SHOW_PRODUCTS_2" => "Y",
		"PROPERTY_CODE_2" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_2" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_2" => "OTHER_PHOTO",
		"LABEL_PROP_2" => "-"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
	<div class="index_bottom">	
		<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"left_news", 
	array(
		"IBLOCK_TYPE" => "aspro_tires_content",
		"IBLOCK_ID" => "7",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "left_news",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);*/?>
	 
	<div class="about-column"> 		
	  <?$APPLICATION->IncludeComponent(
		"bitrix:main.include", ".default",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/main_txt.php",
			"EDIT_TEMPLATE" => ""
		)
		);?>
	</div>
	
</div>
 
  <div class="b-hr"></div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>