<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.small",
	"popup",
	Array(
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_ORDER" => "/order/"
	)
);?>