<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
// Жестко переопределяем настройки компонента, установленные из публичного интерфейса
$additional_options = array(
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PRICE",
		2 => "QUANTITY",
		3 => "DELETE",
	),
	"AJAX_MODE" => "Y",
);
require_once("include_basket.php");
?>