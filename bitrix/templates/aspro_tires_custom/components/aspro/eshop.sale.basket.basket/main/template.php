<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if( StrLen($arResult["ERROR_MESSAGE"])<=0 ){
	$arUrlTempl = Array( "delete" => $APPLICATION->GetCurPage()."?action=delete&id=#ID#",
						 "shelve" => $APPLICATION->GetCurPage()."?action=shelve&id=#ID#",
						 "add" => $APPLICATION->GetCurPage()."?action=add&id=#ID#",
	);
	if(is_array($arResult["WARNING_MESSAGE"]) && !empty($arResult["WARNING_MESSAGE"]))
	{ foreach($arResult["WARNING_MESSAGE"] as $v) { echo ShowError($v); } }
?>

	<?
		$countItemsReady = count($arResult["ITEMS"]["AnDelCanBuy"]);
		$countItemsSubscribe = count($arResult["ITEMS"]["ProdSubscribe"]);
		$countItemsDelay = count($arResult["ITEMS"]["DelDelCanBuy"]);
		$countItemsNotAvailable = count($arResult["ITEMS"]["nAnCanBuy"]);
	?>
	
	<div class="basket_sort">
		<span class="title"><?=GetMessage("SALE_PRODUCTS")?></span>
		<ul class="tabs">
			<li class="cur">
				<a><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></a>
				<span class="quantity"><?=$countItemsReady?></span>
				<div class="triangle"></div>
			</li>
			<?if ($countItemsDelay):?>
				<li>
					<a><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?></a>
					<span class="quantity"><?=$countItemsDelay?></span>
					<div class="triangle"></div>
				</li>
			<?endif;?>
			<?if ($countItemsSubscribe):?>
				<li>
					<a><?=GetMessage("SALE_PRD_IN_BASKET_SUBSCRIBE")?></a>
					<span class="quantity"><?=$countItemsSubscribe?></span>
					<div class="triangle"></div>
				</li>
			<?endif?>
			<?if ($countItemsNotAvailable):?>
				<li>
					<a><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?></a>
					<span class="quantity"><?=$countItemsNotAvailable?></span>
					<div class="triangle"></div>
				</li>
			<?endif?>
		</ul>
	</div>

	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" class="basket_wrapp">
		<div class="tabs-content">
			<ul>
				<li class="cur"><?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");?></li>
				<?if ($countItemsDelay):?>
					<li><?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delay.php");?></li>
				<?endif;?>
				<?if ($countItemsSubscribe):?>
					<li><?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribe.php");?></li>
				<?endif;?>
				<?if ($countItemsNotAvailable):?>
					<li><?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_notavail.php");?></li>
				<?endif;?>
			</ul>
		</div>
	</form>
	
<?}else{?>
	<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");?>
<?}?>


<script>

	<?if ($countItemsSubscribe||$countItemsDelay||$countItemsNotAvailable):?>
		var basketCurrentTab = localStorage['wheelsTiresBasketCurrentTab'];
		if (basketCurrentTab) 
		{ 
			$(".basket_sort .tabs li").removeClass("cur");
			$(".basket_sort .tabs li:eq("+basketCurrentTab+")").addClass("cur");
			$(".tabs-content ul li").removeClass("cur");
			$(".tabs-content ul li:eq("+basketCurrentTab+")").addClass("cur");
		}
	<?endif;?>

	$(".basket_sort .tabs li").click( function()
	{
		if (!$(this).is(".cur"))
		{
			localStorage['wheelsTiresBasketCurrentTab'] = $(this).index();
			$(".basket_sort .tabs li").removeClass("cur");
			$(this).addClass("cur");
			$(".tabs-content ul li").removeClass("cur");
			$(".tabs-content ul li:eq("+$(this).index()+")").addClass("cur");
		}
		
	});

	<?if ($arParams["AJAX_MODE"]=="Y"):?>
		$('form[name^=basket_form] .remove').click( function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$.post( href, $.proxy(
					function( data ){
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket.php', 'content', true);
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket_line.php', 'basket_line', false);
					}
				)
			);
		})
		$('form[name^=basket_form] .count').change( function(){
			var vall=$(this).val();	
			var ids=$(this).attr("data-id");	
			var name="QUANTITY_"+ids;

			$('form[name^=basket_form]').prepend('<input type="hidden" name='+name+' value='+vall+' />');
			$('form[name^=basket_form]').prepend('<input type="hidden" name="BasketRefresh" value="Y" />');
			
			$.post( '<?=SITE_DIR?>basket/', $("form[name^=basket_form]").serialize(), $.proxy(
					function( data){
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket.php', 'content', true);
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket_line.php', 'basket_line', false);
					}
				)
			);
		})
		$('form[name^=basket_form] .apply-button').click( function(e){
			$('form[name^=basket_form]').prepend('<input type="hidden" name="BasketRefresh" value="Y" />');
			$.post( '<?=SITE_DIR?>basket/', $("form[name^=basket_form]").serialize(), $.proxy(
					function( data ){
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket.php', 'content', true);
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket_line.php', 'basket_line', false);
					}
				)
			);
		})
		$('form[name^=basket_form] .set_aside').click( function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$.post( href, $.proxy(
					function( data ){
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket.php', 'content', true);
						jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_basket_line.php', 'basket_line', false);
					}
				)
			);
		})
	<?endif;?>
</script>