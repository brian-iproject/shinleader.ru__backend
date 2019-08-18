<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="top_slider_wrapp">
	<ul class="corusel-list">
		<?foreach( $arResult["ITEMS"] as $arItem ){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
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
					<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $arItem["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "IBLOCK_SECTION_ID"))->GetNext();?>
					
					<?if(!empty($arItem["DETAIL_PICTURE"])){?>
						<?$img=CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>130, 'height'=>130), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<img border="0" src="<?=$img["src"]?>" width="<?=$img["width"]?>" height="<?=$img["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					<?}elseif( !empty($arSection["DETAIL_PICTURE"]) ){?>
						<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array( "width" => 130, "height" => 130 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />									
					<?}elseif( !empty($arSection["PICTURE"]) ){?>
						<?$img = CFile::ResizeImageGet($arSection["PICTURE"], array( "width" => 130, "height" => 130 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />									
					<?}else{?>
						<img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage_small.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					<?}?>
				</a>
				<div class="item-title">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				</div>			
				
				<?if( $arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]] || $arItem["DISPLAY_PROPERTIES"][$arParams["SHIPY"]] ){?>
					<?$properties = array();?>
					<div class="markers">
						<?if($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"]){?>
							<?
								$seasonClass = "";
								if (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
								elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
								elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
							?>
							<?if (strlen($seasonClass)):?>
								<span class="marker-<?=$seasonClass?>"></span>





								<?$properties[] = trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"]);?>
							<?else:?>
								<?$properties[] = trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"]);?>
							<?endif;?>
						<?}?>
						<?if( $arItem["DISPLAY_PROPERTIES"][$arParams["SHIPY"]] ){?>
							<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["SHIPY"]]["VALUE"]!=false):?>
								<?$properties[] = GetMessage("SHIP"); ?>
								<span class="marker-ship"></span>
							<?endif;?>
						<?}?>
						<? $str = ""; if (count($properties)>1){$str = $properties[0].", ".strtolower($properties[1]);} else {$str=$properties[0];}?>
						<span class="properties_text"><?=$str;?></span>
					</div>	
				<?}?>
							
				

				<div class="cost<?if(!$arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]] && !$arItem["DISPLAY_PROPERTIES"][$arParams["SHIPY"]] ):?> fix<?endif;?>">
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
							<?if( $arPrice["CAN_ACCESS"] ){?>
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
				
				<?if($arParams["SHOW_BUY_BUTTONS"]=="Y"){?>
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
												<span class="measure">
													&nbsp;<?=$sMeasure;?>
												</span>
											<?}?>
										<?}?>
									</span>
								<?endif;?>
							
								<?if (!count($arItem["OFFERS"])){?>
									<!--noindex-->
										<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
											<a href="#" data-item="<?=$arItem["ID"]?>" data-quantity="<?=($count_in_stores>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $count_in_stores; ?>" class="button25 basket to-cart" alt="<?=$arItem["NAME"]?>" rel="nofollow">
												<i></i>
												<span><?=GetMessage("TO_BASKET");?></span>
											</a>
											<a href="<?=SITE_DIR?>basket/" class="button25 basket in-cart" rel="nofollow" style="display:none;">
												<i></i>
												<span><?=GetMessage("IN_BASKET");?></span>
											</a>
										<?}else{?>
											<a class="button25 order-button" alt="<?=$arItem["NAME"]?>" rel="nofollow" title="<?=$arItem["NAME"]?>">
												<i></i>
												<span><?=GetMessage("ORDER");?></span>
											</a>
										<?}?>
									<!--/noindex-->
								<?}?>
							
						</div>
					<!--/noindex-->
				<?}?>
				
			</li>
		<?}?>
	</ul>


</div>
<div class="slider_navigation"></div>

<script type="text/javascript">

	var fRand = function() {return Math.floor(arguments.length > 1 ? (999999 - 0 + 1) * Math.random() + 0 : (0 + 1) * Math.random());};
	
	var waitForFinalEvent = (function () 
	{
	  var timers = {};
	  return function (callback, ms, uniqueId) 
	  {
		if (!uniqueId) {
		  uniqueId = fRand();
		}
		if (timers[uniqueId]) {
		  clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	  };
	})();


	$(document).ready(function()
	{
		var topProductsBanner = $(".top_slider_wrapp").flexslider({
			animation: "slide",
			slideshow: false,
			slideshowSpeed: 10000,
			animationSpeed: 600,
			selector: ".corusel-list > li",
			animationLoop: false,
			directionNav: true,
			controlNav: false,
			itemWidth: 168,                
			itemMargin: 15, 
			pauseOnHover: true,
			controlsContainer: ".slider_navigation",
			start: function(slider) { topProductsBanner.resize(); },
			before: function(slider) { topProductsBanner.resize(); },
		});
		
		$(window).resize(function () 
		{
			waitForFinalEvent(function() { topProductsBanner.resize(); }, 333, fRand());
		});
	});
</script>