<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax",
	"order",
	Array(
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_PERSONAL" => "/personal/",
		"PATH_TO_PAYMENT" => "/order/payment/",
		"PATH_TO_AUTH" => "/auth/",
		"PAY_FROM_ACCOUNT" => "Y",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"ALLOW_AUTO_REGISTER" => "N",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => ".default",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"SET_TITLE" => "Y",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => array(),
		"PROP_3" => array(),
		"PROP_2" => array(),
		"PROP_4" => array(),
		"AJAX_CALL" => "Y"
	),
false
);?>