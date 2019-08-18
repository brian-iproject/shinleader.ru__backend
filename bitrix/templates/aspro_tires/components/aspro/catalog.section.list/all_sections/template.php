<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="module-manufacturers">
	<?foreach( $arResult["SECTIONS"] as $iblock ){?>
		<?if (count($iblock["ITEMS"])){?>
			<div class="headerh2"><?=$iblock["NAME"]?></div>
			<?foreach( $iblock["ITEMS"] as $arSection ){?>
				<ul class="manufacturers-list">
					<?$arSection["CHILD"] = sort_sections( $arSection["CHILD"] );?>
					<?foreach( $arSection["CHILD"] as $arSubSection ){
						$this->AddEditAction($arSubSection['ID'], $arSubSection['EDIT_LINK'], CIBlock::GetArrayByID($arSubSection["IBLOCK_ID"], "SECTION_EDIT"));
						$this->AddDeleteAction($arSubSection['ID'], $arSubSection['DELETE_LINK'], CIBlock::GetArrayByID($arSubSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
						?>
						<li id="<?=$this->GetEditAreaId($arSubSection['ID']);?>">
							<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>" class="logotip">
								<?if( !empty( $arSubSection["DETAIL_PICTURE"] ) ){?>
									<?$img = CFile::ResizeImageGet($arSubSection["DETAIL_PICTURE"], array( "width" => 120, "height" => 37), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
									<img src="<?=$img["src"]?>" alt="<?=$arSubSection["NAME"]?>" title="<?=$arSubSection["NAME"]?>" />
								<?}elseif( !empty( $arSubSection["PICTURE"] ) ){?>
									<?$img = CFile::ResizeImageGet($arSubSection["PICTURE"]["ID"], array( "width" => 120, "height" => 37), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
									<img src="<?=$img["src"]?>" alt="<?=$arSubSection["NAME"]?>" title="<?=$arSubSection["NAME"]?>" />
								<?}else{?>
									<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage.png" alt="<?=$arSubSection["NAME"]?>" title="<?=$arSubSection["NAME"]?>" width="170" height="62" />
								<?}?>
								<div class="name"><?=$arSubSection["NAME"]?></div>
							</a>
						</li>
					<?}?>
				</ul>		
			<?}?>
		<?}?>
	<?}?>
</div>