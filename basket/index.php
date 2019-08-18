<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?> 
<div>
	<?// Вынесено в отдельный файл, чтобы настройки можно было выполнять из публичного интерфейса, и это все работало
	  // в том числе по AJAX (из файла /ajax/show_basket.php) 
	?>
	<?require_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."/ajax/include_basket.php");?>
</div>
 
<div></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>