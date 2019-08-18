<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach( $arResult["UF_MORE_FILES"] as $key => $arPhoto ){ if (!$arPhoto){unset($arResult["UF_MORE_FILES"][$key]);}}?>

<article class="article-product no-pl">
	<div class="module-fotos<?if(count($arResult["UF_MORE_FILES"])>0):?> more_files_block<?endif;?>">

		<?if ($arResult["UF_AKCIYA"]||$arResult["UF_HIT"]||$arResult["UF_NEW"]):?>
			<div class="ribbons">
				<?if($arResult["UF_AKCIYA"]):?><span class="ribon-share"></span><?endif;?>
				<?if($arResult["UF_HIT"]):?><span class="ribon-hit"></span><?endif;?>
				<?if($arResult["UF_NEW"]):?><span class="ribon-new"></span><?endif;?>
			</div>
		<?endif;?>

		<?if(($arResult["UF_MORE_FILES"])){?>

			<ul class="main-fotos">
				<?if( !empty($arResult["DETAIL_PICTURE"]) ){?>
					<li>
						<?$img = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false);?>
						<a class="fancy" data-fancybox-group="t"  href="<?=$img["src"]?>"><span class="zoom"><i></i></span>
							<?$img = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 294, "height" => 294 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
						</a>
					</li>
				<?}elseif( !empty($arResult["PICTURE"]) ){?>
					<li>
						<?$img = CFile::ResizeImageGet( $arResult["PICTURE"], array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false);?>
						<a class="fancy" data-fancybox-group="t"  href="<?=$img["src"]?>"><span class="zoom"><i></i></span>
							<?$img = CFile::ResizeImageGet( $arResult["PICTURE"], array( "width" => 294, "height" => 294 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
						</a>
					</li>
				<?}else{?>
					<li>
						<img src="<?=SITE_TEMPLATE_PATH."/images/noimage_big.png"?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
					</li>
				<?}?>
				<?foreach( $arResult["UF_MORE_FILES"] as $arPhoto ){?>
					<li>
						<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false);?>
						<a class="fancy" data-fancybox-group="t" href="<?=$img["src"]?>"><span class="zoom"><i></i></span>
							<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 294, "height" => 294 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
						</a>
					</li>
				<?}?>
			</ul>

			<ul class="fotos-thumbs">
				<?if( !empty($arResult["DETAIL_PICTURE"]) ){?>
					<li>
						<div class="triangle"></div>
						<a><span class="helper"></span>
							<?$img = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 67, "height" => 67 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
						</a>
					</li>
				<?}?>
				<?foreach( $arResult["UF_MORE_FILES"] as $arPhoto ){?>
					<li>
						<div class="triangle"></div>
						<a><span class="helper"></span>
							<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 67, "height" => 67 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
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

		<?}elseif( !empty($arResult["DETAIL_PICTURE"]) ){?>
			<ul class="main-fotos">
				<li>
					<a class="fancy" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"><span class="zoom"><i></i></span>
						<?$img = CFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], array( "width" => 294, "height" => 294 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
						<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
					</a>
				</li>
			</ul>
		<?}elseif( !empty($arResult["PICTURE"]) ){?>
			<ul class="main-fotos">
				<li>
					<a class="fancy" href="<?=$arResult["PICTURE"]["SRC"]?>"><span class="zoom"><i></i></span>
						<?$img = CFile::ResizeImageGet( $arResult["PICTURE"], array( "width" => 294, "height" => 294 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array() );?>
						<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="main_img" />
					</a>
				</li>
			</ul>
		<?}else{?>
			<ul class="main-fotos">
				<li>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_big.png" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				</li>
			</ul>
		<?}?>
	</div>

	<div class="info<?if(count($arResult["UF_MORE_FILES"])>0):?> more_files_block<?endif;?>">
		<div class="info-wrapp">
			<div class="info-left">
				<?if ($arParams["USE_RATING"]=="Y"){?>
					<div class="rating">
						<div class="rating-wrapp">
							<?$APPLICATION->IncludeComponent(
							   "aspro:iblock.vote",
							   "section_rating",
							   Array(
								  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								  "IBLOCK_ID" => $arParams["IBLOCK_ID"],
								  "ELEMENT_ID" =>$arResult["ID"],
								  "MAX_VOTE" => 5,
								  "VOTE_NAMES" => array(),
								  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
								  "CACHE_TIME" => $arParams["CACHE_TIME"],
								  "DISPLAY_AS_RATING" => 'vote_avg'
							   ), $component, array("HIDE_ICONS" =>"Y")
							);?>
						</div>
					</div>
				<?}?>
				<div class="options">
					<?if( $arResult["SECTION"]["UF_SEZONNOST"] || $arResult["SECTION"]["UF_SHIPY"] ){?>
						<ul class="list">
							<?if($arResult["SECTION"]["UF_SEZONNOST"]){?>
								<?
									$seasonClass = "";
									if (trim($arResult["SECTION"]["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
									elseif (trim($arResult["SECTION"]["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
									elseif (trim($arResult["SECTION"]["UF_SEZONNOST"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
								?>
								<li>
									<span class="key"><span><?=GetMessage("SEASON");?></span></span>
									<span class="value">
										<span class="markers"><span <?if (strlen($seasonClass)):?>class="marker-<?=$seasonClass?>"<?endif;?>></span><?if (strlen($seasonClass)):?><?=GetMessage(strtoupper($seasonClass)."_SECTION")?><?else:?><?=$arResult["SECTION"]["UF_SEZONNOST"]?><?endif;?></span>
									</span>
								</li>
							<?}?>
							<?if( $arResult["SECTION"]["UF_SHIPY"]==GetMessage("YES")){?>
								<li>
									<span class="key"><span><?=GetMessage("SHIPY");?></span></span>
									<span class="value"><span class="markers"><span class="marker-ship"></span><span class="option-description"><?=GetMessage("YES");?></span></span>
								</li>
							<?}?>
						</span>
						</ul>
					<?}?>
				</div>
			</div>

			<?
				$parentSectionName = "";
				$db_sec = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
				while ($res = $db_sec->GetNext()){$parentSectionName = $res["NAME"];}
			?>
			<div class="info-right">
				<?if( !empty( $arResult["PATH"][0]["DETAIL_PICTURE"] ) ){?>
					<div class="manufacturer-logo">
						<?$img = CFile::ResizeImageGet($arResult["PATH"][0]["DETAIL_PICTURE"], array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<a href="<?=$arResult["PATH"][0]["SECTION_PAGE_URL"];?>">
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" <?if($parentSectionName):?>title="<?=$parentSectionName;?>" alt="<?=$parentSectionName;?>"<?endif;?> />
						</a>
					</div>
				<?}elseif( !empty( $arResult["PATH"][0]["PICTURE"] ) ){?>
					<div class="manufacturer-logo">
						<?$img = CFile::ResizeImageGet($arResult["PATH"][0]["PICTURE"], array( "width" => 120, "height" => 37 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
						<a href="<?=$arResult["PATH"][0]["SECTION_PAGE_URL"];?>">
							<img src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" <?if($parentSectionName):?>title="<?=$parentSectionName;?>" alt="<?=$parentSectionName;?>"<?endif;?> />
						</a>
					</div>
				<?}?>
				<div class="share-block">
					<div class="title"><?=GetMessage("SHARE");?></div>
					<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
					<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div>
				</div>
			</div>

		</div>

		<?if($arResult["SECTION"]["UF_DESCRIPTION"]):?>
			<div class="product-description">
				<?=$arResult["SECTION"]["UF_DESCRIPTION"]?>

			</div>
		<?endif;?>
	</div>
</article>

<?if (!empty($arResult["ITEMS"])):?>
	<div id="module_sizes">
		<div class="module-sizes-product">
			<div class="module-title"><?=GetMessage("SIZES");?></div>
			<table class="module-products-list">
				<thead>
					<tr>
						<?
							$colspan = 0;
							reset($arResult["ITEMS"]);
							if (( count($arResult["ITEMS"])>1) || ( (count($arResult["ITEMS"])==1)&&(key($arResult["ITEMS"])!="NO_DIAMETER") ) ) { $colspan=2;}
						?>
						<th class="item-name-th" <?if ($colspan):?>colspan="<?=$colspan;?>"<?endif;?>><?=GetMessage("NAME");?></th>
						<th class="size-th"><?=GetMessage("SIZE");?></th>
						<th class="price-th"><?=GetMessage("PRICE");?></th>
						<?
							$colspan = 0;
							if (!count($arItem["OFFERS"]))
							{
								if ($arParams["USE_PRODUCT_QUANTITY"]=="Y"){$colspan = 3;} else {$colspan=2;}
								if ($arParams["USE_STORE"]!="Y") { $colspan--; }
							}
						?>
						<th class="availability-th"<?if ($colspan):?> colspan="<?=$colspan;?>"<?endif;?>>
							<?if ($arParams["USE_STORE"]=="Y"):?><?=$arParams["MAIN_TITLE_LIST"];?><?endif;?>
						</th>
					</tr>
				</thead>
				<tbody>

					<?foreach( $arResult["ITEMS"] as $k => $arDiam ){?>

						<?$diameterShown = false;
						$basePrice = CCatalogGroup::GetBaseGroup();
						$base_price_code = $basePrice["NAME"];
						$discount_price_code = $arParams["DISCOUNT_PRICE_CODE"];?>
						<?foreach($arDiam as $arItem){
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
							?>
							<tr class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

								<?if (( count($arResult["ITEMS"])>1) || ( (count($arResult["ITEMS"])==1)&&($k!="NO_DIAMETER") ) ) {?>
									<?if(!$diameterShown): $diameterShown=true;?>
										<td class="diameter" rowspan="<?=count($arDiam);?>">
											<?if ($k=="NO_DIAMETER"):?>&hellip;<?else:?><?=$k?>"<?endif;?>
										</td>
									<?endif;?>
								<?}?>

								<td class="item-name-cell">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
									<?if ($arItem["PROPERTIES"]["KHIT_PRODAZH"]["VALUE"]||$arItem["PROPERTIES"]["NOVINKA"]["VALUE"]||$arItem["PROPERTIES"]["AKTSIYA"]["VALUE"]):?>
										<span class="slices">
											<?if( $arItem["PROPERTIES"]["KHIT_PRODAZH"]["VALUE"] != false):?><span class="slice-hit"></span><?endif;?>
											<?if( $arItem["PROPERTIES"]["NOVINKA"]["VALUE"] != false):?><span class="slice-new"></span><?endif;?>
											<?if( $arItem["PROPERTIES"]["AKTSIYA"]["VALUE"] != false):?><span class="slice-share"></span><?endif;?>
										</span>
									<?endif;?>



									<!--adaptive properties begin-->

										<div class="extra_properties">
											<div class="properties-block">
												<!---size-->
												<?if (CSite::InDir(SITE_DIR.'search/tires')||CSite::InDir(SITE_DIR.'search/wheels')||CSite::InDir(SITE_DIR.'catalog/tires')||CSite::InDir(SITE_DIR.'catalog/wheels')):?>
													<div class="size-cell">
														<?$bSizeShown = false;?>
														<b><?=GetMessage("SIZE");?>:</b>
														<span>
															<?foreach ($arParams["MATCHING_ELEMENT_PROPERTIES"] as $key => $property):?>
																<?if (array_key_exists($property,$arItem["DISPLAY_PROPERTIES"])){?>
																	<?if ((($key=="SHIRINA_PROFILYA")||($key=="VYSOTA_PROFILYA")||(($key=="POSADOCHNYY_DIAMETR")))&&(!$bSizeShown)):?>
																		<?$bSizeShown = true;?>
																		<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"]]["VALUE"]?>
																		<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"]]["VALUE"]&&$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"]]["VALUE"]):?>
																			/
																		<?endif;?>
																		<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"]]["VALUE"]?>
																		<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"]]["VALUE"]>0):?>
																			R<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"]]["VALUE"];?>
																		<?endif;?>
																	<?elseif((($key=="POSADOCHNYY_DIAMETR_DISKA")||($key=="SHIRINA_DISKA"))&&(!$bSizeShown)):?>
																		<?$bSizeShown = true;?>
																		<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"]]["VALUE"]?>
																		<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"]]["VALUE"]&&$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"]]["VALUE"]):?>
																			&times;
																		<?endif;?>
																		<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"]]["VALUE"]?>
																	<?endif;?>
																<?}?>
															<?endforeach;?>
														</span>
													</div>
												<?endif;?>

												<!--availability-->
												<?if ($arParams["USE_STORE"]=="Y"):?>
													<div class="availability-cell">
														<b><?=GetMessage("AVAILABILITY_2");?>:</b>
														<?
															$sMeasure = GetMessage("MEASURE");
															if ($arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }

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
													</div>
												<?endif;?>

												<!--season-->
												<?if($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]] || $arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]]){?>
													<div class="se-cell">
														<?$properties = array();?>
														<span class="markers">
															<?if($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SEZONNOST"]]["VALUE"]){?>
																<?
																	$seasonClass = "";
																	if (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
																	elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
																	elseif (trim($arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
																?>
																<?if (strlen($seasonClass)):?>
																	<span class="marker-<?=$seasonClass?>"></span>
																	<?$properties[] = $arItem["DISPLAY_PROPERTIES"][$arParams["SEZONNOST"]]["VALUE"];?>
																<?endif;?>
															<?}?>
															<?if($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]]["VALUE"]){?>
																<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIPY"]]["VALUE"]!=false):?>
																	<span class="marker-ship"></span>
																	<?$properties[] = GetMessage("SHIP"); ?>
																<?endif;?>
															<?}?>
															<? $str = ""; if (count($properties)>1){$str = $properties[0].", ".strtolower($properties[1]);} else {$str=$properties[0];}?>
															<span class="properties_text"><?=$str;?></span>
														</span>
													</div>
												<?}?>
											</div>

											<div class="buy-block">
												<!--price-->
												<div class="price-cell<?if( $arItem["OFFERS"] && (CSite::InDir(SITE_DIR.'search/tires') || CSite::InDir(SITE_DIR.'search/wheels') || CSite::InDir(SITE_DIR.'catalog/tires') || CSite::InDir(SITE_DIR.'catalog/wheels'))){echo " ws";}?>">
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
																<div class="cost">
																	<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
																	<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
																		<span class="price_value">
																			<?
																				$symb =substr($arPrice["PRINT_DISCOUNT_VALUE"], strrpos($arPrice["PRINT_DISCOUNT_VALUE"], ' '));
																				echo str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<span>".$symb."</span>";
																			?>
																		</span>
																		<span class="prompt-discont">
																			<span>&nbsp;<strike><span><?=$arPrice["PRINT_VALUE"]?></strike></span>
																		</span>
																	<?}else{?>
																		<span class="price_value">
																			<?
																				$symb =substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));
																				echo str_replace($symb, "", $arPrice["PRINT_VALUE"])."<span>".$symb."</span>";
																			?>
																		</span>
																	<?}?>
																</div>
															<?}?>
														<?}?>
													<?}?>
												</div>

												<!--product quantity & buy buttons-->
												<!--noindex-->
												<div class="buy_buttons_wrapp">
													<!--product quantity-->
													<?if($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
														<span class="quantity-cell">
															<?if (!count($arItem["OFFERS"])){?>
																<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
																	<select name="counter" class="counter">
																		<?
																			$max_count = $count_in_stores;
																			$max_count_settings = intval($arParams['MAX_COUNT']);
																			if($max_count_settings != 0) $max_count = min($max_count, $max_count_settings);
																			for($i=1;$i<=$max_count;$i++){
																		?>
																			<?if (!intval($arParams["DEFAULT_COUNT"])){$arParams["DEFAULT_COUNT"]=4;}?>
																			<?if($max_count>=intval($arParams["DEFAULT_COUNT"])){?>
																				<option value="<?=$i?>" <?=(($i==intval($arParams["DEFAULT_COUNT"])))? 'selected' : ''?>><?=$i?></option>
																			<?}else{?>
																				<option value="<?=$i?>" <?=(($i==$max_count))? 'selected' : ''?>><?=$i?></option>
																			<?}?>
																		<?}?>
																	</select>
																	<span class="measure"><?=$sMeasure;?></span>&nbsp;
																<?}?>
															<?}?>
														</span>
													<?endif;?>

													<!--buy buttons-->
													<span class="but-cell item_<?=$arItem["ID"]?>">
														<!--noindex-->
															<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
																<a href="#" data-item="<?=(count($arItem["OFFERS"])) ? $arItem["OFFERS"][$min_offer]["ID"] : $arItem["ID"]?>" data-quantity="<?=($count_in_stores>=intval($arParams["DEFAULT_COUNT"])) ? intval($arParams["DEFAULT_COUNT"]): $count_in_stores; ?>" class="button25 basket to-cart" alt="<?=$arItem["NAME"]?>" rel="nofollow">
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
													</span>
												</div>
												<!--/noindex-->
											</div>

										</div>
									<!--adaptive properties end-->

								</td>

								<td class="size-cell">
									<?$bSizeShown = false;?>
									<?foreach ($arParams["MATCHING_ELEMENT_PROPERTIES"] as $key => $property):?>
										<?if (array_key_exists($property,$arItem["DISPLAY_PROPERTIES"])){?>
											<?if ((($key=="SHIRINA_PROFILYA")||($key=="VYSOTA_PROFILYA")||(($key=="POSADOCHNYY_DIAMETR")))&&(!$bSizeShown)):?>
												<?$bSizeShown = true;?>
												<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"]]["VALUE"]?>
												<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"]]["VALUE"]&&$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_PROFILYA"]]["VALUE"]):?>
													/
												<?endif;?>
												<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["VYSOTA_PROFILYA"]]["VALUE"]?>
												<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"]]["VALUE"]>0):?>
													R<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR"]]["VALUE"];?>
												<?endif;?>
											<?elseif((($key=="POSADOCHNYY_DIAMETR_DISKA")||($key=="SHIRINA_DISKA"))&&(!$bSizeShown)):?>
												<?$bSizeShown = true;?>
												<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"]]["VALUE"]?>
												<?if ($arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["POSADOCHNYY_DIAMETR_DISKA"]]["VALUE"]&&$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"]]["VALUE"]):?>
													&times;
												<?endif;?>
												<?=$arItem["DISPLAY_PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["SHIRINA_DISKA"]]["VALUE"]?>
											<?endif;?>
										<?}?>
									<?endforeach;?>
								</td>

								<td class="price-cell<?if( $arItem["OFFERS"] && (CSite::InDir(SITE_DIR.'search/tires') || CSite::InDir(SITE_DIR.'search/wheels') || CSite::InDir(SITE_DIR.'catalog/tires') || CSite::InDir(SITE_DIR.'catalog/wheels'))){echo " ws";}?>">
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
												<div class="cost">
													<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
													<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
														<div class="price_value">
															<?
																$symb =substr($arPrice["PRINT_DISCOUNT_VALUE"], strrpos($arPrice["PRINT_DISCOUNT_VALUE"], ' '));
																echo str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<span>".$symb."</span>";
															?>
														</div>
														<div class="prompt-discont">
															<span>&nbsp;<strike><span><?=$arPrice["PRINT_VALUE"]?></strike></span>
														</div>
													<?}else{?>
														<div class="price_value">
															<?
																$symb =substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));
																echo str_replace($symb, "", $arPrice["PRINT_VALUE"])."<span>".$symb."</span>";
															?>
														</div>
													<?}?>
												</div>
											<?}?>
										<?}?>
									<?}?>
								</td>

								<?if ($arParams["USE_STORE"]=="Y"):?>
									<td class="availability-cell">
										<?
											$sMeasure = GetMessage("MEASURE");
											if ($arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]) { $sMeasure = $arItem["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]."."; }

											$amount = $count_in_stores;
											if(($arParams["USE_MIN_AMOUNT"] == 'Y')&&($arParams["USE_ONLY_MAX_AMOUNT"]=="Y"))
											{
												if(intval($amount) > $arParams["MAX_AMOUNT"])			$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) == 0)							$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])		$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
											}
											elseif($arParams["USE_MIN_AMOUNT"] == 'Y')
											{
												if(intval($amount) > $arParams["MAX_AMOUNT"])			$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.GetMessage("SUFFICIENT_GOODS").'</span>';
												elseif(intval($amount) == 0)							$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])		$amount = '<span class="few">'.GetMessage("FEW_GOODS").'</span>';
											}
											else
											{
												if (!$arParams["MAX_AMOUNT"]&&!$arParams["MIN_AMOUNT"]) 	$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) > $arParams["MAX_AMOUNT"])			$amount = '<span class="many">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) >= $arParams["MIN_AMOUNT"])		$amount = '<span class="sufficient">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
												elseif(intval($amount) == 0)							$amount = '<span class="under_order">'.$count_in_stores.'</span>';
												elseif(intval($amount) < $arParams["MIN_AMOUNT"])		$amount = '<span class="few">'.$count_in_stores.'&nbsp;'.$sMeasure.'</span>';
											}
										?>
										<?=$amount;?>
									</td>
								<?endif;?>


								<?if($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
									<td class="quantity-cell">
										<?if (!count($arItem["OFFERS"])){?>
											<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
												<select name="counter" class="counter">
													<?
														$max_count = $count_in_stores;
														$max_count_settings = intval($arParams['MAX_COUNT']);
														if($max_count_settings != 0) $max_count = min($max_count, $max_count_settings);
														for($i=1;$i<=$max_count;$i++){
													?>
														<?if (!intval($arParams["DEFAULT_COUNT"])){$arParams["DEFAULT_COUNT"]=4;}?>
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
									</td>
								<?endif;?>

								<td class="but-cell item_<?=$arItem["ID"]?>">
									<?if (!count($arItem["OFFERS"])){?>
										<!--noindex-->
											<?if( intval($count_in_stores) > 0 && ($arItem["PRICES"] || $arItem["OFFERS"]  )){?>
												<a href="<?=$arItem["ADD_URL"]?>" data-item="<?=$arItem["ID"]?>" data-quantity="<?=($count_in_stores>=4) ? '4': $count_in_stores; ?>" class="button25 basket to-cart" alt="<?=$arItem["NAME"]?>" rel="nofollow">
													<i></i>
													<span><?=GetMessage("TO_BASKET");?></span>
												</a>
												<a href="<?=SITE_DIR?>basket/" class="button25 basket in-cart" rel="nofollow" style="display:none;">
													<i></i>
													<span><?=GetMessage("IN_BASKET");?></span>
												</a>
											<?}else{?>
												<?=CTires::showOrderButton($arParams["ORDER_BUTTON_VIEW"], $arItem, "button25");?>
											<?}?>
										<!--/noindex-->
									<?}?>
								</td>
							</tr>
						<?}?>
					<?}?>
				</tbody>
			</table>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
				<?=$arResult["NAV_STRING"]?>
			<?}?>
		</div>
	</div>
<?endif;?>
<?foreach ($arResult["SECTION"]["UF_FILES"] as $key => $value){ if (!intval($value)){unset($arResult["SECTION"]["UF_FILES"][$key]);}}?>
<div class="tabs-section<?=((!$arResult["DESCRIPTION"] && !$arResult["SECTION"]["UF_VIDEO"] && !$arResult["SECTION"]["UF_VIDEO_YOUTUBE"] && !$arResult["SECTION"]["UF_FILES"] && $arParams["USE_REVIEW"] != "Y") ? ' hidden' : '')?>">
	<div class="switcher-wrapp">
		<?$show_tabs = false;?>
		<ul class="tabs">
			<?if($arResult["DESCRIPTION"]):?><li <?if (!$show_tabs): $show_tabs=true;?>class="cur"<?endif;?>><a><?=GetMessage("DESCRIPTION");?></a><div class="triangle"></div></li><?endif;?>
			<?if($arResult["SECTION"]["UF_VIDEO"]||$arResult["SECTION"]["UF_VIDEO_YOUTUBE"]):?><li <?if (!$show_tabs): $show_tabs=true;?>class="cur"<?endif;?>><a><?=GetMessage("VIDEO")?></a><div class="triangle"></div></li><?endif;?>
			<?if($arResult["SECTION"]["UF_FILES"]):?><li <?if (!$show_tabs): $show_tabs=true;?>class="cur"<?endif;?>><a><?=GetMessage("FILES")?></a><div class="triangle"></div></li><?endif;?>
			<?if($arParams["USE_REVIEW"]=="Y"):?><li <?if (!$show_tabs): $show_tabs=true;?>class="cur"<?endif;?>><a><?=GetMessage("PRODUCT_REVIEWS");?></a><div class="triangle"></div></li><?endif;?>
		</ul>
	</div>
	<div class="tabs-content">
		<?$show_tabs = false;?>
		<ul>
			<?if ($arResult["DESCRIPTION"]):?>
				<li <?if (!$show_tabs): $show_tabs=true;?>class="cur"<?endif;?>><?=$arResult["DESCRIPTION"]?></li>
			<?endif;?>

			<?if ($arResult["SECTION"]["UF_VIDEO"]||$arResult["SECTION"]["UF_VIDEO_YOUTUBE"]):?>
				<li class="video<?if (!$show_tabs): $show_tabs=true;?> cur<?endif;?>">
					<?if (!empty($arResult["SECTION"]['UF_VIDEO_YOUTUBE'])):?>
						<?=$arResult["SECTION"]['~UF_VIDEO_YOUTUBE'];?>
					<?elseif (!empty($arResult["SECTION"]['UF_VIDEO'])):?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:player", "",
							Array(
							"PLAYER_TYPE" => "auto",
							"USE_PLAYLIST" => "N",
							"PATH" => CFile::GetPath($arResult["SECTION"]['UF_VIDEO']),
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
			<?if ($arResult["SECTION"]["UF_FILES"]):?>
				<li class="files<?if (!$show_tabs): $show_tabs=true;?> cur<?endif;?>">
					<?foreach( $arResult["SECTION"]["UF_FILES"] as $arItem ){?>
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