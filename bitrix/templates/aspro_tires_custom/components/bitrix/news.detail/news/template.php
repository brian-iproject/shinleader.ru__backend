<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]) || $arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"]) $left_side=true;?>

<?if ($left_side):?>
	<div class="left_side">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
			<div class="news_date_time_detail">
				<?=$arResult["DISPLAY_ACTIVE_FROM"]?>
			</div>	
		<?endif;?>
		<?if($arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"]):?>
			<div class="period">
				<?=$arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"];?>
			</div>
		<?endif;?>
	</div>
<?endif;?>

<?if ($arParams["DISPLAY_NAME"]!="N"):?><div class="<?if ($left_side):?>right_side<?endif;?>"><h2 class="subtitle"><?=$arResult["NAME"];?></h2></div><?endif;?>

<?if ($arResult["PREVIEW_TEXT"]):?>
	<div class="<?if ($left_side):?>right_side<?endif;?> preview_text"><?=$arResult["PREVIEW_TEXT"];?></div>
<?endif;?>
<?if( !empty($arResult["DETAIL_PICTURE"])&&$arResult["PROPERTIES"]["DETAIL_PICTURE_DESCRIPTION"]["~VALUE"]):?>
	<div class="detail_picture_full_block">
		<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 300, "height" => 225 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
		<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy">
			<div class="fancy_hover" style="height:<?=($img["height"]-3)?>px; width:<?=($img["width"]-6)?>px;"></div>
			<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" height="<?=$img["height"]?>" width="<?=$img["width"]?>" />
		</a>
		<div class="detail_picture_description">
			<?=$arResult["PROPERTIES"]["DETAIL_PICTURE_DESCRIPTION"]["~VALUE"]["TEXT"];?>
		</div>
		<div class="clearboth"></div>
	</div>
<?endif;?>


<div class="<?if ($left_side):?>right_side<?endif;?>">
	<?if ($arResult["DETAIL_TEXT"]):?><div class="detail_text"><?endif;?>
	<?if (!empty($arResult["DETAIL_PICTURE"])&&!$arResult["PROPERTIES"]["DETAIL_PICTURE_DESCRIPTION"]["~VALUE"]):?>
		<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 300, "height" => 225 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
		<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy align-rights">
			<div class="fancy_hover" style="height:<?=($img["height"]-3)?>px; width:<?=($img["width"]-6)?>px;"></div>
			<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" height="<?=$img["height"]?>" width="<?=$img["width"]?>" />
		</a>
	<?endif;?>
	<?if ($arResult["DETAIL_TEXT"]):?><?=$arResult["DETAIL_TEXT"];?></div><?endif;?>
</div>


<?if($arResult["PROPERTIES"]["GALLERY"]["VALUE"]){?>
	<div class="<?if ($left_side):?>right_side<?endif;?>">
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
		<?foreach($files as $arFile):
			$img = CFile::ResizeImageGet($arFile['ID'], array('width'=>175, 'height'=>125), BX_RESIZE_IMAGE_EXACT, true);
			//$img = $img['src'];
			$img_big = CFile::ResizeImageGet($arFile['ID'], array('width'=>800, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$img_big = $img_big['src'];
		?>
			<li>
				<a href="<?=$img_big;?>" class="fancy" data-fancybox-group="gallery">
					<div class="fancy_hover" style="height:<?=($img["height"]-6)?>px; width:<?=($img["width"]-6)?>px;"></div>					 
					<?= CFile::ShowImage($img["src"]); ?>
				</a>				  
			</li>
		<?endforeach;?>

		</ul>
	</div>
<?}?>

<div class="<?if ($left_side):?>right_side<?endif;?>">
	<div class="back b-news">
		<?if ((strpos($_SERVER['HTTP_REFERER'], '/news/')>0) || (strpos($_SERVER['HTTP_REFERER'], '/articles/')>0)){?>
			<a class="button1" href="javascript:history.back();"><span><?=GetMessage("BACK");?></span></a> 
		<?}else{?>
			<a class="button1" href="<?=$arResult["LIST_PAGE_URL"]?>"><span><?=GetMessage("BACK");?></span></a>
		<?}?>
	</div>
</div>

<div class="similar_products_wrapp<?if ($left_side):?> right_side<?else:?> no_right_side<?endif;?>">
	<?if ($arResult["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]):?>

		<div class="clearboth"></div>
		<?if(CSite::InDir(SITE_DIR."sale")):?>
			<h2 class="similar_products"><?=GetMessage("ACTION_PRODUCTS");?></h2>
		<?endif;?>
		
		<div class="module-products-corusel product-list-items catalog">
			<?	$GLOBALS["arrProductsFilter"] = array( "ID" => $arResult["DISPLAY_PROPERTIES"]["LINK"]["VALUE"] );?>
			<?$APPLICATION->IncludeComponent("aspro:catalog.top", "top_slider", array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
				"IBLOCK_ID1" => $arParams["CATALOG_IBLOCK_ID1"],
				"IBLOCK_ID2" => $arParams["CATALOG_IBLOCK_ID2"],
				"IBLOCK_ID3" => $arParams["CATALOG_IBLOCK_ID3"],
				"IBLOCK_ID4" => $arParams["CATALOG_IBLOCK_ID4"],
				"ELEMENT_SORT_FIELD" => "RAND",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_COUNT" => "20",
				"LINE_ELEMENT_COUNT" => "",
				"PROPERTY_CODE" => array(
					0 => $arParams["SHIPY"],
					1 => $arParams["SEZONNOST"],
					2 => "NOVINKA",
					3 => "AKTSIYA",
					4 => "KHIT_PRODAZH",
				),
				"OFFERS_LIMIT" => "20",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"BASKET_URL" => "/personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "100000",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_COMPARE" => "N",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_PROPERTIES" => array(
				),
				"CONVERT_CURRENCY" => "N",
				"SEZONNOST" => $arParams["SEZONNOST"],
				"SHIPY" => $arParams["SHIPY"],
				"FILTER_NAME" => $arParams["CATALOG_FILTER_NAME"],
				"SHOW_BUY_BUTTONS" => $arParams["SHOW_BUY_BUTTONS"],
				"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"]
				), false
			);?>
		</div>
	<?endif;?>
</div>