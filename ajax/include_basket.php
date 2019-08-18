<?
$options = array(
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PRICE",
		2 => "QUANTITY",
		3 => "DELETE",
		4 => "DISCOUNT",
	),
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"PATH_TO_ORDER" => "/order/",
	"HIDE_COUPON" => "N",
	"QUANTITY_FLOAT" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SET_TITLE" => "N",
	"MAX_COUNT" => "4",
	"AJAX_OPTION_ADDITIONAL" => ""
	);
if(is_array($additional_options))
	$options = array_merge($options, $additional_options);
	
$APPLICATION->IncludeComponent("aspro:eshop.sale.basket.basket", "main", array(
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PRICE",
		2 => "QUANTITY",
		3 => "DELETE",
		4 => "DELAY",
	),
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"PATH_TO_ORDER" => "/order/",
	"HIDE_COUPON" => "N",
	"QUANTITY_FLOAT" => "N",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SET_TITLE" => "Y",
	"MAX_COUNT" => "0",
	"0" => "z",
	"AJAX_OPTION_ADDITIONAL" => "?"
	),
	false
);
?>