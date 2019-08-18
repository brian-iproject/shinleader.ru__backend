<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<span class="top_left_menu">
	<?if (!empty($arResult)):?>
		<? foreach($arResult as $key => $arItem): if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)  continue;?>
			<a href="<?=$arItem["LINK"]?>" <?=$arItem["SELECTED"] ? "class='cur'" : '' ?>><?=$arItem["TEXT"]?></a>
			<?if ($arResult[$key+1]):?><i class="separator"></i><?endif;?>
		<?endforeach?>
	<?endif?>
</span>
<script>
	$(document).ready(function()
	{
		$(".top_left_menu a").live("click", function()
		{
			if (!$(this).is(".cur"))
			{
				$(".top_left_menu a").removeClass("cur"); 
				$(this).addClass("cur");
			}
		});
	});
</script>