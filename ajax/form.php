<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$form_id = isset( $_REQUEST["form_id"] ) ? $_REQUEST["form_id"] : 1;?>

<?if( $form_id == 'auth' ){?>
	 <?if( $USER->isAuthorized() ){?>
		<?$APPLICATION->ShowHead();?>
		<script>
			BX.reload(false)
		</script>
	<?}?>
	<a href="#" class="close jqmClose"></a>
	<div class="popup-intro">
		<div class="pop-up-title">Вход в личный кабинет</div>
		<div class="after-title">
			<span class="description-wrapp">Вход для зарегистрированных пользователей:</span>
		</div>
	</div>
	<div id="ajax_auth">
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
	</div>
<?}elseif ( $form_id == 'one_click_buy' ){?>
	
<?}else{?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:form",
		"main",
		Array(
			"AJAX_MODE" => "Y",
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $form_id,
			"START_PAGE" => "new",
			"SHOW_LIST_PAGE" => "N",
			"SHOW_EDIT_PAGE" => "N",
			"SHOW_VIEW_PAGE" => "N",
			"SUCCESS_URL" => "",
			"SHOW_ANSWER_VALUE" => "N",
			"SHOW_ADDITIONAL" => "N",
			"SHOW_STATUS" => "N",
			"EDIT_ADDITIONAL" => "N",
			"EDIT_STATUS" => "Y",
			"NOT_SHOW_FILTER" => "",
			"NOT_SHOW_TABLE" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"VARIABLE_ALIASES" => Array(
				"action" => "action"
			)
		)
	);?>
<?}?>