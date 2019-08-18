<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( count( $arResult["ITEMS"] ) >= 1 ){?>

	<div class="product-list-items catalog">
	
		<?foreach( $arResult["ITEMS_BY_MANUFACTURER"] as $arManufacturer ){?>
			<?if ($arManufacturer["NAME"]):?>
				
				<h3 class="section_name"><?=$arManufacturer["NAME"]?><?$manufacturerNameShown = true;?></h3>
			<?endif;?>

			<?	
				foreach( $arManufacturer["ITEMS"] as $arItem ){
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
			?>
				
				
				<div class="item <?=(($_GET['q'])) ? 's' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
									
					<div class="ribbons">
						<?if( $arItem["PROPERTIES"]["KHIT_PRODAZH"]["VALUE"] != false ):?>
							<span class="ribon-hit"></span>
						<?endif;?>
						<?if( $arItem["PROPERTIES"]["NOVINKA"]["VALUE"] != false ):?>
							<span class="ribon-new"></span>
						<?endif;?>
						<?if( $arItem["PROPERTIES"]["AKTSIYA"]["VALUE"] != false ):?>
							<span class="ribon-share"></span>
						<?endif;?>
					</div>
				
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
						<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $arItem["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE"))->GetNext();?>	
						<?if( !empty($arItem["DETAIL_PICTURE"]) ){?>
							<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 150, "height" => 140 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
							<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?}elseif( !empty($arSection["DETAIL_PICTURE"])){?>
							<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array( "width" => 150, "height" => 140 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
							<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />	
						<?}elseif( !empty($arSection["PICTURE"])){?>
							<?$img = CFile::ResizeImageGet($arSection["PICTURE"], array( "width" => 150, "height" => 140 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
							<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />		
						<?}else{?>
							<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_small.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?}?>					
					</a>
					
					<div class="item-title">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>
					
					<?if( $arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]] || $arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]] ){?>
						<?$properties = array();?>
						<div class="markers">
								<?if($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]){?>
									<?
										$seasonClass = "";
										if (trim($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
										elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
										elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
									?>
									<?if (strlen($seasonClass)):?>
										<span class="marker-<?=$seasonClass?>"></span>
										<?$properties[] = trim($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]);?>
									<?else:?>
										<?$properties[] = trim($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]);?>
									<?endif;?>
								<?}?>
								<?if( $arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]] ){?>
									<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]]["VALUE"]!=false):?>
										<?$properties[] = GetMessage("SHIP"); ?>
										<span class="marker-ship"></span>
									<?endif;?>
								<?}?>
								<? $str = ""; if (count($properties)>1){$str = $properties[0].", ".strtolower($properties[1]);} else {$str=$properties[0];}?>
								<span class="properties_text"><?=$str;?></span>
						</div>	
					<?}?>
									
					
					<div class="cost">
						<?$count_in_stores = 0;?>
						<?if( $arItem["OFFERS"]){?> 
							<?foreach( $arItem["OFFERS"] as $arOffer ){$count_in_stores += $arOffer["CATALOG_QUANTITY"];}?>
							<?if (CSite::InDir(SITE_DIR.'search/tires') || CSite::InDir(SITE_DIR.'search/wheels') || CSite::InDir(SITE_DIR.'catalog/tires') || CSite::InDir(SITE_DIR.'catalog/wheels')):?>
								<span class="offers_error"><?=GetMessage("OFFERS_ERROR");?></span>
							<?else:?>
								<?=GetMessage("FROM")?> 
								<?
									$symb =substr($arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"], strrpos($arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"], ' '));
									echo str_replace($symb, "", $arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"])."<span>".$symb."</span>";
								?>
							<?endif;?>
						<?} elseif ( $arItem["PRICES"] ){?>
							<?	
								$count_in_stores = $arItem["CATALOG_QUANTITY"];
								$arCountPricesCanAccess = 0;
								foreach( $arItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
							?>
							<?foreach( $arItem["PRICES"] as $key => $arPrice ){?>
								<?if( $arPrice["CAN_ACCESS"] && $arItem["CATALOG_QUANTITY"] > 0 ){?>
									<?$price = CPrice::GetByID($arPrice["ID"]); ?>
									<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
									<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
										<div class="price_value">
											<?
												$symb =substr($arPrice["PRINT_DISCOUNT_VALUE"], strrpos($arPrice["PRINT_DISCOUNT_VALUE"], ' '));
												echo str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<span>".$symb."</span>";
											?>
										</div>
										<div class="prompt-discont">
											<span><strike><span><?=$arPrice["PRINT_VALUE"]?></strike></span>
										</div>
									<?}else{?>
										<div class="price_value">
											<?
												$symb =substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));
												echo str_replace($symb, "", $arPrice["PRINT_VALUE"])."<span>".$symb."</span>";
											?>
										</div>
									<?}?>
								<?}?>
							<?}?>				
						<?}else{?>
							<span class="by_order"><?=GetMessage("BY_ORDER");?></span>
						<?}?>
					</div>
					
					<!--noindex-->
					<div class="item_<?=$arItem["ID"]?>">

							<?if($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
								<span class="quantity-cell">
									<?if (!count($arItem["OFFERS"])){?>
										<?
											$sMeasure = GetMessage("MEASURE");
											if ($arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }
										?>
										<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
											<select name="counter" class="counter">
												<?
													$max_count = $count_in_stores;
													$max_count_settings = intval($arParams['MAX_COUNT']);
													if($max_count_settings != 0) $max_count = min($max_count, $max_count_settings);
													for($i=1;$i<=$max_count;$i++){
												?>
													<?if($max_count>=intval($arParams["DEFAULT_COUNT"])){?>
														<option value="<?=$i?>" <?=(($i==intval($arParams["DEFAULT_COUNT"])))? 'selected' : ''?>><?=$i?></option>
													<?}else{?>
														<option value="<?=$i?>" <?=(($i==$max_count))? 'selected' : ''?>><?=$i?></option>
													<?}?>
												<?}?>
											</select>										
											<span class="measure"><?=$sMeasure;?></span>
										<?}?>
									<?}?>
								</span>
							<?endif;?>
						
							<?if (!count($arItem["OFFERS"])){?>
								<!--noindex-->
									<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
										<a href="<?=$arItem["ADD_URL"]?>" data-item="<?=$arItem["ID"]?>" data-quantity="<?=($count_in_stores>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $count_in_stores; ?>" class="button25 basket to-cart" alt="<?=$arItem["NAME"]?>" rel="nofollow">
											<i></i>
											<span><?=GetMessage("TO_BASKET");?></span>
										</a>
										<a href="<?=SITE_DIR?>basket/" class="button25 basket in-cart" rel="nofollow" style="display:none;">
											<i></i>
											<span><?=GetMessage("IN_BASKET");?></span>
										</a>
									<?}else{?>
										<?=CTires::showOrderButton($arParams["ORDER_BUTTON_VIEW"], $arItem);?>
									<?}?>
								<!--/noindex-->
							<?}?>
						
					</div>
				<!--/noindex-->
				</div>
			<?}?>
			<div class="clearboth"></div>
		<?}?>
		
	</div>
	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
<?}else {?>
	<script>
		$(document).ready(function()
		{
			$(".catalog_display").hide();
			$("#no_products").show();
		});
	</script>
<?}?>

<script>
function EqHeight(){
	if ($(window).width()>=384){
		var textWrapper = $(".product-list-items .item .item-title").height();
		var textContent = $(".product-list-items .item .item-title a");
		$(textContent).each(function(){
			if ($(this).outerHeight()>textWrapper){
				$(this).text(function (index, text) { return text.replace(/\W*\s(\S)*$/, '...'); });
			}
		});	
		$('.product-list-items').equalize({children: '.item .cost', reset: true}); 
		$('.product-list-items').equalize({children: '.item .item-title', reset: true}); 
		$('.product-list-items').equalize({children: '.item', reset: true}); 
	}
	else{
		$(".product-list-items .item").removeAttr("style");
		$(".product-list-items .item .item-title").removeAttr("style");
		$(".product-list-items .item .cost").removeAttr("style");
	}
}

	
$(document).ready(function() {
	EqHeight();
});

var resizeTimer = null;
$(window).resize(function () {
	if(resizeTimer){
		clearTimeout(resizeTimer);
	}
	resizeTimer = setTimeout(function() {
		EqHeight();
	}, 300);
	EqHeight();
});
</script>
