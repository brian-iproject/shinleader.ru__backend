<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<div id="basket_preload">
<?$APPLICATION->IncludeComponent( "bitrix:sale.basket.basket.line", "popup", Array(
	"PATH_TO_BASKET" => SITE_DIR."basket/", 
	"PATH_TO_ORDER" => SITE_DIR."order/",
	"SHOW_EMPTY_VALUES" => "Y",
	"SHOW_DELAY" => "N",
	"SHOW_NOTAVAIL" => "N",
	"SHOW_SUBSCRIBE" => "N",
	"SHOW_IMAGE" => "Y",
	"SHOW_PRICE" => "Y",
	"SHOW_SUMMARY" => "Y",
	"SHOW_NUM_PRODUCTS" => "Y",
	"SHOW_TOTAL_PRICE" => "Y",
	"SHOW_PRODUCTS" => "Y",
	) );?>
</div>