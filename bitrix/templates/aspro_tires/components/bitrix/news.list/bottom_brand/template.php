<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="main-manufacturers-row">
	<ul class="logos-list">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			
			$arSection = aspro::get_section_by_name($arItem["NAME"]);?>
			<li class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="item-title">
					<?if( is_array( $arItem["PREVIEW_PICTURE"] ) ){?>
						<?$img = CFile::ResizeImageGet( $arItem["PREVIEW_PICTURE"], array('width' => 120, 'height' => 37), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<img border="0" src="<?=$img['src']?>" width="140" height="34" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
					<?}else{?>
						<img border="0" src="<?=SITE_TEMPLATE_PATH."/images/noimage.jpg"?>" width="140" height="34" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
					<?}?>
					<?=$arItem["NAME"]?>
				</a>
			</li>
		<?}?>
	</ul>
	<div class="all-row"><a href="<?=$arParams['ALL_BRANDS_LINK']?>" >Все производители</a></div>
</div>