<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Личный кабинет");
	$_REQUEST["filter_history"] = "Y";
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
			"USE_EXT" => "Y",
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
		<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "orders", array(
			"PROP_1" => array(),
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "/personal/history-of-orders/",
			"ORDERS_PER_PAGE" => "20",
			"PATH_TO_PAYMENT" => "/order/payment/",
			"PATH_TO_BASKET" => "/basket/",
			"SET_TITLE" => "N",
			"SAVE_IN_SESSION" => "Y",
			"NAV_TEMPLATE" => "",
			"SEF_URL_TEMPLATES" => array(
				"list" => "",
				"detail" => "order_detail.php?ID=#ID#",
				"cancel" => "order_cancel.php?ID=#ID#",
			),
			"VARIABLE_ALIASES" => array(
				"detail" => array("ID" => "ID",),
				"cancel" => array("ID" => "ID",),
			)
			),
			false
		);?>
	</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>