<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
	CModule::IncludeModule("sale");
	CModule::IncludeModule("catalog");

	Add2BasketByProductID( $_REQUEST["item"], $_REQUEST["quantity"], array(), array() );
?>