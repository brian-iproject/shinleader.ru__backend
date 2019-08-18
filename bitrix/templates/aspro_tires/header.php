<?global $APPLICATION; $fields = CSite::GetByID(SITE_ID)->Fetch();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?IncludeTemplateLangFile(__FILE__);?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
		<?$APPLICATION->ShowHead()?>
		<?$siteTheme = COption::GetOptionString("aspro.tires", "COLOR_THEME", SITE_ID);?>
		<?$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/images/favicon.ico" type="image/x-icon" />',true); ?>
		<?$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/images/favicon_57.png" />',true); ?>
		<?$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/images/favicon_72.png" />',true); ?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.fancybox.css')?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles.css')?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/media.css')?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/themes/'.COption::GetOptionString("aspro.tires", "COLOR_THEME", SITE_ID).'/style.css');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jqModal.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.flexslider-min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-ui-1.10.2.custom.min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput-1.2.2.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.placeholder.min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.validate.min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.history.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/detectmobilebrowser.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/equalize.min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.bxslider.min.js',true)?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/main.js',true)?>
		<?$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject( $MESS, false ).')</script>', true);?>
		<script>
			var arTiresOptions = ({"TIRES_SITE_DIR" : "<?=SITE_DIR?>", "CALLBACK_FORM_ID" : "1" , "PRODUCT_REQUEST_FORM_ID" : "3"});
			$(document).ready(function(){$('.phone-input').mask('<?=trim(COption::GetOptionString("aspro.tires", "PHONE_MASK", "+9 (999) 999-99-99", SITE_ID));?>');});
			jQuery.extend(jQuery.validator.messages,{required: '<?=GetMessage("VALIDATOR_REQUIRED")?>', email: '<?=GetMessage("VALIDATOR_EMAIL")?>'});
		</script>
		<!--[if gte IE 9]>
			<script src="<?=SITE_TEMPLATE_PATH?>/js/dist/html5.js"></script>
			<style type="text/css">.gradient {filter: none;}</style>
		<![endif]-->
		<?CJSCore::Init(array("jquery"));?>
		<?
			if (CSite::InDir(SITE_DIR.'index.php'))	$isFrontPage = true;
			if (CSite::InDir(SITE_DIR.'search'))	$isSearch = true;
			if(CSite::InDir(SITE_DIR.'order'))   $isOrder=true;
			if (CSite::InDir(SITE_DIR.'about')||CSite::InDir(SITE_DIR.'buy')||CSite::InDir(SITE_DIR.'delivery'))	$isTextPage = true;
		?>
	</head>
	<body <?$APPLICATION->AddBufferContent(array('CTires', 'haveErrorPage'), $APPLICATION);?> id="main<?=!ERROR_404 ? ' front-page' : ''?>">
		<?CAjax::Init();?>
		<?CTires::SetJSOptions();?>
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<div id="wrapper">
			<div class="top-h-row">
				<div class="top_wrapper">
					<div class="h-user-block" id="personal_block">
						<?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form", "top",
							Array(
								"REGISTER_URL" => "/auth/",
								"FORGOT_PASSWORD_URL" => "/auth/forgot-password",
								"PROFILE_URL" => "/personal/",
								"SHOW_ERRORS" => "Y"
							)
						);?>
					</div>
					<nav class="left-nav">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "top_left", array(
							"ROOT_MENU_TYPE" => "top_left",
							"MENU_CACHE_TYPE" => "Y",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "top_left",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							), false
						);?>
					</nav>
				</div>
			</div>
			<header id="header">
				<table class="middle-h-row" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td>
					<div class="logo"><?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("LOGO"),));?></div>
					<div class="phone-block">
						<span class="border-wrapp">
							<span class="phone-code"><?$APPLICATION->IncludeFile(SITE_DIR."include/phone_code.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("PHONE_CODE"),));?></span>
							<span class="phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE"), ));?></span>
						</span><br />
						<!--noindex--><a class="callback pseudo" rel="nofollow" title= "<?=GetMessage("CALLBACK_ORDER");?>"><?=GetMessage("CALLBACK_ORDER");?></a><!--/noindex-->
					</div>
					<div class="work-time">
						<span class="title"><?=GetMessage("WORK_TIME");?>:</span><br />
						<?$APPLICATION->IncludeFile(SITE_DIR."include/work_time.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("WORK_TIME"),));?>
					</div>
					<div class="header-cart-block" id="basket_line"><?$APPLICATION->IncludeFile(SITE_DIR."include/basket_top.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("BASKET_TOP")));?></div>
				</td></tr></table>
				<nav class="main-nav gradient">
					<div class="search">
						<?$APPLICATION->IncludeComponent("bitrix:search.form", "diskishini.search.form", array(
							"PAGE" => "/catalog/search/",
							"USE_SUGGEST" => "N",
							"USE_SEARCH_TITLE" => "Y"
							), false
						);?>
					</div>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "top_multilevel", array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						), false
					);?>
				</nav>
			</header>
			<section id="middle">
				<div id="container">
					<?if(!$isFrontPage){?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"diskishini",
							Array( "START_FROM" => "0", "PATH" => "", "SITE_ID" => SITE_ID )
						);?>
						<h1 class="page-heading"><?=$APPLICATION->ShowTitle(false);?></h1>
					<?}?>
					<div id="content" <?if($isTextPage):?>class="text_page"<?endif;?> <?if($isFrontPage):?>class="<?=$isFrontPage? ' index' : ''?>"<?endif;?>>
					<?if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) $APPLICATION->RestartBuffer();?>