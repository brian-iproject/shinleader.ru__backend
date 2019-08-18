<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="articles-list news">
	<?foreach($arResult["ITEMS"] as $arItem){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<section class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?//print_r($arItem);?>
			<?if( $arItem["PREVIEW_PICTURE"] != "" ):?>
						<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 120, "height" => 90 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT,true );?>
						<div class="left-data">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
						</div>
			<?else:?>
					<div class="left-data">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_small_news_list.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" height="90" /></a>
						</div>
			<?endif;?>
					<div class="right-data">
						<div class="item-title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
						<div class="preview-text"><?=$arItem["PREVIEW_TEXT"]?></div>
						<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
					</div>
		</section>
	<?}?>
</div>
<?if( $arParams["DISPLAY_BOTTOM_PAGER"] ){?>
	<?=$arResult["NAV_STRING"]?>
<?}?>