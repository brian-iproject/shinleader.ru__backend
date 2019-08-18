<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?if($USER->isAuthorized()):?>
<?$APPLICATION->ShowHead();?>
<script>
	BX.reload(false)
</script>
<?//header("Location:".SITE_DIR."personal");?>
<?endif;?>
<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"auth_top_popup",
	Array(
		"REGISTER_URL" => "/auth/registration",
		"PROFILE_URL" => "/auth/",
		"FORGOT_PASSWORD_URL" => "/auth/forgot-password",
		"SHOW_ERRORS" => "Y"
	)
);?>