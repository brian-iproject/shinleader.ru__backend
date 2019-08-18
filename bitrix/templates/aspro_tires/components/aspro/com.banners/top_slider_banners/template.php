<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.flexslider-min.js',true)?> 
<div class="flexslider">
	<ul class="slides">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			
			<?//=var_dump($arItem)?>
			
			<?if( $arItem["DETAIL_PICTURE"] != "" ):?>
				<?
					$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 980, "height" => 260 ), BX_RESIZE_IMAGE_EXACT ,true );
					$style= "background: url(".$img['src'].") center no-repeat;";
				?>
			<?endif;?>
			
			<li class="box" id="<?=$this->GetEditAreaId($arItem['ID']);?>" <?if( $style) {echo "style='".$style."'";}?>>
			
				<?if ($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
					<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" target="<?=strstr($arItem["PROPERTIES"]["TARGETS"]["VALUE"], ' ', true)?>" class="thumb">
				<?endif;?>
				
					<?if ($arItem["NAME"]):?>
						<div class="banner_title"><?=$arItem["NAME"];?></div>
					<?endif;?>
					
					<?if ($arItem["PREVIEW_TEXT"]):?>
						<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
					<?endif;?>

				<?if ($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
					</a>
				<?endif;?>

			</li>
		<?}?>
	</ul>
</div>
<script>
	$(".flexslider").flexslider({
		animation: "slide",
		slideshow: true,
		slideshowSpeed: 10000,
		animationSpeed: 600,
		directionNav: false,
		pauseOnHover: true
	});
</script>