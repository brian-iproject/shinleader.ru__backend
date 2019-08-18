<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"wheels_tires",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"ORDER_BUTTON_VIEW" => \Bitrix\Main\Config\Option::get("aspro.tires", "ORDER_BUTTON", "order"),
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"MATCHING_ELEMENT_PROPERTIES" => array
		(
			"POSADOCHNYY_DIAMETR_DISKA" => $arParams["POSADOCHNYY_DIAMETR_DISKA"],
			"SHIRINA_DISKA" => $arParams["SHIRINA_DISKA"],
			"COUNT_OTVERSTIY" => $arParams["COUNT_OTVERSTIY"],
			"DIAMETR_STUPITSY" => $arParams["DIAMETR_STUPITSY"],
			"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MEZHBOLTOVOE_RASSTOYANIE"],
			"VYLET_DISKA" => $arParams["VYLET_DISKA"],
			"SHIRINA_PROFILYA" => $arParams["SHIRINA_PROFILYA"],
			"VYSOTA_PROFILYA" => $arParams["VYSOTA_PROFILYA"],
			"POSADOCHNYY_DIAMETR" => $arParams["POSADOCHNYY_DIAMETR"],
			"SEZONNOST" => $arParams["SEZONNOST"],
			"SHIPY" => $arParams["SHIPY"],
			"RUN_ON_FLAT" => $arParams["RUN_ON_FLAT"],
		),
		
		
		"USE_STORE" => $arParams["USE_STORE"],
		"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
		"MIN_AMOUNT"=>$arParams["MIN_AMOUNT"],
		"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
		"MAIN_TITLE"=>$arParams["MAIN_TITLE"],
		"MAIN_TITLE_LIST"=>$arParams["MAIN_TITLE_LIST"],
		"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
		"SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
		"STORE_PATH"  =>  $arParams["STORE_PATH"],
		"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
		
		
		"LIST_PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],
		"USE_RATING" => $arParams["USE_RATING"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],

		"USE_REVIEW" => $arParams["USE_REVIEW"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"REVIEW_AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
		"DETAIL_PROPS_ANALOG" => $arParams["DETAIL_PROPS_ANALOG"],
		"DISCOUNT_PRICE_CODE" => $arParams["DISCOUNT_PRICE_CODE"],
		"MAX_COUNT" => $arParams["MAX_COUNT"],

		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"CHECK_SECTION_ID_VARIABLE" => (isset($arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"]) ? $arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"] : ''),
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
		'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
		"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],

		'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
		'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),

		"USE_GIFTS_DETAIL" => $arParams['USE_GIFTS_DETAIL']?: 'Y',
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',
		"GIFTS_SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		"GIFTS_SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
		"GIFTS_DETAIL_BLOCK_TITLE" => $arParams["GIFTS_DETAIL_BLOCK_TITLE"],
		"GIFTS_SHOW_NAME" => $arParams['GIFTS_SHOW_NAME'],
		"GIFTS_SHOW_IMAGE" => $arParams['GIFTS_SHOW_IMAGE'],
		"GIFTS_MESS_BTN_BUY" => $arParams['GIFTS_MESS_BTN_BUY'],

		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],
	),
	$component
);?>


<?
	if (CModule::IncludeModule("sale"))
	{
		$dbBasketItems = CSaleBasket::GetList(
			array( "NAME" => "ASC", "ID" => "ASC" ),
			array(  "FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL",
					"CAN_BUY" => "Y",
					"DELAY" => "N",
					"SUBSCRIBE" => "N"),
			false, false, array("ID", "PRODUCT_ID")
		);
		while( $arBasketItems = $dbBasketItems->GetNext() ){ $basket_items[] = $arBasketItems["PRODUCT_ID"];}
	}
?> 
 
<?if( !empty( $basket_items ) ):?>
	<script>
		$(document).ready(function(){
			<?foreach( $basket_items as $item ){?>
				$('.item_<?=$item?> .to-cart').hide();
				$('.item_<?=$item?> .in-cart').show();
			<?}?>
		});
	</script>
<?endif;?>