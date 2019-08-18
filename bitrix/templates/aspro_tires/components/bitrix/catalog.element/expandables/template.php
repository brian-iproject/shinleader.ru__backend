<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


<script type="text/javascript">
	$(function(){
		$('.main-fotos li').hide().first().show();
		$('.fotos-thumbs li').first().addClass('cur');
		$('.fotos-thumbs ').delegate('li:not(.cur)', 'click', function() {
			$(this).addClass('cur').siblings().removeClass('cur')
			.parents('.module-fotos').find('.main-fotos li').eq($(this).index()).addClass('visible').fadeIn().siblings('li').removeClass('visible').fadeOut();
		})
	})
</script>

<?
	$images=array();
	$images=(!empty($arResult["PROPERTIES"]["OTHER_PHOTO"]["VALUE"]))? $arResult["PROPERTIES"]["OTHER_PHOTO"]["VALUE"] : $arResult["SECTION_FULL"]["UF_MORE_FILES"];
	if(!empty($arResult["SECTION_FULL"]["DETAIL_PICTURE"]) && empty($arResult["DETAIL_PICTURE"]))
		{array_unshift($images, $arResult["SECTION_FULL"]["DETAIL_PICTURE"]);}
	elseif(!empty($arResult["DETAIL_PICTURE"]))
		{array_unshift($images, $arResult["DETAIL_PICTURE"]["ID"]);}
	else{$images=array();}
	foreach ($images as $key=>$image) { if (!$image) {unset($images[$key]);} }

	$productsMeasure = GetMessage("MEASURE_DEFAULT");
	if ($arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"])
	{$productsMeasure = $arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"];}
	$productsMeasure.=".";
?>

<article class="article-product no-pl detail expendables">
	<div class="module-fotos<?if(count($images)>1):?> more_files_block<?endif;?>">
		<div class="ribbons">
			 <?if( $arResult["PROPERTIES"]["KHIT_PRODAZH"]["VALUE"]):?><span class="ribon-hit"></span><?endif;?>
			<?if( $arResult["PROPERTIES"]["NOVINKA"]["VALUE"]):?><span class="ribon-new"></span><?endif;?>
			<?if( $arResult["PROPERTIES"]["AKTSIYA"]["VALUE"]):?><span class="ribon-share"></span><?endif;?>
		</div>

		<?if( !empty( $images ) ){?>
			<?$img_big = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 284, "height" => 284 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
			<ul class="main-fotos">
				<?foreach($images as $arPhoto){?>
					<?$img_photo_big = CFile::ResizeImageGet( $arPhoto, array( "width" => 284, "height" => 284 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
					<?$img_photo_main = CFile::ResizeImageGet( $arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
					<li>
						<a class="fancy" data-fancybox-group="t"   href="<?=$img_photo_main["src"]?>">
							<span class="zoom"><i></i></span>
							<img src="<?=$img_photo_big["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
						</a>
					</li>
				<?}?>
			</ul>

			<?if(count($images)>1){?>
				<ul class="fotos-thumbs">
					<?foreach($images as $arPhoto){?>
						<?$img_photo_small = CFile::ResizeImageGet( $arPhoto, array( "width" => 67, "height" => 67 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
						<li>
							<div class="triangle"></div>
							<a><span class="helper"></span>
								<img src="<?=$img_photo_small["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
							</a>
						</li>
					<?}?>
				</ul>

				<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.bxslider.min.js',true)?>
				<script>
					$(document).ready(function()
					{
						$('.main-fotos li').hide().first().show();
						$('.fotos-thumbs li').first().addClass('cur');
						$('.fotos-thumbs ').delegate('li:not(.cur)', 'click', function()
						{
							$(this).parents('.module-fotos').find('.main-fotos li').removeClass('visible').hide();
							$(this).addClass('cur').siblings().removeClass('cur').parents('.module-fotos').find('.main-fotos li').eq($(this).index()).addClass('visible').show();
						})
						$('.fotos-thumbs').bxSlider({
							mode: 'vertical',
							autoHover: true,
							touchEnabled: true,
							oneToOneTouch: true,
							preventDefaultSwipeX: true,
							preventDefaultSwipeY: false,
							slideWidth: 75,
							minSlides: 3,
							slideMargin: 10,
							infiniteLoop: false,
							hideControlOnEnd: true,
							pager: true
						});
						if ($(".bx-wrapper .bx-pager-link").length<=1) { $(".bx-wrapper .bx-controls-direction").hide(); }
					});
				</script>
			<?}?>


		<?}elseif(!empty($arResult["DETAIL_PICTURE"])){?>
			<ul class="main-fotos">
				<?$img = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 284, "height" => 284 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
				<li>
					<a class="fancy" data-fancybox-group="t"  href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
						<span class="zoom"><i></i></span>
						<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
					</a>
				</li>
			</ul>
		<?}else{?>
			<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE"))->GetNext();?>
			<ul class="main-fotos"><li>
				<?if( !empty($arSection["DETAIL_PICTURE"])){?>
					<?$img = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array( "width" => 284, "height" => 284 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
					<a class="fancy" data-fancybox-group="t"   href="<?=CFile::GetPath($arSection["DETAIL_PICTURE"])?>">
						<span class="zoom"><i></i></span>
						<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
					</a>
				<?}elseif( !empty($arSection["PICTURE"])){?>
					<?$img = CFile::ResizeImageGet($arSection["PICTURE"], array( "width" => 284, "height" => 284 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
					<a class="fancy" data-fancybox-group="t"   href="<?=CFile::GetPath($arSection["PICTURE"])?>">
						<span class="zoom"><i></i></span>
						<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
					</a>
				<?}else{?>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_big.png" alt="<?=$arResult["NAME"]?>" width="284" height="284" title="<?=$arResult["NAME"]?>" />
				<?}?>
			</li></ul>
		<?}?>
	</div>



	<div class="info detail <?if(count($images)>1):?> more_files_block<?endif;?>">
		<table class="info-main-block"><tr><td class="info-main-block-top">
			<div class="info-top">
				<?if ($arParams["USE_RATING"]=="Y"){?>
					<div class="rating">
						<div class="rating-wrapp">
							<?if ($arResult["SECTION_FULL"]["DEPTH_LEVEL"]==2){?>
								<?$APPLICATION->IncludeComponent(
								   "aspro:iblock.vote",
								   "section_rating",
								   Array(
									  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									  "IBLOCK_ID" => $arResult["IBLOCK_ID"],
									  "ELEMENT_ID" =>$arResult["IBLOCK_SECTION_ID"],
									  "MAX_VOTE" => 5,
									  "VOTE_NAMES" => array(),
									  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
									  "CACHE_TIME" => $arParams["CACHE_TIME"],
									  "DISPLAY_AS_RATING" => 'vote_avg'
								   ),
								   $component, array("HIDE_ICONS" =>"Y")
								);?>
							<?} elseif ($arResult["SECTION_FULL"]["DEPTH_LEVEL"]==1){?>
								<?$APPLICATION->IncludeComponent(
								   "bitrix:iblock.vote",
								   "element_rating",
								   Array(
									  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									  "IBLOCK_ID" => $arResult["IBLOCK_ID"],
									  "ELEMENT_ID" =>$arResult["ID"],
									  "MAX_VOTE" => 5,
									  "VOTE_NAMES" => array(),
									  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
									  "CACHE_TIME" => $arParams["CACHE_TIME"],
									  "DISPLAY_AS_RATING" => 'vote_avg'
								   ),
								   $component, array("HIDE_ICONS" =>"Y")
								);?>
							<?}?>
						</div>
					</div>
				<?}?>
			</div>

			<div class="info-left">

				<div class="options">
					<ul class="list">
						<?foreach ($arResult["DISPLAY_PROPERTIES"] as $key => $property){?>
							<?if(!empty($property["VALUE"]) && !array_key_exists($property["CODE"],$arParams["MATCHING_ELEMENT_PROPERTIES"]) && (!in_array($property["CODE"], array("KHIT_PRODAZH", "NOVINKA", "AKTSIYA", "VIDEO_YOUTUBE")))):?>
								<li>
									<span class="key"><span><?=$property["NAME"];?></span></span>
									<span class="value"><?=$property["VALUE"]?></span>
								</li>
							<?endif;?>
						<?}?>
					</ul>
				</div>

			</div>

			<div class="info-right">

				<?if($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]){?>
					<div class="articul"><?=GetMessage("ARTICUL")?> <span class="value"><?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span></div>
				<?}?>

				<?
					$totalCount = 0;
					if( count( $arResult["OFFERS"] ) ) { foreach( $arResult["OFFERS"] as $key => $arOffer ){$totalCount+=$arOffer["CATALOG_QUANTITY"];} }
					elseif( count( $arResult["PRICES"] ) )	{ $totalCount=$arResult["CATALOG_QUANTITY"]; }
				?>

				<?if ($arParams["USE_STORE"]=="Y"):?>
					<div class="availability-row">
						<div class="label">
							<?if($totalCount){?>
								<?
									$sMeasure = GetMessage("MEASURE_DEFAULT").".";
									if ($arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }

									$amount = $totalCount;
									$indicators = 0;
									if(($arParams["USE_MIN_AMOUNT"] == 'Y')&&($arParams["USE_ONLY_MAX_AMOUNT"]=="Y"))
									{
										if(intval($amount) > $arParams["MAX_AMOUNT"]) { $amount = GetMessage("MANY_GOODS"); $indicators = 3; }
										elseif(intval($amount) >= $arParams["MIN_AMOUNT"]) { $amount = $totalCount.'&nbsp;'.$sMeasure; $indicators = 2; }
										elseif(intval($amount) < $arParams["MIN_AMOUNT"]) { $amount =$totalCount.'&nbsp;'.$sMeasure; $indicators = 1; }
									}
									elseif($arParams["USE_MIN_AMOUNT"] == 'Y')
									{
										if(intval($amount) > $arParams["MAX_AMOUNT"]) { $amount = GetMessage("MANY_GOODS"); $indicators = 3; }
										elseif(intval($amount) >= $arParams["MIN_AMOUNT"]) { $amount = GetMessage("SUFFICIENT_GOODS"); $indicators = 2; }
										elseif(intval($amount) < $arParams["MIN_AMOUNT"]) { $amount = GetMessage("FEW_GOODS"); $indicators = 1; }
									}
									else
									{
										$amount = $totalCount.'&nbsp;'.$sMeasure;
										for($i=1;$i<=3;$i++) {if (($totalCount/3) >$i){$indicators++;} }
									}
								?>

								<div class="t"><?=GetMessage("AVAILABLE");?></div>
								<div class="indicators">
									<?for($i=1;$i<=3;$i++){?>
										<span class="<?=(($indicators) >=$i) ? 'r' : ''?><?=($i==1) ? ' first' : ''?>"></span>
									<?}?>
								</div>
								<span class="value"><?=$amount?></span>
							<?}else{?>
								<?=GetMessage("BY_ORDER");?>
							<?}?>
						</div>
					</div>
				<?endif;?>

				<div class="share-block detail<?if($arParams["USE_STORE"]!="Y"):?> first<?endif;?>">
					<div class="t"><?=GetMessage("SHARE");?></div>
					<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
					<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div>
				</div>

			</div>

		</td></tr><tr><td class="info-main-block-bottom">

		<div class="info-dsc clearfix<?if( $arResult["OFFERS"] && (($arParams["SKU_DISPLAY_LOCATION"]=="RIGHT") || !$arParams["SKU_DISPLAY_LOCATION"]) ){echo " no_bg";}?>">
					<?
						$basePrice = CCatalogGroup::GetBaseGroup();
						$base_price_code = $basePrice["NAME"];
						$discount_price_code = $arParams["DISCOUNT_PRICE_CODE"];
					?>
					<div class="in-cart-bar">
						<div class="shell">

							<?if( $arResult["OFFERS"]){?>
								<?if(($arParams["SKU_DISPLAY_LOCATION"]=="RIGHT") || !$arParams["SKU_DISPLAY_LOCATION"] ){?>
									<div class="item_<?=$arResult["ID"]?>">
										<div class="cost-cell<?if( $arResult["OFFERS"] && (($arParams["SKU_DISPLAY_LOCATION"]=="RIGHT") || !$arParams["SKU_DISPLAY_LOCATION"]) ){echo " offers";}?>">
										<table class="module-products-list" cellspacing="0" cellpadding="0">
											<thead>
												<tr class="colored">
													<?foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?><th><?=$arProp["NAME"]?></th><?}?>
													<th class="price-th"><?=GetMessage("CATALOG_PRICE")?></th>
													<?if ($arParams["SHOW_QUANTITY"]!="N"){?><th class="offer_count"><?=GetMessage("AVAILABLE")?></th><?}?>
													<th <?if ($arParams["SHOW_QUANTITY"]!="N"){echo 'colspan="2"';}?>></th>
												</tr>
											</thead>
											<tbody>
												<?$numProps = count($arResult["SKU_PROPERTIES"]);?>
												<?foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
													<tr>
														<?for( $i = 0; $i < $numProps; $i++ ){?>
															<td><?=!empty( $arSKU[$i] ) ? $arSKU[$i] : GetMessage('NOT_PROP')?></td>
														<?}?>
														<td class="price-cell">
															<?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
																<span class="new"><?=$arSKU["DISCOUNT_PRICE"]?></span> <span class="old"><?=$arSKU["PRICE"]?></span>
															<?}else{?>
																<?
																	$symb =substr($arSKU["PRICE"], strrpos($arSKU["PRICE"], ' '));
																	echo str_replace($symb, "", $arSKU["PRICE"])."<span>".$symb."</span>";
																?>
															<?}?>
														</td>
														<?
															$count_in_stores = $arSKU["CATALOG_QUANTITY"];
															$sMeasure = GetMessage("MEASURE");
															if ($arSKU["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arSKU["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }
														?>
														<?if ($arParams["SHOW_QUANTITY"]!="N"){?>
															<td class="availability-cell">
																<?if($arParams["USE_STORE"] == "Y"):?><a class="show_offers_stores pseudo" onclick="return showOffersStores('<?=$arSKU["ID"]?>');"><?endif;?>
																	<?
																		$amount = $count_in_stores;
																		if(($arParams["USE_MIN_AMOUNT"] == 'Y')&&($arParams["USE_ONLY_MAX_AMOUNT"]=="Y"))
																		{
																			if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
																			elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																			elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
																			elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																		}
																		elseif($arParams["USE_MIN_AMOUNT"] == 'Y')
																		{
																			if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
																			elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.GetMessage("SUFFICIENT_GOODS").'</span>';
																			elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
																			elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.GetMessage("FEW_GOODS").'</span>';
																		}
																		else
																		{
																			if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																			elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																			elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																			elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
																		}
																	?>
																	<?=$amount;?>
																<?if($arParams["USE_STORE"] == "Y"):?></a><?endif;?>
															</td>
														<?}?>

														<!--noindex-->
															<?if( $arSKU["CAN_BUY"] ){?>
																<?if($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
																	<td class="quantity-cell">
																		<?if( intval($count_in_stores) > 0){?>
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
																	</td>
																<?endif;?>
																<td class="buy-cell">
																	<a href="<?=$arSKU["ADD_URL"]?>" data-item="<?=$arSKU["ID"]?>" data-quantity="<?=($count_in_stores>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $count_in_stores; ?>" class="button25 basket to-cart gradient" alt="<?=$arResult["NAME"]?>" rel="nofollow">
																		<i></i><span><?=GetMessage("TO_BASKET");?></span>
																	</a>
																	<a href="<?=SITE_DIR?>basket/" class="button25 basket in-cart gradient" rel="nofollow" style="display:none;">
																		<i></i><span><?=GetMessage("IN_BASKET")?></span>
																	</a>
																	<a class="b25 button_one_click_buy gradient" rel="nofollow" onclick="oneClickBuy('<?=$arSKU["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>')">
																		<span><?=GetMessage("ONE_CLICK_BUY");?></span>
																	</a>
																</td>
															<?}else{?>
																<td  class="buy-cell">
																	<?=CTires::showOrderButton($arParams["ORDER_BUTTON_VIEW"], $arSKU, "button25 gradient");?>
																</td>
															<?}?>
														<!--/noindex-->
													</tr>
												<?}?>
											</tbody>
										</table>
										</div>
										<div class="clearboth"></div>

									</div>
								<?}else{?>
									<div class="cost-cell"><div class="now">
											<div class="price_wrapp"><?=GetMessage("FROM");?>&nbsp;<?=$arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></div>
											<div class="clearboth"></div>
									</div></div>
								<?}?>
							<?}elseif ( $arResult["PRICES"] && $totalCount){?>
								<div class="item_<?=$arResult["ID"]?>">
									<div class="cost-cell">
										<?
											$arCountPricesCanAccess = 0;
											foreach( $arResult["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
										?>
										<div class="now">
											<div class="price_wrapp">
												<?foreach( $arResult["PRICES"] as $key => $arPrice ){?>
													<?if( $arPrice["CAN_ACCESS"] ){?>
														<?$price = CPrice::GetByID($arPrice["ID"]); ?>
														<div class="price">
															<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
															<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
																<div class="price_value"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
																<div class="prompt-discont"><?=GetMessage("WITHOUT_DISCOUNT");?>
																	<span>&nbsp;<strike><span><?=$arPrice["PRINT_VALUE"]?></span></strike></span>
																</div>
															<?}else{?>
																<div class="price_value"><?=$arPrice["PRINT_VALUE"]?></div>
															<?}?>
														</div>
													<?}?>
												<?}?>
											</div>
											<?if($arParams["USE_PRODUCT_QUANTITY"]){?>
												<?if(  ($arResult["CATALOG_QUANTITY"]>0) && $arResult["CAN_BUY"] ){ ?>

													<span class="counter-wrapp<?if($arCountPricesCanAccess>1):?> fix<?endif;?>">
														<span class="x"></span><select name="counter" class="counter">
															<?
																$max_count = $arResult["CATALOG_QUANTITY"];
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
														<span class="measure"><?=$productsMeasure;?></span>
													</span>
												<?}?>
											<?}?>
											<?if($arResult["CAN_BUY"]){?>
												<div class="but-cell item_<?=$arResult["ID"]?><?if($arCountPricesCanAccess>1):?> fix<?endif;?>">
													<!--noindex-->
														<a href="<?=$arResult["ADD_URL"]?>" data-item="<?=$arResult["ID"]?>" data-quantity="<?=($max_count>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $max_count; ?>" class="button_basket gradient to-cart" alt="<?=$arResult["NAME"]?>" rel="nofollow">
															<i></i><span><?=GetMessage("TO_BASKET");?></span>
														</a>
														<a href="<?=SITE_DIR?>basket/" class="button_basket gradient in-cart" rel="nofollow" style="display:none;">
															<i></i><span><?=GetMessage("IN_BASKET")?></span>
														</a>
														<a class="button_one_click_buy gradient" rel="nofollow" onclick="oneClickBuy('<?=$arResult["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>')">
															<span><?=GetMessage("ONE_CLICK_BUY");?></span>
														</a>
													<!--/noindex-->
												</div>
											<?}?>
											<div class="clearboth"></div>
										</div>
									</div>
								</div>
							<?}else{?>
								<?if($arParams["ORDER_BUTTON_VIEW"]=="order"){?>
									<div class="item_<?=$arResult["ID"]?>">
										<div class="cost-cell">
											<div class="but-cell by_order">
												<div class="now">
													<?=CTires::showOrderButton($arParams["ORDER_BUTTON_VIEW"], $arResult, "button_basket gradient", "Y");?>
												</div>
											</div>
										</div>
									</div>
								<?}?>
							<?}?>
						</div>
					</div>
		</div>
		</td></tr></table>

	</div>
</article>

<?if( $arResult["OFFERS"] && ($arParams["SKU_DISPLAY_LOCATION"]=="BOTTOM")){?>
	<div class="offers_wrapp">
		<div class="item_<?=$arResult["ID"]?>">
			<div class="cost-cell<?if( $arResult["OFFERS"] && (($arParams["SKU_DISPLAY_LOCATION"]=="RIGHT") || !$arParams["SKU_DISPLAY_LOCATION"]) ){echo " offers";}?>">
			<table class="module-products-list" cellspacing="0" cellpadding="0">
				<thead>
					<tr class="colored">
						<?foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?><th><?=$arProp["NAME"]?></th><?}?>
						<th class="price-th"><?=GetMessage("CATALOG_PRICE")?></th>
						<?if ($arParams["SHOW_QUANTITY"]!="N"){?><th class="offer_count"><?=GetMessage("AVAILABLE")?></th><?}?>
						<th <?if ($arParams["SHOW_QUANTITY"]!="N"){echo 'colspan="2"';}?>></th>
					</tr>
				</thead>
				<tbody>
					<?$numProps = count($arResult["SKU_PROPERTIES"]);?>
					<?foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
						<tr>
							<?for( $i = 0; $i < $numProps; $i++ ){?>
								<td><?=!empty( $arSKU[$i] ) ? $arSKU[$i] : GetMessage('NOT_PROP')?></td>
							<?}?>
							<td class="price-cell">
								<?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
									<span class="new"><?=$arSKU["DISCOUNT_PRICE"]?></span> <span class="old"><?=$arSKU["PRICE"]?></span>
								<?}else{?>
									<?
										$symb =substr($arSKU["PRICE"], strrpos($arSKU["PRICE"], ' '));
										echo str_replace($symb, "", $arSKU["PRICE"])."<span>".$symb."</span>";
									?>
								<?}?>
							</td>
							<?
								$count_in_stores = $arSKU["CATALOG_QUANTITY"];
								$sMeasure = GetMessage("MEASURE");
								if ($arSKU["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arSKU["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }
							?>
							<?if ($arParams["SHOW_QUANTITY"]!="N"){?>
								<td class="availability-cell">
									<?if($arParams["USE_STORE"] == "Y"):?>
										<a class="show_offers_stores pseudo" form-class="show_offers_stores" onclick="return showOffersStores('<?=$arSKU["ID"]?>');">
									<?endif;?>
										<?
											$amount = $count_in_stores;
											if(($arParams["USE_MIN_AMOUNT"] == 'Y')&&($arParams["USE_ONLY_MAX_AMOUNT"]=="Y"))
											{
												if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
											}
											elseif($arParams["USE_MIN_AMOUNT"] == 'Y')
											{
												if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.GetMessage("SUFFICIENT_GOODS").'</span>';
												elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.GetMessage("FEW_GOODS").'</span>';
											}
											else
											{
												if(intval($amount) > $arParams["MAX_AMOUNT"])	$amount = '<span class="many">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) == 0)						$amount = '<span class="under_order">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])	$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
											}
										?>
										<?=$amount;?>
									<?if($arParams["USE_STORE"] == "Y"):?></a><?endif;?>
								</td>
							<?}?>

							<!--noindex-->
								<?if( $arSKU["CAN_BUY"] ){?>
									<?if($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
										<td class="quantity-cell">
											<?if( intval($count_in_stores) > 0){?>
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
										</td>
									<?endif;?>
									<td class="buy-cell">
										<a href="<?=$arSKU["ADD_URL"]?>" data-item="<?=$arSKU["ID"]?>" data-quantity="<?=($count_in_stores>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $count_in_stores; ?>" class="button25 basket to-cart gradient" alt="<?=$arResult["NAME"]?>" rel="nofollow">
											<i></i><span><?=GetMessage("TO_BASKET");?></span>
										</a>
										<a href="<?=SITE_DIR?>basket/" class="button25 basket in-cart gradient" rel="nofollow" style="display:none;">
											<i></i><span><?=GetMessage("IN_BASKET")?></span>
										</a>
										<a class="b25 button_one_click_buy gradient" rel="nofollow" onclick="oneClickBuy('<?=$arSKU["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>')">
											<span><?=GetMessage("ONE_CLICK_BUY");?></span>
										</a>
									</td>
								<?}else{?>
									<td  class="buy-cell">
										<?=CTires::showOrderButton($arParams["ORDER_BUTTON_VIEW"], $arSKU, "button25 gradient");?>
									</td>
								<?}?>
							<!--/noindex-->
						</tr>
					<?}?>
				</tbody>
			</table>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
<?}?>

<form action="<?=SITE_DIR?>ajax/show_offer_stores.php" id="show_offers_stores">
	<?
		$arStoresParams = array(
			"PER_PAGE" => "10",
			"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
			"SCHEDULE" => $arParams["SCHEDULE"],
			"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
			"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
			"ELEMENT_ID" => $arSKU["ID"],
			"STORE_PATH"  =>  $arParams["STORE_PATH"],
			"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
			"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
			"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
			"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		);
		foreach($arStoresParams as $name => $value) { echo "<input type='hidden' name='".$name."' value='".$value."'/>"; }
	?>
</form>
<div class="offers_stores"></div>
<div class="one_click_buy_frame"></div>

<? if ($arParams["LINK_PROPERTY_SID"]&&$arResult["PROPERTIES"][$arParams["LINK_PROPERTY_SID"]]["VALUE"]):?>
	<div id="similar_products">
		<h2 class="similar_products"><?=GetMessage("SIMILAR_PRODUCTS");?></h2>
		<?$GLOBALS['arrFilterAssociated'] = array( "ID" => $arResult["PROPERTIES"][$arParams["LINK_PROPERTY_SID"]]["VALUE"] );
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"associated_slider",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ORDER_BUTTON_VIEW" => $arParams["ORDER_BUTTON_VIEW"],
				"SECTION_ID" => 0,
				"SECTION_CODE" => "",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"FILTER_NAME" => "arrFilterAssociated",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"PAGE_ELEMENT_COUNT" => "99999",
				"LINE_ELEMENT_COUNT" => 4,
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
				"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
				"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
				"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"ADD_SECTIONS_CHAIN" => "N",
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
				"OFFERS_CART_PROPERTIES" => array(),
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"AJAX_OPTION_ADDITIONAL" => "",
				"ADD_CHAIN_ITEM" => "N",
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			),
		$component
		);?>
	</div>
<?endif;?>

<?if ($arResult["DETAIL_TEXT"]||$arResult["SECTION_FULL"]["DESCRIPTION"]||($arParams["USE_REVIEW"]=="Y")||$arResult["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]||$arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"]||$arResult["SECTION_FULL"]["UF_VIDEO"]||$arResult["SECTION_FULL"]["UF_VIDEO_YOUTUBE"]||$arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]||$arResult["SECTION_FULL"]["UF_FILES"]):?>
	<div class="tabs-section">
		<div class="switcher-wrapp">
			<ul class="tabs">
				<?if ($arResult["DETAIL_TEXT"]||$arResult["SECTION_FULL"]["DESCRIPTION"]):?>
					<li>
						<a><?=GetMessage("DESCRIPTION");?></a>
						<div class="triangle"></div>
					</li>
				<?endif;?>
				<?if ($arResult["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]||$arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"]||$arResult["SECTION_FULL"]["UF_VIDEO"]||$arResult["SECTION_FULL"]["UF_VIDEO_YOUTUBE"]):?>
					<li>
						<a><?=GetMessage("VIDEO")?></a>
						<div class="triangle"></div>
					</li>
				<?endif;?>
				<?
					$arFiles = array();
					if ($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]) { $arFiles = $arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]; }
					else { $arFiles = $arResult["SECTION_FULL"]["UF_FILES"]; }
					foreach ($arFiles as $key => $value){if (!intval($value)){unset($arFiles[$key]);}}
				?>
				<?if (($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]||$arResult["SECTION_FULL"]["UF_FILES"]) && count($arFiles)):?>
					<li>
						<a><?=GetMessage("FILES")?></a>
						<div class="triangle"></div>
					</li>
				<?endif;?>
				<?if(($arParams["USE_STORE"] == "Y") && $arResult["STORES_COUNT"] && !$arResult["OFFERS"]):?>
					<li>
						<a><?=$arParams["MAIN_TITLE"];?></a>
						<div class="triangle"></div>
					</li>
				<?endif;?>
				<?if ($arParams["USE_REVIEW"]=="Y"):?>
					<li>
						<a><?=GetMessage("PRODUCT_REVIEWS");?></a>
						<div class="triangle"></div>
					</li>
				<?endif;?>
			</ul>
		</div>

		<div class="tabs-content">
			<ul>
				<?if ($arResult["DETAIL_TEXT"]||$arResult["SECTION_FULL"]["DESCRIPTION"]):?>
					<li>
						<?if ($arResult["DETAIL_TEXT"]):?>
							<?=$arResult["DETAIL_TEXT"]?>
						<?else:?>
							<!--noindex--><?=$arResult["SECTION_FULL"]["DESCRIPTION"]?><!--/noindex-->
						<?endif;?>
					</li>
				<?endif;?>

				<?if ($arResult["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]||$arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"]||$arResult["SECTION_FULL"]["UF_VIDEO"]||$arResult["SECTION_FULL"]["UF_VIDEO_YOUTUBE"]):?>
					<li class="video">
						<?if (!empty($arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"])):?>
							<?=$arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["~VALUE"];?>
						<?elseif (!empty($arResult["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"])):?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:player", "",
								Array(
								"PLAYER_TYPE" => "auto",
								"USE_PLAYLIST" => "N",
								"PATH" => CFile::GetPath($arResult['DISPLAY_PROPERTIES']["VIDEO"]["VALUE"]),
								"WIDTH" => "525",
								"HEIGHT" => "320",
								"PREVIEW" => "",
								"FILE_TITLE" => "",
								"FILE_DURATION" => "",
								"FILE_AUTHOR" => "",
								"FILE_DATE" => "",
								"FILE_DESCRIPTION" => "",
								"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
								"SKIN" => "glow.zip",
								"CONTROLBAR" => "none",
								"WMODE" => "transparent",
								"SHOW_CONTROLS" => "N",
								"SHOW_DIGITS" => "Y",
								"CONTROLS_BGCOLOR" => "FFFFFF",
								"CONTROLS_COLOR" => "000000",
								"CONTROLS_OVER_COLOR" => "000000",
								"SCREEN_COLOR" => "000000",
								"AUTOSTART" => "N",
								"REPEAT" => "none",
								"VOLUME" => "90",
								"ADVANCED_MODE_SETTINGS" => "Y",
								"PLAYER_ID" => "",
								"BUFFER_LENGTH" => "10",
								"DOWNLOAD_LINK" => "",
								"DOWNLOAD_LINK_TARGET" => "_self",
								"ADDITIONAL_WMVVARS" => "")
							);?>
						<?elseif (!empty($arResult["SECTION_FULL"]['UF_VIDEO_YOUTUBE'])):?>
							<?=$arResult["SECTION_FULL"]['~UF_VIDEO_YOUTUBE'];?>
						<?elseif (!empty($arResult["SECTION_FULL"]['UF_VIDEO'])):?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:player", "",
								Array(
								"PLAYER_TYPE" => "auto",
								"USE_PLAYLIST" => "N",
								"PATH" => CFile::GetPath($arResult["SECTION_FULL"]['UF_VIDEO']),
								"WIDTH" => "525",
								"HEIGHT" => "320",
								"PREVIEW" => "",
								"FILE_TITLE" => "",
								"FILE_DURATION" => "",
								"FILE_AUTHOR" => "",
								"FILE_DATE" => "",
								"FILE_DESCRIPTION" => "",
								"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
								"SKIN" => "glow.zip",
								"CONTROLBAR" => "none",
								"WMODE" => "transparent",
								"SHOW_CONTROLS" => "N",
								"SHOW_DIGITS" => "Y",
								"CONTROLS_BGCOLOR" => "FFFFFF",
								"CONTROLS_COLOR" => "000000",
								"CONTROLS_OVER_COLOR" => "000000",
								"SCREEN_COLOR" => "000000",
								"AUTOSTART" => "N",
								"REPEAT" => "none",
								"VOLUME" => "90",
								"ADVANCED_MODE_SETTINGS" => "Y",
								"PLAYER_ID" => "",
								"BUFFER_LENGTH" => "10",
								"DOWNLOAD_LINK" => "",
								"DOWNLOAD_LINK_TARGET" => "_self",
								"ADDITIONAL_WMVVARS" => "")
							);?>
						<?endif;?>
					</li>
				<?endif;?>
				<?if (($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]||$arResult["SECTION_FULL"]["UF_FILES"]) && count($arFiles)):?>
					<li class="files">

						<?foreach( $arFiles as $arItem ){?>
							<?$arItem = CFile::GetFileArray($arItem);?>
							<div class="<? if( $arItem["CONTENT_TYPE"] == 'application/pdf' ){ echo "pdf"; } elseif( $arItem["CONTENT_TYPE"] == 'application/octet-stream' ){ echo "word"; } elseif( $arItem["CONTENT_TYPE"] == 'application/xls' ){ echo "excel"; }?>">
								<?$FileName = substr($arItem["ORIGINAL_NAME"], 0, strrpos($arItem["ORIGINAL_NAME"], '.'));?>
								<a href="<?=$arItem["SRC"]?>"><?=$FileName?></a>&nbsp;
								<?=GetMessage('CT_NAME_SIZE')?>:
								<?
									$filesize = $arItem["FILE_SIZE"];
									if($filesize > 1024) {
										$filesize = ($filesize/1024);
										if($filesize > 1024) {
											$filesize = ($filesize/1024);
											if($filesize > 1024) {
												$filesize = ($filesize/1024);
												$filesize = round($filesize, 1);
												echo $filesize.GetMessage('CT_NAME_GB');
											} else {
												$filesize = round($filesize, 1);
												echo $filesize.GetMessage('CT_NAME_MB');
											}
										} else {
											$filesize = round($filesize, 1); echo $filesize.GetMessage('CT_NAME_KB');
										}
									} else {
										$filesize = round($filesize, 1);
										echo $filesize.GetMessage('CT_NAME_b');
									}
								?>
							</div>
						<?}?>
					</li>
				<?endif;?>
				<?if(($arParams["USE_STORE"] == "Y") && $arResult["STORES_COUNT"] && !$arResult["OFFERS"]):?>
					<li>
						<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "product_stores_amount", array(
								"PER_PAGE" => "10",
								"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
								"SCHEDULE" => $arParams["SCHEDULE"],
								"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
								"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
								"ELEMENT_ID" => $arResult["ID"],
								"STORE_PATH"  =>  $arParams["STORE_PATH"],
								"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
								"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
								"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
								"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
							),
							$component
						);?>
					</li>
				<?endif;?>
<?endif;?>
<?if(CTires::checkVersionModule('sale', '16.5.0')):?>
<div class="gifts">
<?if ($arResult['MODULES']['catalog'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent("bitrix:sale.gift.product", "main", array(
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'SUBSCRIBE_URL_TEMPLATE' => $arResult['~SUBSCRIBE_URL_TEMPLATE'],
			'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
			"OFFER_HIDE_NAME_PROPS" => $arParams["OFFER_HIDE_NAME_PROPS"],

			"SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
			"SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
			"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"LINE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"HIDE_BLOCK_TITLE" => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
			"BLOCK_TITLE" => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
			"TEXT_LABEL_GIFT" => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
			"SHOW_NAME" => $arParams['GIFTS_SHOW_NAME'],
			"SHOW_IMAGE" => $arParams['GIFTS_SHOW_IMAGE'],
			"MESS_BTN_BUY" => $arParams['GIFTS_MESS_BTN_BUY'],

			"SHOW_PRODUCTS_{$arParams['IBLOCK_ID']}" => "Y",
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"PRODUCT_SUBSCRIPTION" => $arParams["PRODUCT_SUBSCRIPTION"],
			"MESS_BTN_DETAIL" => $arParams["MESS_BTN_DETAIL"],
			"MESS_BTN_SUBSCRIBE" => $arParams["MESS_BTN_SUBSCRIBE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ADD_PROPERTIES_TO_BASKET" => $arParams["ADD_PROPERTIES_TO_BASKET"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
			"USE_PRODUCT_QUANTITY" => 'N',
			"OFFER_TREE_PROPS_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFER_TREE_PROPS'],
			"CART_PROPERTIES_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFERS_CART_PROPERTIES'],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
			"SALE_STIKER" => $arParams["SALE_STIKER"],
			"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
			"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
			"DISPLAY_TYPE" => "block",
			"SHOW_RATING" => $arParams["SHOW_RATING"],
			"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
			"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
			"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			"TYPE_SKU" => "Y",

			"MATCHING_ELEMENT_PROPERTIES" => array
			(
				"POSADOCHNYY_DIAMETR_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"],
				"SHIRINA_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"],
				"COUNT_OTVERSTIY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["COUNT_OTVERSTIY"],
				"DIAMETR_STUPITSY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["DIAMETR_STUPITSY"],
				"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["MEZHBOLTOVOE_RASSTOYANIE"],
				"VYLET_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["VYLET_DISKA"],
				"SHIRINA_PROFILYA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"],
				"VYSOTA_PROFILYA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"],
				"POSADOCHNYY_DIAMETR" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"],
				"SEZONNOST" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"],
				"SHIPY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"],
				"RUN_ON_FLAT" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["RUN_ON_FLAT"],
			),

			"POTENTIAL_PRODUCT_TO_BUY" => array(
				'ID' => isset($arResult['ID']) ? $arResult['ID'] : null,
				'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
				'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
				'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
				'IBLOCK_ID' => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

				'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
				'SECTION' => array(
					'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
					'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
					'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
					'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
				),
			)
		), $component, array("HIDE_ICONS" => "Y"));
}
if ($arResult['MODULES']['catalog'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent(
			"bitrix:sale.gift.main.products",
			"main",
			array(
				"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
				"BLOCK_TITLE" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

				"OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],

				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],

				"ELEMENT_SORT_FIELD" => 'ID',
				"ELEMENT_SORT_ORDER" => 'DESC',
				//"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				//"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"FILTER_NAME" => 'searchFilter',
				"SECTION_URL" => $arParams["SECTION_URL"],
				"DETAIL_URL" => $arParams["DETAIL_URL"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],

				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],

				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => (isset($arParams["TEMPLATE_THEME"]) ? $arParams["TEMPLATE_THEME"] : ""),

				"ADD_PICT_PROP" => (isset($arParams["ADD_PICT_PROP"]) ? $arParams["ADD_PICT_PROP"] : ""),

				"LABEL_PROP" => (isset($arParams["LABEL_PROP"]) ? $arParams["LABEL_PROP"] : ""),
				"OFFER_ADD_PICT_PROP" => (isset($arParams["OFFER_ADD_PICT_PROP"]) ? $arParams["OFFER_ADD_PICT_PROP"] : ""),
				"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"]) ? $arParams["OFFER_TREE_PROPS"] : ""),
				"SHOW_DISCOUNT_PERCENT" => (isset($arParams["SHOW_DISCOUNT_PERCENT"]) ? $arParams["SHOW_DISCOUNT_PERCENT"] : ""),
				"SHOW_OLD_PRICE" => (isset($arParams["SHOW_OLD_PRICE"]) ? $arParams["SHOW_OLD_PRICE"] : ""),
				"MESS_BTN_BUY" => (isset($arParams["MESS_BTN_BUY"]) ? $arParams["MESS_BTN_BUY"] : ""),
				"MESS_BTN_ADD_TO_BASKET" => (isset($arParams["MESS_BTN_ADD_TO_BASKET"]) ? $arParams["MESS_BTN_ADD_TO_BASKET"] : ""),
				"MESS_BTN_DETAIL" => (isset($arParams["MESS_BTN_DETAIL"]) ? $arParams["MESS_BTN_DETAIL"] : ""),
				"MESS_NOT_AVAILABLE" => (isset($arParams["MESS_NOT_AVAILABLE"]) ? $arParams["MESS_NOT_AVAILABLE"] : ""),
				'ADD_TO_BASKET_ACTION' => (isset($arParams["ADD_TO_BASKET_ACTION"]) ? $arParams["ADD_TO_BASKET_ACTION"] : ""),
				'SHOW_CLOSE_POPUP' => (isset($arParams["SHOW_CLOSE_POPUP"]) ? $arParams["SHOW_CLOSE_POPUP"] : ""),
				'DISPLAY_COMPARE' => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
				'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
				"SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
				"SALE_STIKER" => $arParams["SALE_STIKER"],
				"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
				"DISPLAY_TYPE" => "block",
				"SHOW_RATING" => $arParams["SHOW_RATING"],
				"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
				"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],

				"MATCHING_ELEMENT_PROPERTIES" => array
				(
					"POSADOCHNYY_DIAMETR_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"],
					"SHIRINA_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"],
					"COUNT_OTVERSTIY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["COUNT_OTVERSTIY"],
					"DIAMETR_STUPITSY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["DIAMETR_STUPITSY"],
					"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["MEZHBOLTOVOE_RASSTOYANIE"],
					"VYLET_DISKA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["VYLET_DISKA"],
					"SHIRINA_PROFILYA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"],
					"VYSOTA_PROFILYA" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"],
					"POSADOCHNYY_DIAMETR" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"],
					"SEZONNOST" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"],
					"SHIPY" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"],
					"RUN_ON_FLAT" => $arParams["MATCHING_ELEMENT_PROPERTIES"]["RUN_ON_FLAT"],
				),
			)
			+ array(
				'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID']) ? $arResult['ID'] : $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
				'SECTION_ID' => $arResult['SECTION']['ID'],
				'ELEMENT_ID' => $arResult['ID'],
			),
			$component,
			array("HIDE_ICONS" => "Y")
	);
}
?>
</div>
<?endif;?>



