<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$cur = CCurrencyLang::GetCurrencyFormat(COption::GetOptionString('sale', 'default_currency', 'RUB'));?>
<?if ($arResult["ShowReady"]=="Y"):?>
	<div class="module-cart">
		<table class="table">
			<tbody>
				<tr>
					<th <?if(in_array("NAME", $arParams["COLUMNS_LIST"])):?>colspan="2"<?endif;?> class="name-th">
						<?if(in_array("NAME", $arParams["COLUMNS_LIST"])):?><?=GetMessage("SALE_NAME")?><?endif;?>
					</th>
					<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ):?>
						<?$allVATSumm=0;?>
						<th class="th-vat"><?= GetMessage("SALE_VAT")?></th>
					<?endif;?>
					<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ):?>
						<th class="th-type"><?= GetMessage("SALE_PRICE_TYPE")?></th>
					<?endif;?>
					<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ):?>
						<th class="th-discount"><?= GetMessage("SALE_DISCOUNT")?></th>
					<?endif;?>
					<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ):?>
						<th class="th-weight"><?= GetMessage("SALE_WEIGHT")?></th>
					<?endif;?>
					<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ):?>
						<th class="th-price" ><?=GetMessage("SALE_PRICE")?></th>
					<?endif;?>	
					<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ):?>
						<th class="count-th"><?=GetMessage("SALE_QUANTITY")?></th>
					<?endif;?>
					<th class="summ-th">
						<?=GetMessage("SALE_SUMM")?>
					</th>
					<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ):?>
						<th class="remove-cell"></th>
					<?endif;?>
				</tr>
			
				<?
					$cache = new CPHPCache();
					$cache_time = 1000;
					$cache_path = SITE_DIR.'aspro_basket/';
				?>
				<?foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem){
					$id = '';
					$cache_id = 'aspro_basket_'.$arItem["PRODUCT_ID"];

					if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) ){
						$res = $cache->GetVars();
						$item = $res["item"];
					}else{
						$objRes = CIBlockElement::GetList(array(), array("ID" => $arItem["PRODUCT_ID"]))->GetNextElement();
						$res = $objRes->GetFields();
						$res["PROPERTIES"] = $objRes->GetProperties();
						
						$Select=array("DETAIL_PICTURE", "ID", "SECTION_CODE", "DETAIL_PAGE_URL", "CML2_BASE_UNIT");
						
						if( !empty( $res["PROPERTIES"]["CML2_LINK"] ) ){
							$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["PROPERTIES"]["CML2_LINK"]["VALUE"]), false, false, $Select);
							//$rsitem->SetUrlTemplates("/catalog/id/#ELEMENT_ID#/");
							$item = $rsitem->GetNext();
							if( !empty( $item["DETAIL_PICTURE"] ) ){
								$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							}
						}else{
							$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["ID"]), false, false, $Select);
							//$rsitem->SetUrlTemplates("/catalog/id/#ELEMENT_ID#/");
							$item = $rsitem->GetNext();
							if( !empty( $item["DETAIL_PICTURE"] ) ){
								$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							}
						}
						
						if ($cache_time > 0)
						{
							$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
							$cache->EndDataCache( 
								array( 
									"item" => $item
								) 
							);
						}
					}
					if( !empty($item) ){?>
						<? $arCounts=CCatalogProduct::GetByID($arItem["PRODUCT_ID"]); $counts=$arCounts["QUANTITY"];?>
						<tr>
							<td class="thumb-cell">
								<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE", "IBLOCK_SECTION_ID"))->GetNext();?>
								<?if( $item["DETAIL_PICTURE"] != "" ){?>
									<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=$item["DETAIL_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
								<?}elseif(!empty($arSection["DETAIL_PICTURE"])){?>
									<?$img = CFile::ResizeImageGet( $arSection["DETAIL_PICTURE"], array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
									<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
								<?}elseif(!empty($arSection["PICTURE"])){?>
									<?$img = CFile::ResizeImageGet( $arSection["PICTURE"], array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
									<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
								<?}else{?>
									<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_small.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" width="80" height="80" /></a>
								<?}?>	
							</td>
							
							<?if(in_array("NAME", $arParams["COLUMNS_LIST"])):?>
								<td class="name-cell">
									<a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><br />
									<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>				
										<?foreach($arItem["PROPS"] as $val):?>
											<br /><?=$val["NAME"].": ".$val["VALUE"];?>
										<?endforeach;?>
									<?endif;?>
									<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])){?>
										<a class="button25 set_aside" href="<?=str_replace("#ID#", $arItem["ID"], $arUrlTempl["shelve"])?>">
											<?=GetMessage("SALE_OTLOG")?>
										</a>
									<?}?>
									
									<!-- adaptive properties begin -->
										<div class="extra_properties">
										
											<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ):?>
												<div class="type-cell"><b><?=GetMessage("SALE_PRICE_TYPE");?>:</b> <?=$arItem["NOTES"]?></div>
											<?endif;?>
											<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ):?>
												<div class="discount-cell">
													<b><?=GetMessage("SALE_DISCOUNT");?>:</b><?if ($arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]):?><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?><?else:?>&mdash;<?endif;?>
												</div>
											<?endif;?>
											<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ):?>
												<div class="weight-cell"><b><?=GetMessage("SALE_WEIGHT");?>:</b><?=$arItem["WEIGHT_FORMATED"]?></div>
											<?endif;?>
										
											<div class="price-block">
												<?if(in_array("QUANTITY", $arParams["COLUMNS_LIST"]) && ($arItem["QUANTITY"]>$counts)):?>
													<div class="error"><?=GetMessage("NO_NEED_AMMOUNT")?></div><br />
												<?endif;?>
												<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>	
													<span class="cost-cell">
														<?if( doubleval($arItem["FULL_PRICE"]) > 0 ){?>
															<div class="discount-price">
																<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
																<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["DISCOUNT_PRICE"], $cur["CURRENCY"])));?>
															</div>
															<div class="old-price">
																<strike>
																	<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
																	<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["FULL_PRICE"], $cur["CURRENCY"])));?>
																</strike>
															</div>
														<?}else{?>
															<div class="price">
																<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
																<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["PRICE"], $cur["CURRENCY"])));?>
															</div>
														<?}?>
													</span>
												<?}?>
												<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ):?>
													<span class="count-cell">
														<span class="x"></span>
														<input type="hidden" value="<?=$arItem["ID"]?>" name="ids"/>
														<input type="hidden" name="quan" value="<?=intval($arItem["QUANTITY"])?>"/>
														<input type="hidden" name="quan_b" value="<?=$counts?>"/>
														<?
															$measure = GetMessage("MEASURE_DEFAULT");
															if ($item["PROPERTY_CML2_BASE_UNIT_VALUE"])
															{ $measure = $item["PROPERTY_CML2_BASE_UNIT_VALUE"]; }
															$measure.=".";
														?>
														<select name="QUANTITY_<?=$arItem["ID"]?>" class="count" data-id="<?=$arItem["ID"]?>"	>
															<?
																$max_count = $counts;
																$max_count_settings = intval($arParams['MAX_COUNT']);
																if($max_count_settings != 0) $max_count = min($max_count, $max_count_settings);
																if($arItem["QUANTITY"] <= $counts && $arItem["QUANTITY"] > $max_count) 
																{ $max_count = $arItem["QUANTITY"];}
															?>
															<?for($i=1,$j=$arItem["QUANTITY"];$i<=$max_count;$i++){?>
																<option value="<?=$i?>" <?=($i==$arItem["QUANTITY"]) ? "selected" : "";?>><?=$i;?></option>
															<?}if($arItem["QUANTITY"]>$max_count){?>
																<option value="<?=intval($arItem["QUANTITY"])?>" selected="selected"><?=intval($arItem["QUANTITY"]);?></option>
															<?}?>							
														</select>
														<span class="measure">&nbsp;<?=$measure;?></span>	
													</span>
												<?endif;?>
												<span class="summ-cell">
													<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ):?><span class="equality"></span><?endif;?>
													<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
													<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency(($arItem["PRICE"] + $arItem["DISCOUNT_PRICE"]) * $arItem["QUANTITY"], $cur["CURRENCY"])));?>
												</span>
											</div>
										</div>
									<!-- adaptive properties end -->
									
								</td>
							<?endif;?>
							<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ):?>
								<td class="vat-cell">
									<?
										$allVATSumm += $arItem["PRICE_VAT_VALUE"]*$arItem["QUANTITY"];
										$vatSummFormated = FormatCurrency($arItem["PRICE_VAT_VALUE"], $arItem["CURRENCY"]);
										$symb =substr($vatSummFormated, strrpos($vatSummFormated, ' '));
										echo str_replace($symb, "", $vatSummFormated)."<span>".$symb."</span>";
									?>
								</td>
							<?endif;?>
							<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ):?>
								<td class="type-cell">
									<?=$arItem["NOTES"]?>
								</td>
							<?endif;?>
							<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ):?>
								<td class="discount-cell">
									<?if ($arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]):?><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?><?else:?>&mdash;<?endif;?>
								</td>
							<?endif;?>
							<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ):?>
								<td class="weight-cell">
									<?=$arItem["WEIGHT_FORMATED"]?>
								</td>
							<?endif;?>
							<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ):?>
								<td class="cost-cell">						
									<?if( doubleval($arItem["FULL_PRICE"]) > 0 ){?>
										<div class="discount-price">
											<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
											<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["DISCOUNT_PRICE"], $cur["CURRENCY"])));?>
										</div>
										<div class="old-price">
											<strike>
												<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
												<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["FULL_PRICE"], $cur["CURRENCY"])));?>
											</strike>
										</div>
									<?}else{?>
										<div class="price">
											<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
											<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency($arItem["PRICE"], $cur["CURRENCY"])));?>
										</div>
									<?}?>
								</td>
							<?endif;?>
							<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ):?>
								<td class="count-cell">
									<input type="hidden" value="<?=$arItem["ID"]?>" name="ids"/>
									<input type="hidden" name="quan" value="<?=intval($arItem["QUANTITY"])?>"/>
									<input type="hidden" name="quan_b" value="<?=$counts?>"/>
									<?if($arItem["QUANTITY"]>$counts):?>
										<div class="error"><?=GetMessage("NO_NEED_AMMOUNT")?></div>
									<?endif;?>
									<?
										$measure = GetMessage("MEASURE_DEFAULT");
										if ($item["PROPERTY_CML2_BASE_UNIT_VALUE"])
										{ $measure = $item["PROPERTY_CML2_BASE_UNIT_VALUE"]; }
										$measure.=".";
									?>
									
									<select name="QUANTITY_<?=$arItem["ID"]?>" class="count" data-id="<?=$arItem["ID"]?>"	>
										<?
											$max_count = $counts;
											$max_count_settings = intval($arParams['MAX_COUNT']);
											if($max_count_settings != 0) $max_count = min($max_count, $max_count_settings);
											if($arItem["QUANTITY"] <= $counts && $arItem["QUANTITY"] > $max_count) 
											{ $max_count = $arItem["QUANTITY"];}
										?>
										<?for($i=1,$j=$arItem["QUANTITY"];$i<=$max_count;$i++){?>
											<option value="<?=$i?>" <?=($i==$arItem["QUANTITY"]) ? "selected" : "";?>><?=$i;?></option>
										<?}if($arItem["QUANTITY"]>$max_count){?>
											<option value="<?=intval($arItem["QUANTITY"])?>" selected="selected"><?=intval($arItem["QUANTITY"]);?></option>
										<?}?>							
									</select>
									
									<span class="measure">&nbsp;<?=$measure;?></span>	
								</td>
							<?endif;?>
							<td class="summ-cell">
								<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
								<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency(($arItem["PRICE"] + $arItem["DISCOUNT_PRICE"]) * $arItem["QUANTITY"], $cur["CURRENCY"])));?>
							</td>
							<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ):?>
								<td class="remove-cell">
									<a class="remove" href="<?=SITE_DIR?>basket/?action=delete&id=<?=$arItem["ID"]?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
								</td>
							<?endif;?>
						</tr>
						<?$symb = substr($arItem["PRICE_FORMATED"], strrpos($arItem["PRICE_FORMATED"], ' '))?>
					<?}?>
				<?}?>
			</tbody>
		</table>

		<div class="result-row">

			<div class="result-info<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ):?> r<?endif;?>">
				<table border="0">
					<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ):?>
						<tr>
							<td class="cell-name"><?=GetMessage("SALE_ALL_WEIGHT")?>:</td>
							<td class="cell-value"><?=$arResult["allWeight_FORMATED"]?></td>
						</tr>
					<?endif;?>
					<?if( $arParams['PRICE_VAT_SHOW_VALUE'] == 'Y' ):?>
						<tr>
							<td class="cell-name"><?=GetMessage('SALE_VAT_INCLUDED')?></td>
							<td class="cell-value">
								<?
									$allVATSummFormated = FormatCurrency($allVATSumm, CCurrency::GetBaseCurrency());
									$symb = substr($allVATSummFormated, strrpos($allVATSummFormated, ' '));
									echo str_replace($symb, "", $allVATSummFormated)."<span>".$symb."</span>";
								?>
							</td>
						</tr>
					<?endif;?>
					
					<?if ($arResult["DISCOUNT_PRICE_ALL"]&&in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>	
						<tr class="discount">
							<td class="cell-name"><?=GetMessage("SALE_DISCOUNT")?>:</td>
							<td class="cell-value">
								<?
									$symb = substr($arResult["DISCOUNT_PRICE_ALL_FORMATED"], strrpos($arResult["DISCOUNT_PRICE_ALL_FORMATED"], ' '));
									echo str_replace($symb, "", $arResult["DISCOUNT_PRICE_ALL_FORMATED"])."<span>".$symb."</span>";
								?>
							</td>
						</tr>
					<?endif;?>			
					<tr class="total">
						<td class="cell-name"><?=GetMessage("SALE_ITOGO")?>:</td>
						<td class="cell-value">
							<?if ($arResult["DISCOUNT_PRICE_ALL"]):?>
								<div class="discount-price">
									<?
										$symb = substr($arResult["allSum_FORMATED"], strrpos($arResult["allSum_FORMATED"], ' '));
										echo str_replace($symb, "", $arResult["allSum_FORMATED"])."<span>".$symb."</span>";
									?>
								</div>
								<div class="old-price">
									<strike>
										<?
											$oldPriceFormated = FormatCurrency(($arResult["allSum"] + $arResult["DISCOUNT_PRICE_ALL"] ), CCurrency::GetBaseCurrency());
											$symb = substr($oldPriceFormated, strrpos($oldPriceFormated, ' '));
											echo str_replace($symb, "", $oldPriceFormated)."<span>".$symb."</span>";
										?>
									</strike>
								</div>
							<?else:?>
								<div class="price">
									<?
										$symb = substr($arResult["allSum_FORMATED"], strrpos($arResult["allSum_FORMATED"], ' '));
										echo str_replace($symb, "", $arResult["allSum_FORMATED"])."<span>".$symb."</span>";
									?>
								</div>
							<?endif;?>
						</td>
					</tr>	
				</table>
			</div>

			<?if( $arParams["HIDE_COUPON"] != "Y" ):?>
				<div class="coupon<?if ($arParams["AJAX_MODE"]!="Y"):?> b16<?endif;?>">
					<span class="coupon-t"><?=GetMessage("SALE_COUPON_NUMBER");?>:</span>
					<input type="text" value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?=GetMessage("SALE_COUPON_VAL")?><?endif;?>" name="COUPON">
					<?if ($arParams["AJAX_MODE"]=="Y"):?>
						<a class="button25 gradient apply-button"><?=GetMessage("SALE_APPLY")?></a>
					<?endif;?>
				</div>
			<?endif;?>
			
			<?if ($arParams["AJAX_MODE"]!="Y"):?>
				<div class="basket_update">
					<input type="submit" value="<?=GetMessage("SALE_UPDATE")?>" name="BasketRefresh" class="button_basket gradient refresh-button">
				</div>
			<?endif;?>
			
			<div class="clearboth"></div>
			<hr />
			<div class="buttons-row">
				<span class="f-right">
					<div class="basket_checkout">
						<input type="submit" value="<?=GetMessage("SALE_ORDER")?>" name="BasketOrder" class="button_basket gradient checkout" />
						<div class="description"><?=GetMessage("SALE_ORDER_DESCRIPTION");?></div>
					</div>
					<div class="basket_fast_order">
						<a onclick="oneClickBuyBasket()" class="button_basket gradient fast_order"><span><?=GetMessage("SALE_FAST_ORDER")?></span></a>
						<div class="description"><?=GetMessage("SALE_FAST_ORDER_DESCRIPTION");?></div>
					</div>
				</span>
				<div class="basket_back">
					<a class="button_basket gradient back-button" href="<?=SITE_DIR?>catalog/"><span><?=GetMessage("SALE_BACK")?></span></a>
					<div class="description"><?=GetMessage("SALE_BACK_DESCRIPTION");?></div>
				</div>
				<div class="clearboth"></div>
			</div>
			
		</div>

	</div>
<?else:?>
	<div class="cart_empty">
		<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr><td>
			<div class="img">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/empty_cart.png" alt="<?=GetMessage("BASKET_EMPTY")?>" />
			</div>
		</td><td>
			<div class="text">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/empty_cart.php", Array(), Array("MODE"      => "html", "NAME"      => GetMessage("SALE_BASKET_EMPTY"),));?>
			</div>
		</td></tr></table>
		<div class="clearboth"></div>
	</div>
<?endif;?>
<div class="one_click_buy_basket_frame"></div>