<?php
include_once('/home/bitrix/www/pars/simple_html_dom.php'); // подключаем библиотеку
// Create DOM from URL or file
$brandsHtml = file_get_html('http://www.shinservice.ru/disk_catalog/model/');

foreach($brandsHtml->find('.content_box a') as $brandLink) {
	$arBrandsLink[] = "http://www.shinservice.ru".$brandLink->href;
}

foreach($arBrandsLink as $brandLink) {
	$modelHtml = file_get_html($brandLink);
	
	foreach($modelHtml->find('.content_box a') as $modelLink) {
		$arModelsLink[] = "http://www.shinservice.ru".$modelLink->href;	
	}
}

foreach($arModelsLink as $modelLink) {
	$itemsHtml = file_get_html($modelLink);

	foreach($itemsHtml->find('#prdct tbody a') as $itemLink) {
		$arItemsLink[] = "http://www.shinservice.ru".$itemLink->href;
	}
}

foreach($arItemsLink as $itemLink) {

	$itemDetailHtml = file_get_html($itemLink);

	$productCode = $itemDetailHtml->find('.product-code', 0)->innertext;
	$productCode = str_replace("Код товара:", "", $productCode);
	$productCode = str_replace(" ", "", $productCode);
	$productCode = str_replace("\n", "", $productCode);
	$productCode = str_replace("\r", "", $productCode);
	$productCode = str_replace("\t", "", $productCode);
	$productCode = strip_tags($productCode);





	foreach($itemDetailHtml->find('#product_img') as $imgItem) {
		$imgSrc = $imgItem->src;
		$imgSrc = str_replace("?0", "", $imgSrc);
		$imgSrc = str_replace("?1", "", $imgSrc);

		$url = $imgSrc;
		$img = '/var/www/vhosts/shinleader.ru/httpdocs/pars/img/'.$productCode.".jpg";
		file_put_contents($img, file_get_contents($url));
	}
}

?>