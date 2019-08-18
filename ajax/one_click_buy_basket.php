<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent("aspro:oneclickbuy", "shop", array(
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => "3600000",
	"CACHE_GROUPS" => "N",
	"PROPERTIES" => (strlen($tmp = COption::GetOptionString('aspro.tires', 'ONECLICKBUY_PROPERTIES', 'FIO,PHONE,EMAIL,COMMENT', SITE_ID)) ? explode(',', $tmp) : array()),
	"REQUIRED" => (strlen($tmp = COption::GetOptionString('aspro.tires', 'ONECLICKBUY_REQUIRED_PROPERTIES', 'FIO,PHONE', SITE_ID)) ? explode(',', $tmp) : array()),
	"DEFAULT_PERSON_TYPE" => COption::GetOptionString('aspro.tires', 'ONECLICKBUY_PERSON_TYPE', '1', SITE_ID),
	"DEFAULT_DELIVERY" => COption::GetOptionString('aspro.tires', 'ONECLICKBUY_DELIVERY', '2', SITE_ID),
	"DEFAULT_PAYMENT" => COption::GetOptionString('aspro.tires', 'ONECLICKBUY_PAYMENT', '1', SITE_ID),
	"DEFAULT_CURRENCY" => COption::GetOptionString('aspro.tires', 'ONECLICKBUY_CURRENCY', 'RUB', SITE_ID),
	"BUY_ALL_BASKET" => "Y",
	),
	false
);?>
