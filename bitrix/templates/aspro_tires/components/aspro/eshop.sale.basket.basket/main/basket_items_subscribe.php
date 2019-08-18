<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$cur = CCurrencyLang::GetCurrencyFormat(COption::GetOptionString('sale', 'default_currency', 'RUB'));?>
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
			<?foreach($arResult["ITEMS"]["ProdSubscribe"] as $arItem){
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
													<span class="measure value"><?=$arItem["QUANTITY"]?>&nbsp;<?=$measure;?></span>
												</span>
											<?endif;?>
											<span class="summ-cell">
												<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ):?><span class="equality"></span>												<?endif;?>
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
								<span class="measure"><?=$arItem["QUANTITY"]?>&nbsp;<?=$measure;?></span>	
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
				<?}?>
			<?}?>
		</tbody>
	</table>


</div>
