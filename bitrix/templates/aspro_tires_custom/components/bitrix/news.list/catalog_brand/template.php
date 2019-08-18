<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="manufacturers-list">
	<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));		
		$arSection = aspro::get_section_by_name( $arItem["NAME"] );?>
		<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="logotip">
				<?if( is_array( $arItem["PREVIEW_PICTURE"] ) ){?>
					<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
					<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				<?}else{?>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage.jpg" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" width="120" height="37" />
				<?}?>
			</a>
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</li>
	<?}?>
</ul>
<?if( $arParams["DISPLAY_BOTTOM_PAGER"] ){?>
	<?=$arResult["NAV_STRING"]?><?}?>