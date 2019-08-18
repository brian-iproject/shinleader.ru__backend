<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
	@define("CUSTOM_404","Y");
	$APPLICATION->SetTitle("Страница не найдена");
	
	$siteTheme = COption::GetOptionString("aspro.tires", "COLOR_THEME", SITE_ID);;
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/style.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/media.css');
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/favicon.ico" type="image/x-icon" />',true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/favicon_57.png" />',true);	
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="'.SITE_TEMPLATE_PATH.'/themes/'.$siteTheme.'/favicon_72.png" />',true);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?$APPLICATION->ShowTitle()?></title>		
		<?$APPLICATION->ShowHead()?>	
	</head>
	
	<body id="error-page">
	
		<div id="wrapper">
			<header id="header">
				<div class="middle-h-row">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", Array(), Array("MODE"      => "html", "NAME"      => GetMessage("LOGO"),));?>
				</div>
			</header>
			<div id="middle">
				<table class="error-msg" cellspacing="0" cellpadding="0" width="100%" border="0">
					<tr>
						<td><img  class="error-img" src="<?=SITE_TEMPLATE_PATH?>/themes/<?=$siteTheme?>/images/404.png" alt="404" title="404" /></td>
						<td>
							<div class="t">Ошибка 404</div>
							<div class="st">Страница не найдена</div>
							<p>Неправильно набран адрес или такой страницы не существует</p>
							<a onclick="history.back()" class="button1 gradient"><span>Вернуться</span></a>
							<span class="choice-text">или</span>
							<a href="<?=SITE_DIR?>" class="button_orange gradient"><span>Перейти на главную</span></a>
						</td>
					</tr>
				</table>
			</div>
		</div> 	
			
		<footer id="footer">
			<div class="footer-bottom">
				<div class="foo-wrapp">
					<div class="copyright">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php", Array(), Array( "MODE" => "html", "NAME"  => GetMessage("COPYRIGHT"),));?>
					</div>
					<div class="social">
						<?$APPLICATION->IncludeComponent("aspro:social.info", "main", array(
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_GROUPS" => "Y",
							"VK" => "http://vkontakte.ru/aspro74",
							"FACE" => "http://www.facebook.com/aspro74",
							"TWIT" => "http://twitter.com/aspro_ru"
							), false
						);?> 
					</div>
				</div><div class="clearboth"></div>
			</div>
		</footer>
		
	</body>
</html>