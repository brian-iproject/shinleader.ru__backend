<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-column">
	<div class="module-title"><?=GetMessage("NEWS")?></div>
	<div class="news-list">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<section class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 120, "height" => 1500 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>/" class="thumb"><img class="preview_picture" border="0" src="<?=$img["src"]?>" width="<?=$img["width"]?>" height="<?=$img["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
					<?else:?>
						<img class="preview_picture" border="0" src="<?=$img["src"]?>" width="<?=$img["width"]?>" height="<?=$img["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					<?endif;?>
				<?endif?>
				
				<div class="right-data">
					<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="item-title"><?=$arItem["NAME"]?></a><br />
						<?else:?>
							<?=$arItem["NAME"]?><br />
						<?endif;?>
					<?endif;?>	
					<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<div class="preview"><?echo $arItem["PREVIEW_TEXT"]?></div>
					<?endif?>
					<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<div class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
					<?endif?>			
				</div>		
			</section>
		<?endforeach;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<br /><?=$arResult["NAV_STRING"]?>
		<?endif;?>
		<a class="more_big" href="<?=SITE_DIR?>news"><?=GetMessage("ALL");?></a>
	</div>
	
</div>