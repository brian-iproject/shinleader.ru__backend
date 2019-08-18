<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="module-manufacturers">
	<ul class="manufacturers-list">
		<?foreach( $arResult["SECTIONS"] as $arSection ){
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="logotip">
					<?if( !empty( $arSection["DETAIL_PICTURE"] ) ){?>
						<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<img src="<?=$img["src"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}else{?>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage.jpg" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" width="120" height="37" />
					<?}?>
				</a>
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
			</li>
		<?}?>
	</ul>
</div>