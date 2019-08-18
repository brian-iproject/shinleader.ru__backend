<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if( !empty( $arResult ) ):?>

	<ul class="mini-menu">
		<li>
			<a class="mini_menu_opener"><span><?=GetMessage('MENU_TITLE')?></span><i></i></a>
			<div class="mini-menu-wrapp">
				<ul>
					<?foreach( $arResult as $key => $arItem ){?>
						<?if( $arItem["DEPTH_LEVEL"] == 1 ){?>
							<li>
								<a href="<?=$arItem["LINK"]?>" class="gradient<?if ($arItem["SELECTED"]):?> cur<?endif;?>"><?=$arItem["TEXT"]?></a>
							</li>
						<?}?>
					<?}?>
					<li>
						<div class="mini-search">
							<?$APPLICATION->IncludeComponent("bitrix:search.form", "diskishini.search.form", array(
								"PAGE" => "#SITE_DIR#catalog/search/",
								"USE_SUGGEST" => "N"
								), false
							);?>
						</div>
					</li>
				</ul>
			</div>
		</li>
	</ul>	
		
	<ul class="menu-wrapp">
		<li class="catalog_menu_opener">
			<a class="gradient"><span><?=GetMessage("CATALOG_TITLE")?></span></a>
			<div class="child_submenu">
				<?foreach( $arResult as $key => $arItem ){?>
					<?if($arItem["PARAMS"]["CATALOG_ITEM"]):?>
						<?if($key==0):?><div class="top_block"></div><?endif;?>
						<a class="gradient<?=$arItem["SELECTED"] ? " cur" : ''?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<?endif;?>
				<?}?>
			</div>
		</li>
		<?foreach( $arResult as $key => $arItem ){?>
			<li<?=($key==0) ? " class='first'" : ''?><?if($arItem["PARAMS"]["CATALOG_ITEM"]):?> catalog_item="true"<?endif;?>>
				<a href="<?=$arItem["LINK"]?>" class="<?if( ($arItem["IS_PARENT"] == 1)&&($arItem["SELECTED"]) ){echo "parent-cur ";}?>gradient<?=$arItem["SELECTED"] ? " cur" : ''?>"><span><?=$arItem["TEXT"]?></span></a>	
				<?if( $arItem["IS_PARENT"] == 1 ){?>
					<div class="child_submenu">
						<?foreach( $arItem["ITEMS"] as $key => $arSubItem ){?>
							<?if($key==0):?><div class="top_block"></div><?endif;?>
							<a class="gradient<?=$arSubItem["SELECTED"] ? " cur" : ''?>" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
						<?}?>
					</div>
				<?}?>
			</li>
		<?}?>
	</ul>
	
<?endif;?>

<script>
	$(".mini-menu .mini_menu_opener").on("click", function()
	{
		$(".main-nav .mini-menu-wrapp").slideToggle(200);
	});
	
	$(window).resize(function()
	{
		if ($(window).width()>700)
		{
			$(".main-nav .mini-menu-wrapp").slideUp(200);
			$("ul.mini-menu a").removeClass("cur");
		}
	});
	
	$(document).ready(function()
	{
		$(".main-nav li").hover(
			function()
			{
				var subMenu = $(this).find(".child_submenu");
				if (subMenu.length)
				{
					$(this).find("a").first().addClass("cur");
					subMenu.show();
				}
			},
			function()
			{
				var subMenu = $(this).find(".child_submenu");
				if (subMenu.length)
				{
					if (!$(this).find("a.parent-cur").length)
					{
						$(this).find("a").first().removeClass("cur");
					}
					subMenu.hide();
				}
			}
		);
		$(".main-nav li a").live("click", function(event)
		{
			event.stopPropagation();
			if (!$(this).is(".mini_menu_opener"))
			{
				if ($(this).parents(".mini-menu-wrapp").length ) 
				{ 	
					$(this).parents(".mini-menu-wrapp").find("li a").removeClass("cur"); 
				}
				if (!$(this).parents(".child_submenu").length) 
				{
					$("ul.menu-wrapp").find("a").removeClass("parent-cur");
					$(this).parents("li").find("a").removeClass("cur"); 
				}
				else 
				{ 
					$(this).parents(".child_submenu").find("a").removeClass("cur"); 
					$(this).parents("ul.menu-wrapp").find("li a").removeClass("cur");
					$(this).parents(".child_submenu").prev("a").addClass("parent-cur").addClass("cur");
				}
				if($(this).parent("li").parent("ul.menu-wrapp").length && !$(this).parents(".child_submenu").length)
				{
					$("ul.menu-wrapp").find("li a").removeClass("cur");
				}
				if($(this).find(".child_submenu"))
				{
					$(this).addClass("parent-cur");

				}	
				$(this).addClass("cur");
			}

			else
			{
				if ($(this).is(".cur"))
				{
					$(this).removeClass("cur");
				}
				else
				{
					$(this).addClass("cur");
				}
				
			}
		});
	});
</script>