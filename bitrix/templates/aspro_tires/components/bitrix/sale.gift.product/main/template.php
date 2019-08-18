<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin();

$injectId = 'sale_gift_product_'.rand();

$currentProductId = (int)$arResult['POTENTIAL_PRODUCT_TO_BUY']['ID'];

if (isset($arResult['REQUEST_ITEMS']))
{
	CJSCore::Init(array('ajax'));

	// component parameters
	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParameters = $signer->sign(
		base64_encode(serialize($arResult['_ORIGINAL_PARAMS'])),
		'bx.sale.gift.product'
	);
	$signedTemplate = $signer->sign($arResult['RCM_TEMPLATE'], 'bx.sale.gift.product');

	?>

	<span id="<?=$injectId?>" class="sale_gift_product_container"></span>

	<script type="text/javascript">
		BX.ready(function(){

			var currentProductId = <?=CUtil::JSEscape($currentProductId)?>;
			var giftAjaxData = {
				'parameters':'<?=CUtil::JSEscape($signedParameters)?>',
				'template': '<?=CUtil::JSEscape($signedTemplate)?>',
				'site_id': '<?=CUtil::JSEscape(SITE_ID)?>'
			};

			bx_sale_gift_product_load(
				'<?=CUtil::JSEscape($injectId)?>',
				giftAjaxData
			);

			BX.addCustomEvent('onCatalogStoreProductChange', function(offerId){
				if(currentProductId == offerId)
				{
					return;
				}
				currentProductId = offerId;
				bx_sale_gift_product_load(
					'<?=CUtil::JSEscape($injectId)?>',
					giftAjaxData,
					{offerId: offerId}
				);
			});
		});
	</script>

	<?
	$frame->end();
	return;
}

if (!empty($arResult['ITEMS'])){
	$templateData = array(
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);
	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS'])){
		$arSkuTemplate=CTires::GetSKUPropsArray2($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "block", $arParams["OFFER_HIDE_NAME_PROPS"], "Y");
	}?>
	<script type="text/javascript">
		BX.message({
			CVP_MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY_GIFT')); ?>',
			CVP_MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

			CVP_MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',

			CVP_MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
			CVP_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
			CVP_BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
			CVP_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
			CVP_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
			CVP_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
			CVP_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
			CVP_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
			CVP_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
			CVP_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
		});
	</script>
	<div class="bx_item_list_you_looked_horizontal tabs_content gift_block <? echo $templateData['TEMPLATE_CLASS']; ?>">
			<?if(empty($arParams['HIDE_BLOCK_TITLE']) || $arParams['HIDE_BLOCK_TITLE'] == 'N'){?>
				<div class="top_block">
					<div class="title_block"><?=($arParams['BLOCK_TITLE'] ? htmlspecialcharsbx($arParams['BLOCK_TITLE']) : GetMessage('SGP_TPL_BLOCK_TITLE_DEFAULT'));?></div>
				</div>
			<?}?>
		<div class="module-products-corusel product-list-items common_product wrapper_block" id="<?=$injectId?>_items">
				<div class="viewed_navigation slider_navigation top_big custom_flex border"></div>
			<div class="top_slider_wrapp">
				<ul class="corusel-list">
					<?
					$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
					$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
					$elementDeleteParams = array('CONFIRM' => GetMessage('CVP_TPL_ELEMENT_DELETE_CONFIRM'));
					?>
					<?foreach($arResult['ITEMS'] as $key => $arItem){
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $elementEdit);
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
						$arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
						$arItemIDs=CTires::GetItemsIDs($arItem);

						$strMeasure = '';
						$totalCount = CTires::GetTotalCount($arItem);
						// $arQuantityData = CTires::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);
						if(!$arItem["OFFERS"]){
							if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
								$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
								$strMeasure = $arMeasure["SYMBOL_RUS"];
							}
							// $arAddToBasketData = CTires::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
						}
						elseif($arItem["OFFERS"]){
							$strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
							if(!$arItem['OFFERS_PROP']){

								// $arAddToBasketData = CTires::GetAddToBasketArray($arItem["OFFERS"][0], $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
							}
						}
						?>
						<li class="item" id="<?=$arItem["strMainID"];?>">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
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

							<?if( $arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]] || $arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]] ){?>
								<?$properties = array();?>
								<div class="markers">
									<?if($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]){?>
										<?
											$seasonClass = "";
											if (trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
											elseif (trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
											elseif (trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
										?>
										<?if (strlen($seasonClass)):?>
											<span class="marker-<?=$seasonClass?>"></span>
											<?$properties[] = trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]);?>
										<?else:?>
											<?$properties[] = trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]);?>
										<?endif;?>
									<?}?>
									<?if( $arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]] ){?>
										<?if ($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]]["VALUE"]!=false):?>
											<?$properties[] = GetMessage("SHIP"); ?>
											<span class="marker-ship"></span>
										<?endif;?>
									<?}?>
									<? $str = ""; if (count($properties)>1){$str = $properties[0].", ".strtolower($properties[1]);} else {$str=$properties[0];}?>
									<span class="properties_text"><?=$str;?></span>
								</div>	
							<?}?>

							<div class="cost<?if(!$arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]] && !$arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]] ):?> fix<?endif;?>">
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
						</li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
	<script>
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
				controlsContainer: ".viewed_navigation",
				start: function(slider) { topProductsBanner.resize(); carouselEqualizeheights(); },
				before: function(slider) { topProductsBanner.resize(); },
			});
			
			$(window).resize(function () 
			{
				// waitForFinalEvent(function() { topProductsBanner.resize(); }, 333, fRand());
			});
		});
	</script>
<?}?>
<?$frame->beginStub();?>
<?$frame->end();?>