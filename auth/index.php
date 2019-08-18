<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>

<?if(!$USER->IsAuthorized()){
	$APPLICATION->IncludeComponent(
		"bitrix:system.auth.form",
		"main",
		Array(
			"REGISTER_URL" => "/auth/registration/",
			"PROFILE_URL" => "/auth/forgot-password/",
			"SHOW_ERRORS" => "Y"
		)
	);
}elseif( !empty( $_REQUEST["backurl"] ) ){
	LocalRedirect( $_REQUEST["backurl"] );
}else{
	LocalRedirect(SITE_DIR.'personal/');
}?>	
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>