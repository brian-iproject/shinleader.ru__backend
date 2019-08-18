<?
//Navigation chain template
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arChainBody = array();

//echo var_dump($arCHAIN);

foreach($arCHAIN as $item)
{
	if(strlen($item["LINK"])<strlen(SITE_DIR))
		continue;
	if($item["LINK"] <> "")
		$arChainBody[] = '<a href="'.$item["LINK"].'">'.htmlspecialcharsex($item["TITLE"]).'</a>';
	else
		$arChainBody[] = htmlspecialcharsex($item["TITLE"]);
}
return implode('<span class="sep">/</span>', $arChainBody);
?>