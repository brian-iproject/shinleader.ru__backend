<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<ul class="bottom_menu">
	<? foreach($arResult as $key => $arItem): if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)  continue;?>
		<li><a href="<?=$arItem["LINK"]?>" <?=$arItem["SELECTED"] ? "class='cur'" : '' ?>><?=$arItem["TEXT"]?></a></li>
	<?endforeach?>
	</ul>
<?endif?>
<script>
	$(document).ready(function()
	{
		$(".bottom_menu a").live("click", function()
		{
			if (!$(this).is(".cur"))
			{
				$(".bottom_menu a").removeClass("cur"); 
				$(this).addClass("cur");
			}
		});
	});
</script>