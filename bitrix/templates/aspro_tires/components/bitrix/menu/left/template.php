<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<ul class="side-menu">
		<? foreach($arResult as $arItem):?>
			<?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>	
			<li <?=$arItem["SELECTED"] ? "class='cur'" : '' ?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><i></i></a></li>
		<?endforeach?>
	</ul>
	<script>
		$(document).ready(function()
		{
			$(".side-menu li a").live("click", function()
			{
				if (!$(this).parent("li").is(".cur"))
				{
					$(".side-menu li").removeClass("cur"); 
					$(this).parent("li").addClass("cur");
				}
			});
		});
	</script>
<?endif?>
