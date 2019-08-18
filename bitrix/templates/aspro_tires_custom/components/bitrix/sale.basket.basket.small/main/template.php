<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!CModule::IncludeModule("iblock")) break;?>
<?if(!CModule::IncludeModule("catalog")) break;?>
<?//CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());?>
<?
	if (!function_exists('declOfNum')) 
	{
		function declOfNum($number, $titles)
		{
			$cases = array (2, 0, 1, 1, 1, 2);
			return sprintf($titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ], $number);
		}
	}

	$count = 0; $summ = 0;
	foreach( $arResult["ITEMS"] as $arItem )
	{
		if( $arItem["DELAY"] == 'N' && $arItem["CAN_BUY"] == 'Y')
		{
			$count++;
			$summ += ( $arItem["PRICE"]+$arItem["DISCOUNT_PRICE"] )*$arItem["QUANTITY"];
		}
	}
	$cur = CCurrencyLang::GetCurrencyFormat(($arResult["ITEMS"] ? $arResult["ITEMS"][0]["CURRENCY"] : COption::GetOptionString('sale', 'default_currency', 'RUB')));
?>
<!--noindex-->
<?if( $count > 0 ):?>
	<div class="cart">
		<a class="active cart-call pseudo" href="#" rel="nofollow"><?=GetMessage("BASKET");?></a><br />
		<span class="black"><?=$count;?></span> <span class="grey"><?=declOfNum($count, array(GetMessage("PRODUCTS_ONE"), GetMessage("PRODUCTS_TWO"), GetMessage("PRODUCTS_FIVE")))?></span><br />
		<span class="grey"><?=GetMessage("NA");?></span> 
		<span class="black"><?=FormatCurrency($summ, $cur["CURRENCY"])?></span>
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
		$cache_path = SITE_DIR.'aspro_basket/';?>
		<?$i = 0;?>
		<?foreach( $arResult["ITEMS"] as $arItem )
		{	
			if (($arItem["CAN_BUY"]=="Y")&&($arItem["DELAY"]=="N"))
			{
			$id = '';
			if( $i >= 3 ) break;
			$cache_id = 'aspro_basket_'.$arItem["PRODUCT_ID"];
			
			if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) ){
				$res = $cache->GetVars();
				$item = $res["item"];
				//$section = $res["section"];
			}else{
				if( $objRes = CIBlockElement::GetList(array(), array("ID" => $arItem["PRODUCT_ID"]))->GetNextElement() ){
					$res = $objRes->GetFields();
					$res["PROPERTIES"] = $objRes->GetProperties();
					//$Select=array("DETAIL_PICTURE", "ID", "SECTION_CODE", "DETAIL_PAGE_URL", "PROPERTY_SHIRINA_PROFILYA", "PROPERTY_VYSOTA_PROFILYA", "PROPERTY_POSADOCHNYY_DIAMETR","PROPERTY_POSADOCHNYY_DIAMETR_DISKA", "PROPERTY_SHIRINA_DISKA", "PROPERTY_MEZHBOLTOVOE_RASSTOYANIE", "PROPERTY_CML2_BASE_UNIT");
                	if( !empty( $res["PROPERTIES"]["CML2_LINK"] ) ){
						$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["PROPERTIES"]["CML2_LINK"]["VALUE"]), false, false, array());
						//$rsitem->SetUrlTemplates("/catalog/id/#ELEMENT_ID#/");
						$item = $rsitem->GetNext();
						if( !empty( $item["DETAIL_PICTURE"] ) ){
							$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						}
						
					}else{
						$rsitem = CIBlockElement::GetList(array(), array("ID" => $res["ID"]), false, false, array());
					//	$rsitem->SetUrlTemplates("/catalog/id/#ELEMENT_ID#/");
						$item = $rsitem->GetNext();
						if( !empty( $item["DETAIL_PICTURE"] ) ){
							$item["DETAIL_PICTURE"] = CFile::ResizeImageGet( $item["DETAIL_PICTURE"], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						}
					}
					//$section =CIBlockSection::GetList(array(), array("ID" =>$item["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_ID", "PICTURE"))->GetNext();
				
					if ($cache_time > 0)
					{
						$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
						$cache->EndDataCache( 
							array( 
								"item" => $item,
								// "section" => $section
							) 
						);
					}
				}
			}
			if( !empty( $item ) ){?>			
				<tr>
					<td class="thumb-cell">
					
					<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arItem["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"] ), false, array( "ID", "DETAIL_PICTURE", "PICTURE"))->GetNext();?>	
				
				
						<?if( $item["DETAIL_PICTURE"] != "" ):?>
							<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$item["DETAIL_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
						<?elseif(!empty($arSection["DETAIL_PICTURE"])):?>
							<?$img = CFile::ResizeImageGet( $arSection["DETAIL_PICTURE"], array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
							<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
						<?elseif(!empty($arSection["PICTURE"])):?>
							<?$img = CFile::ResizeImageGet( $arSection["PICTURE"], array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
							<a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
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
<script>
	$(document).ready(function(){
		function onLoadjqm(name, hash){
			$('.'+name+'_frame').jqmAddClose('.jqmClose');
			
			$('.jqmOverlay').css('opacity', 0);
			$('.'+name+'_frame').css('right', $('#wrapper').offset().left);
			
			$('.'+name+'_frame').show();
			//alert(1);
			$("html,body").scrollTop(0);
		}
		
		$('.basket_frame').remove();
		//$('#header').append('<div class="basket_frame module-drop-cart"></div>');
		
		//$('.basket_frame').jqm({trigger: '.cart-call', onLoad: function(hash){ onLoadjqm('basket', hash); }, ajax: '/ajax/popup_basket.php'});
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