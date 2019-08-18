<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//=var_dump($arResult["SECTIONS"]);?>
<div class="main-manufacturers-row">
	<ul class="logos-list">
	<?
		$i=1;
	foreach($arResult["SECTIONS"] as $arSection):	
		if(($arSection["ACTIVE"]=="Y")&&$i<=5)
		{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
			<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="logotip">
					<?if( !empty( $arSection["DETAIL_PICTURE"] ) ){?>
						<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array( "width" => 125, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<img src="<?=$img["src"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}elseif( !empty( $arSection["PICTURE"] ) ){?>
							<?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
							<img src="<?=$img["src"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
					<?}else{?>
						<?=$arSection["NAME"]?>
					<?}?>				
				</a>			
			</li>
		<?$i++;}?>
	<?endforeach?>
	</ul>
	<div class="all-row"><a href="<?=SITE_DIR?>catalog"><?=GetMessage("ALL")?></a></div>
</div>
