<?if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) 	die();?>
<?IncludeTemplateLangFile(__FILE__);?>
			</div>
		</div>
	</section>
</div>

<footer id="footer">
	<div class="footer-inner">
		<div class="foo-wrapp">
			<div class="info_wrapp">
				<div class="foo-contact">
					<div class="title"><?=GetMessage("CONTACT_US");?></div>
					<div class="phone-block">
						<span class="border-wrapp">
							<span class="phone-code"><?$APPLICATION->IncludeFile(SITE_DIR."include/phone_code.php", Array(), Array( "MODE" => "html", "NAME" => GetMessage("PHONE_CODE"), ));?></span>
							<span class="phone"><?$APPLICATION->IncludeFile(SITE_DIR."/include/phone.php", Array(), Array( "MODE" => "html", "NAME" => GetMessage("PHONE"), ));?></span>							
						</span>
					</div>
					<div class="adress">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/address.php", Array(), Array( "MODE" => "html", 	"NAME" => GetMessage("ADDRESS"), )); ?>								
					</div>
					<div class="email">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/email.php", Array(), Array( "MODE" => "html", 	"NAME" => GetMessage("EMAIL"), )); ?>								
					</div>
				</div>
				<div class="work-time-wrapp">
					<div class="work-time">
						<div class="title"><?=GetMessage("WORK_TIME");?></div>
						<div class="time">
							<?$APPLICATION->IncludeFile(SITE_DIR."include/work_time.php", Array(), Array( "MODE" => "html", "NAME"  => GetMessage("WORK_TIME"),));?>			
						</div>
					</div>

				</div>
				<div class="clearboth"></div>
			</div>
			<div class="menu_wrapp">
				<div class="menu">
					<a href="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/215616/reviews"><img src="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2506/*http://grade.market.yandex.ru/?id=215616&action=image&size=1" border="0" width="120" height="110" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" /></a>
				</div>
				<div class="menu">
					<div class="title"><?=GetMessage("CATALOG");?></div>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
						"ROOT_MENU_TYPE" => "bottom_catalog",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "1",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					),false
					);?>
					<br>
					<div class="title"><?=GetMessage("FOR_CUSTOMER");?></div>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
						"ROOT_MENU_TYPE" => "bottom_for_customer",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "1",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					),false
					);?>
				</div>
				<div class="menu">
					<div class="title"><?=GetMessage("ABOUT");?></div>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
						"ROOT_MENU_TYPE" => "bottom_about",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "1",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),false
					);?>
				</div><div class="clearboth"></div>
			</div><div class="clearboth"></div>
		</div>					
	</div>	
	<div class="footer-bottom">
		<div class="foo-wrapp">
			<div class="copyright">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php", Array(), Array( "MODE" => "html", "NAME"  => GetMessage("COPYRIGHT"),));?>
			</div>
			<div class="social">
				<?/*$APPLICATION->IncludeComponent("aspro:social.info", "main", array(
	"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"VK" => "http://vkontakte.ru/shinleader.ru/",
		"FACE" => "http://www.facebook.com/shinleader.ru/",
		"TWIT" => "http://twitter.com/shinleader.ru/"
	),
	false
);*/?> 
			</div>
			<?$APPLICATION->IncludeFile("/include/bottom_include1.php", Array(), Array( "MODE"      => "text", "NAME"      => GetMessage("ARBITRARY_1"), )); ?>
			<?$APPLICATION->IncludeFile("/include/bottom_include2.php", Array(), Array( "MODE"      => "text", "NAME"      => GetMessage("ARBITRARY_2"), )); ?>
		</div><div class="clearboth"></div>
	</div>
</footer>		

<div class="scroll-to-top"><i></i><span><?=GetMessage("SCROLL_UP")?></span></div>
<?
	/*if( !CSite::inDir(SITE_DIR."index.php") )
	{
		if( strlen($APPLICATION->GetPageProperty('title') ) > 1){ $title = $APPLICATION->GetPageProperty('title'); } 
		else { $title = $APPLICATION->GetTitle(); }
		$APPLICATION->SetPageProperty("title", $title.' - '.$fields['SITE_NAME']);
		$APPLICATION->AddChainItem($title);
	}*/
	/*else
	{
		if( strlen($APPLICATION->GetPageProperty('title') ) > 1){ $title =  $APPLICATION->GetPageProperty('title'); }
		else{ $title =  $APPLICATION->GetTitle(); }
		$APPLICATION->SetPageProperty("title", $fields['SITE_NAME'].(!empty($title)? ' - ': ' '));
	}*/
	/*if (CModule::IncludeModule("sale"))
	{
		$dbBasketItems = CSaleBasket::GetList( 
			array( "NAME" => "ASC", "ID" => "ASC" ),
			array( "FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "CAN_BUY" => "Y", "DELAY" => "N", "SUBSCRIBE" => "N"
			), false, false, array("ID", "PRODUCT_ID")
		);
		while( $arBasketItems = $dbBasketItems->GetNext() ){$basket_items[] = $arBasketItems["PRODUCT_ID"];}
	}*/
?> 
		 
<?if( !empty( $basket_items ) ){?>
	<script>
		$(document).ready(function(){
			<?foreach( $basket_items as $item ){?>
				$('.item_<?=$item?> .to-cart').hide();
				$('.item_<?=$item?> .in-cart').show();
			<?}?>
		});
	</script>
<?}?>
<script>
	$(document).ready(function()
	{
		$('.fancy').fancybox(
		{
			openEffect  : 'fade',
			closeEffect : 'fade',
			nextEffect : 'fade',
			prevEffect : 'fade',
			tpl: {
				closeBtn	: '<a title="<?=GetMessage("FANCY_CLOSE")?>" class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next		: '<a title="<?=GetMessage("FANCY_NEXT")?>" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
				prev		: '<a title="<?=GetMessage("FANCY_PREV")?>" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
			}
		});
	});
</script>
</body></html>