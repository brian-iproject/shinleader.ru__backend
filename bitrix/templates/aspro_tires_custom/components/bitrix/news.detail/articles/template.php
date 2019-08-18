<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/*$APPLICATION->SetTitle($arResult["NAME"]);
$APPLICATION->AddChainItem($APPLICATION->GetTitle());*/
//$APPLICATION->AddChainItem($arResult["NAME"], "");
?>

			<?if( !empty($arResult["DETAIL_PICTURE"]) ):?>
				<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 250, "height" => 191 ), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy align-rights">
					<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" width="<?=$img['width']?>" height="<?=$img['height']?>" />
				</a>
			<?endif;?>			

	<?=$arResult["DETAIL_TEXT"]?>
<?
//print_r($arResult);
if($arResult["PROPERTIES"]["GALLERY"]["VALUE"]){
?>
<ul class="module-gallery-list">
<?
$files = $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'];		
        if(array_key_exists('SRC', $files)) {
           // Жуткий хак, так как на одном элементе косячит
           // Заменяет первый символ пути на нечитаемый. Предполагаем, что это должен быть слеш
           $files['SRC'] = '/' . substr($files['SRC'], 1);
           // ID вообще устанавливает рандомно. Правильное значение лежит по такому пути
           $files['ID'] = $arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE'][0];
           $files = array($files);
		 //  print_r($files);
}
?>
<?foreach($files as $arFile):?>
<?
   $img = CFile::ResizeImageGet($arFile['ID'], array('width'=>175, 'height'=>125), BX_RESIZE_IMAGE_EXACT, true);
   $img = $img['src'];
$img_big = CFile::ResizeImageGet($arFile['ID'], array('width'=>800, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
   $img_big = $img_big['src'];
?>
<li>
    <a href="<?=$img_big;?>" class="fancy" data-fancybox-group="gallery">
	<span class="zoom"></span>						 
		   <?= CFile::ShowImage($img); ?>
	</a>				  
</li>
<?endforeach;?>

</ul>
<?}
else{	
?>
<br/>
<?}?>
<div class="back">
	<a href="<?echo $arResult["LIST_PAGE_URL"];?>" class="button-19 back-link"><span>Вернуться</span></a>
</div>