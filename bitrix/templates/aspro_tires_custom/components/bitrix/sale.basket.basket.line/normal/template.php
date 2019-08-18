<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $isBasketPage, $arBasketItems;

$cartStyle = 'bx-basket';
$cartId = "bx_basket".$component->getNextNumber();
$arParams['cartId'] = $cartId;

if(!function_exists('declOfNum')){
	function declOfNum($number, $titles){
		$cases = array (2, 0, 1, 1, 1, 2); 
		return sprintf($titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]], $number);
		}
	}

$count = $delayCount =  $summ = 0;
$arBasketIDs=array();

if ($arParams["SHOW_PRODUCTS"] == "Y" /*&& $arResult['NUM_PRODUCTS'] > 0*/){
	foreach ($arResult["CATEGORIES"] as $category => $items){
		if (empty($items))
			continue;
		if($category=="READY"){
			foreach($items as $arItem){
				++$count;
				$price=((isset($arItem["~PRICE"]) && $arItem["~PRICE"]) ? $arItem["~PRICE"] : $arItem["PRICE"] );
				if(0>$price){ //bug fix
					$arBasketItemPrice = CSaleBasket::GetList(
						array(),
						array("ID" => $arItem["ID"]),
						false,
						false,
						array("PRICE", "ID")
					)->Fetch();
					$price=$arBasketItemPrice["PRICE"];
					$arItem["PRICE"]=$price;
				}
				$summ += $price*$arItem["QUANTITY"];
				if(!CSaleBasketHelper::isSetItem($arItem))
					$arBasketIDs[$arItem["ID"]]=$arItem;
			}
		}elseif($category=="DELAY"){
			foreach($items as $arItem){
				++$delayCount;
			}
		}
	}
	$cur = CCurrencyLang::GetCurrencyFormat(CSaleLang::GetLangCurrency(SITE_ID));
	$summ_formated = FormatCurrency($summ, $cur["CURRENCY"]);
}else{
	$summ_formated=$arResult["TOTAL_PRICE"];
	$count=$arResult["NUM_PRODUCTS"];
}

if($arBasketIDs){
	$propsIterator = CSaleBasket::GetPropsList(
		array('BASKET_ID' => 'ASC', 'SORT' => 'ASC', 'ID' => 'ASC'),
		array('BASKET_ID' => array_keys($arBasketIDs))
	);
	while ($property = $propsIterator->GetNext()){
		$property['CODE'] = (string)$property['CODE'];
		if ($property['CODE'] == 'CATALOG.XML_ID' || $property['CODE'] == 'PRODUCT.XML_ID')
			continue;
		if (!isset($arBasketIDs[$property['BASKET_ID']]))
			continue;
		$arBasketIDs[$property['BASKET_ID']]['PROPS'][] = $property;
	}
}?>

<?$frame = $this->createFrame()->begin('');?>

<!--noindex-->
<?if( $count > 0 ):?>
	<div class="cart">
		<a class="active cart-call pseudo" href="#" rel="nofollow"><?=GetMessage("BASKET");?></a><br />
		<span class="black"><?=$count;?></span> <span class="grey"><?=declOfNum($count, array(GetMessage("PRODUCTS_ONE"), GetMessage("PRODUCTS_TWO"), GetMessage("PRODUCTS_FIVE")))?></span><br />
		<span class="grey"><?=GetMessage("NA");?></span> 
		<span class="black"><?=$summ_formated?></span>
	</div>
<?else:?>
	<div class="cart empty_cart">
		<a href="<?=SITE_DIR?>basket/" rel="nofollow"><?=GetMessage("BASKET");?></a><br />
		<span class="grey"><?=GetMessage("EMPTY_BASKET");?></span>
	</div>
<?endif;?>
<!--/noindex-->

<div class="module-drop-cart">
	<div class="top-arr"></div>
	<div class="table-title"><?=GetMessage("IN_BASKET");?></div>
	<a href="#" class="close jqmClose"></a>
	<table class="cart-shell">
		<tbody>
			<?$cache = new CPHPCache();
			$cache_time = 100000;
			$cache_path = SITE_DIR.'aspro_tires_basket/';?>
			<?$i = 0;?>
			<?foreach( $arBasketIDs as $arItem ){	
				if (($arItem["CAN_BUY"]=="Y")&&($arItem["DELAY"]=="N")){
				$id = '';
				if( $i >= 3 ) break;
				$cache_id = 'aspro_basket_'.$arItem["PRODUCT_ID"];				
				if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) ){
					$res = $cache->GetVars();
					$item = $res["item"];
				}else{
					if( $objRes = CIBlockElement::GetList(array(), array("ID" => $arItem["PRODUCT_ID"]))->GetNextElement() ){
						$res = $objRes->GetFields();
						$res["PROPERTIES"] = $objRes->GetProperties();
	                	if( !empty( $res["PROPERTIES"]["CML2_LINK"] ) ){
							$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["PROPERTIES"]["CML2_LINK"]["VALUE"]), false, false, array());
							$item = $rsitem->GetNext();
							if( !empty( $item["DETAIL_PICTURE"] ) ){
								$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							}
							
						}else{
							$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["ID"]), false, false, array());
							$item = $rsitem->GetNext();
							if( !empty( $item["DETAIL_PICTURE"] ) ){
								$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							}
						}

						$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE"))->Fetch();
						if($arSection["DETAIL_PICTURE"]){
							$item["SECTION_DETAIL_PICTURE"] = CFile::ResizeImageGet($arSection["DETAIL_PICTURE"], array('width' => 70, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						}elseif($arSection["PICTURE"]){
							$item["SECTION_PICTURE"] = CFile::ResizeImageGet($arSection["PICTURE"], array('width' => 70, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						}

						unset($item["PROPERTIES"]);
						unset($item["~PROPERTIES"]);
						unset($item["SEARCHABLE_CONTENT"]);
						unset($item["~SEARCHABLE_CONTENT"]);
								
						if ($cache_time > 0){
							$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
							$cache->EndDataCache( 
								array(
									"item" => $item,
								)
							);
						}
					}
				}
				if( !empty( $item ) ){?>			
					<tr>
						<td class="thumb-cell">				
							<?if( $item["DETAIL_PICTURE"] != "" ):?>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$item["DETAIL_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
							<?elseif($item["SECTION_DETAIL_PICTURE"]):?>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$item["SECTION_DETAIL_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
							<?elseif($arSection["SECTION_PICTURE"]):?>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$item["SECTION_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
							<?else:?>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_small.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" width="75" /></a>
							<?endif;?>

						</td>
						<td class="item-title">
							<a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
						</td>					
						<td class="count-cell">
							<?=intVal($arItem["QUANTITY"])?> <?=GetMessage("MEASURE")?>
						</td>
						<td class="cost-cell">
							<?$symb = trim(str_replace("#", "", $cur["FORMAT_STRING"]));?>
							<?=trim(str_replace($symb, '<span>'.$symb.'</span>', FormatCurrency(($arItem["PRICE"] + $arItem["DISCOUNT_PRICE"]) * $arItem["QUANTITY"], $cur["CURRENCY"])));?>
						</td>
					</tr>
					<?$i++?>
				<?}?>
			<?}}?>
		</tbody>
	</table>
	<?if( $count > 3 ){?>
		<div class="more-row"><a href="<?=SITE_DIR?>basket/"><?=GetMessage("STILL")?> <?=($count-3)?> <?=declOfNum(($count-3), array(GetMessage("PRODUCTS_ONE"), GetMessage("PRODUCTS_TWO"), GetMessage("PRODUCTS_FIVE")))?> <?=GetMessage("IN_BASKET_SMALL")?></a></div>			
	<?}?>
	<div class="but-row">
		<a href="<?=SITE_DIR?>basket/" class="button25  grey go-to-cart"><span><?=GetMessage("GO_TO_BASKET");?></span></a>
	</div>
</div>


<?/*
<div class="basket_normal cart <?=(!$count || $isBasketPage || $_POST["ACTION"]=='top' ? ' empty_cart ' : '')?> <?=(!$count && $isBasketPage ? 'ecart' : '');?> <?=($isBasketPage || $_POST["ACTION"]=='top' ? 'bcart' : '');?>">
	<!--noindex-->
		<div class="wraps_icon_block delay <?=($delayCount ? 'fill' : '' );?>">
			<a href="<?=$arParams["PATH_TO_BASKET"];?>#tab_DelDelCanBuy" class="link" <?=($delayCount ? '' : 'style="display: none;"' );?> title="<?=GetMessage("BASKET_DELAY_LIST");?>"></a>
			<?if($delayCount){?>
				<div class="count">
					<span>
						<div class="items">
							<div class="text"><?=$delayCount;?></div>
						</div>
					</span>
				</div>
			<?}?>
		</div>
		<div class="basket_block f-left">
			<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="link" title="<?=GetMessage("BASKET_LIST");?>"></a>
			<div class="wraps_icon_block basket <?=($count ? 'fill' : '' );?>">
				<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="link" title="<?=GetMessage("BASKET_LIST");?>"></a>
				<div class="count">
					<span>
						<div class="items">
							<a href="<?=$arParams["PATH_TO_BASKET"]?>"><?=$count;?></a>
						</div>
					</span>
				</div>
			</div>
			<div class="text f-left">
				<div class="title"><?=GetMessage("BASKET");?></div>
				<div class="value">
					<?if($count){?>
						<?=$summ_formated?>
					<?}else{?>
						<?=GetMessage("EMPTY_BASKET");?>
					<?}?>
				</div>
			</div>
			<div class="card_popup_frame popup">
				<div class="basket_popup_wrapper">
					<div class="basket_popup_wrapp" <?=($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["ACTION"]=='del' && $_POST["ACTION"]!='top' ? "style='display: block;'" : "");?>>
						<div class="cart_wrapper" <?if ($count>3) { echo 'style="overflow-y:scroll;height:280px;"';};?>>
							<table class="cart_shell" width="100%" border="0">
								<tbody>
									<?
									$i = 0;
									foreach($arBasketIDs as $arItem){
										if(($arItem["CAN_BUY"] == "Y") && ($arItem["DELAY"] == "N")){
											++$i;

											$item=COptimusCache::CIBLockElement_GetList(array('CACHE' => array("MULTI"=>"N", "TAG" => COptimusCache::GetIBlockCacheTag($arItem["IBLOCK_ID"]))), array("ACTIVE"=>"Y", "ACTIVE_DATE" => "Y", "ID" => $arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PAGE_URL", "IBLOCK_ID", "PROPERTY_CML2_LINK", "PREVIEW_PICTURE", "DETAIL_PICTURE"));
											if($item["PROPERTY_CML2_LINK_VALUE"]){
												$itemLink=COptimusCache::CIBLockElement_GetList(array('CACHE' => array("MULTI"=>"N", "TAG" => COptimusCache::GetIBlockCacheTag($item["IBLOCK_ID"]))), array("ACTIVE"=>"Y", "ACTIVE_DATE" => "Y", "ID" => $item["PROPERTY_CML2_LINK_VALUE"]), false, false, array("ID", "PREVIEW_PICTURE", "IBLOCK_ID", "DETAIL_PICTURE"));
												if($itemLink){
													$item["ID"] = $itemLink["ID"];
													if($item["IBLOCK_ID"] != $itemLink["IBLOCK_ID"]){
														$item["IBLOCK_ID"]= $itemLink["IBLOCK_ID"];
													}
													if(!$item["PREVIEW_PICTURE"] && $itemLink["PREVIEW_PICTURE"]){
														$item["PREVIEW_PICTURE"] = $itemLink["PREVIEW_PICTURE"];
													}
													if(!$item["DETAIL_PICTURE"] && $itemLink["DETAIL_PICTURE"]){
														$item["DETAIL_PICTURE"] = $itemLink["DETAIL_PICTURE"];
													}
												}
											}
											if($item["PREVIEW_PICTURE"]){
												$item["PREVIEW_PICTURE"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], array('width' => 50, 'height' => 50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
											}
											elseif($item["DETAIL_PICTURE"]){
												$item["DETAIL_PICTURE"] = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array('width' => 50, 'height' => 50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
											}
											?>
											<tr class="catalog_item" product-id="<?=$arItem["ID"]?>" data-iblockid="<?=$item["IBLOCK_ID"];?>" data-offer="<?=( $item["ID"]!=$item["~ID"] ? "Y" : "N" );?>" catalog-product-id="<?=( $item["ID"]!=$item["~ID"] ? $item["~ID"] : $item["ID"] );?>">
												<td class="thumb-cell">
													<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
														<?if($item["PREVIEW_PICTURE"]):?>
															<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" alt="<?=($item["PREVIEW_PICTURE"]["alt"] ? $item["PREVIEW_PICTURE"]["alt"] : $arItem["NAME"]);?>" title="<?=($item["PREVIEW_PICTURE"]["title"] ? $item["PREVIEW_PICTURE"]["title"] : $arItem["NAME"]);?>" />
														<?elseif($item["DETAIL_PICTURE"]):?>
															<img src="<?=$item["DETAIL_PICTURE"]["src"]?>" alt="<?=($item["PREVIEW_PICTURE"]["alt"] ? $item["PREVIEW_PICTURE"]["alt"] : $arItem["NAME"]);?>" title="<?=($item["PREVIEW_PICTURE"]["title"] ? $item["PREVIEW_PICTURE"]["title"] : $arItem["NAME"]);?>" />
														<?else:?>
															<img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=($item["PREVIEW_PICTURE"]["alt"] ? $item["PREVIEW_PICTURE"]["alt"] : $arItem["NAME"]);?>" title="<?=($item["PREVIEW_PICTURE"]["title"] ? $item["PREVIEW_PICTURE"]["title"] : $arItem["NAME"]);?>" />
														<?endif;?>
													</a>
													<??>
												</td>
												<td class="item-title">
													<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="clearfix"><span><?=$arItem["NAME"]?></span></a>
													<?if($arItem["PROPS"]){?>
														<div class="props">
															<?foreach($arItem["PROPS"] as $arProp){?>
																<div class="item_prop"><span class="title"><?=$arProp["NAME"];?>:</span><span class="value"><?=$arProp["VALUE"];?></span></div>
															<?}?>
														</div>
													<?}?>
													<?$price=((isset($arItem["~PRICE"]) && $arItem["~PRICE"]) ? $arItem["~PRICE"] : $arItem["PRICE"] );?>
													<div class="one-item">
														<span class="value"><?=SaleFormatCurrency($price, $arItem["CURRENCY"]);?></span>
														<span class="measure">x <span><?=(float)$arItem["QUANTITY"];?></span> <?=($arItem["MEASURE_NAME"] ? $arItem["MEASURE_NAME"] : GetMessage("CML2_BASE_UNIT"));?>.</span>
													</div>
													<div class="cost-cell">														
														<input type="hidden" name="item_one_price_<?=$arItem["ID"]?>" value="<?=$arItem["~PRICE"];?>">
														<input type="hidden" name="item_one_price_discount_<?=$arItem["ID"]?>" value="<?=$arItem["DISCOUNT_PRICE"]?>">
														<input type="hidden" name="item_price_<?=$arItem["ID"]?>" value="<?=($price * $arItem["QUANTITY"])?>">
														<input type="hidden" name="item_price_discount_<?=$arItem["ID"]?>" value="<?=$arItem["DISCOUNT_PRICE"]?>">														
														<span class="price"><?=FormatCurrency($price * $arItem["QUANTITY"], $arItem["CURRENCY"]);?></span>
													</div>
													<div class="clearfix"></div>
													<!--noindex-->
														<div class="remove-cell">
															<span class="remove" data-id="<?=$arItem["ID"]?>" rel="nofollow" href="<?=SITE_DIR?>basket/?action=delete&id=<?=$arItem["ID"]?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"><i></i></span>
														</div>
													<!--/noindex-->
												</td>
											</tr>
										<?}?>
									<?}?>
								</tbody>
							</table>
						</div>
						<div class="basket_empty clearfix">
							<table cellspacing="0" cellpadding="0" border="0" width="100%">
								<tr>
									<td class="image"><div></div></td>
									<td class="description"><div class="basket_empty_subtitle"><?=GetMessage("BASKET_EMPTY_SUBTITLE")?></div><div class="basket_empty_description"><?=GetMessage("BASKET_EMPTY_DESCRIPTION")?></div></td>
								</tr>
							</table>
						</div>
						<div class="total_wrapp clearfix">
							<div class="total"><span><?=GetMessage("TOTAL_SUMM_TITLE")?>:</span><span class="price"><?=$summ_formated?></span><div class="clearfix"></div></div>
							<input type="hidden" name="total_price" value="<?=$summ?>" />
							<input type="hidden" name="total_count" value="<?=$count;?>" />
							<input type="hidden" name="delay_count" value="<?=$delayCount;?>" />
							<div class="but_row1">
								<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="button short"><span class="text"><?=GetMessage("GO_TO_BASKET");?></span></a>
							</div>
						</div>
						<?$paramsString = urlencode(serialize($arParams));?>
						<input id="top_basket_params" type="hidden" name="PARAMS" value='<?=$paramsString?>' />
					</div>
				</div>
			</div>
		</div>
		*/?>
	<script>
		$(document).ready(function(){
			function onLoadjqm(name, hash){
				$('.'+name+'_frame').jqmAddClose('.jqmClose');				
				$('.jqmOverlay').css('opacity', 0);
				$('.'+name+'_frame').css('right', $('#wrapper').offset().left);				
				$('.'+name+'_frame').show();
				$("html,body").scrollTop(0);
			}
			
			$('.basket_frame').remove();
			$.fn.cartToggle = function(){
				var $this = $(this),
					cart = $('.module-drop-cart');

				$this.click(function(e){
					e.preventDefault();

					if( cart.is(':visible')){
						$this.removeClass('cart_active');
						cart.fadeOut(200);
					}else{
						$this.addClass('cart_active');
						cart.fadeIn(200);		
					}
				})				
		
				$("html ,  body").live('mousedown', function(e) {
					e.stopPropagation(); 
					$this.removeClass('cart_active');		
					cart.fadeOut(200);
				});
				
				cart.find('*').live('mousedown', function(e) {
					e.stopPropagation();          
				});	
			}
			
			$('.cart-call').unbind();
			$('.cart-call').cartToggle()
		})
	</script>
<?//</div>?>

<?$frame->end();?>
