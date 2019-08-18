<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?
	if(!$USER->isAuthorized()){LocalRedirect(SITE_DIR.'auth');}
	else{LocalRedirect(SITE_DIR.'personal/personal-data');}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>