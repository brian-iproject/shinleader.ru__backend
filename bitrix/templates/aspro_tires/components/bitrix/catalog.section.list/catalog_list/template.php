<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="blocks-list">
	<?foreach($arResult["SECTIONS"] as $arSection){	
		$section = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arSection["IBLOCK_ID"], "ID" => $arSection["ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE", "UF_DESCRIPTION", "IBLOCK_ID", "UF_SEZONNOST", "UF_SHIPY", "DESCRIPTION", "IBLOCK_SECTION_ID", "CODE" ))->GetNext();
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		<div class="item" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
			<div class="left-data">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb">
					<?if( !empty( $arSection["PICTURE"] ) ){?>
						<?$img = CFile::ResizeImageGet($arSection["PICTURE"],array('width'=>150, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<img src="<?=$img["src"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}elseif( !empty( $arSection["DETAIL_PICTURE"] ) ){?>
						<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"],array('width'=>150, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<img src="<?=$img["src"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}else{?>
						<img src="<?=SITE_TEMPLATE_PATH."/images/noimage_small.png"?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}?>
				</a>
			</div>
									
			<div class="right-data">
				<div class="item-title">
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
					<?if( $section["UF_SEZONNOST"] || $section["UF_SHIPY"] ){?>
						<span class="markers">
						
							<?
								$seasonClass = "";
								if (trim($section["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
								elseif (trim($section["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }


								elseif (trim($section["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
							?>
							
							<?if (strlen($seasonClass)):?>
								<span class="marker-<?=$seasonClass?>"></span>


							<?else:?>
								<?=$section["UF_SEZONNOST"]?>
							<?endif;?>
						
							<?if( $section["UF_SHIPY"] ){?>
								<?if ($section["UF_SHIPY"]==GetMessage("YES")):?>
									<span class="marker-ship"></span>
								<?endif;?>
							<?}?>
						</span>		
					<?}?>
				</div>
			
				<div class="d">
					<?if ($section["UF_DESCRIPTION"]):?>
						<?=$section["UF_DESCRIPTION"]?>
					<?elseif ($arSection["DESCRIPTION"]):?>
						<?=$arSection["DESCRIPTION"];?>
					<?endif;?>
				</div>
				
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="button25"><span><?=GetMessage("TO_DETAIL")?></span></a>
			</div>
		</div>
	<?}?>
</div>

<?=$arResult["NAV_STRING"]?>