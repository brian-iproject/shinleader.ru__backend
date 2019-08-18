<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Личный кабинет");
?>
<?
	if(!$USER->isAuthorized()){LocalRedirect(SITE_DIR.'auth');} else {
?>
	<div class="left_side">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
			"ROOT_MENU_TYPE" => "left",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "1",
			"CHILD_MENU_TYPE" => "left",
			"USE_EXT" => "N",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N"
			),
			false
		);?>
		<?if($isPersonal):?>					
			<a href="<?=SITE_DIR?>?logout=yes&login=yes" class="exit">Выйти</a>
		<?endif;?>		
	</div>
	
	<div class="right_side">
		<?$APPLICATION->IncludeComponent("bitrix:main.profile", "profile", array(
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"SET_TITLE" => "N",
			"USER_PROPERTY" => array(
				0 => "UF_AUTO_MARK",
				1 => "UF_AUTO_MODEL",
				2 => "UF_AUTO_YEAR",
				3 => "UF_AUTO_COMPLECT",
			),
			"SEND_INFO" => "N",
			"CHECK_RIGHTS" => "N",
			"USER_PROPERTY_NAME" => "",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			false
		);?>
	</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>