<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(strlen($arResult["ERROR_MESSAGE"])>0) ShowError($arResult["ERROR_MESSAGE"]);?>	
<?if(is_array($arResult["STORES"]) && !empty($arResult["STORES"])):?>
	<ul class="stores_list">
		<?foreach($arResult["STORES"] as $pid=>$arProperty):?>
			<li <?if ((intval($arParams["CURRENT_STORE"])==$arProperty["ID"])||(!$arParams["CURRENT_STORE"]&&($pid==0))):?>class="cur"<?endif;?>>				
				<i></i><a <?if ((!$arParams["CURRENT_STORE"])||($arParams["CURRENT_STORE"]!=$arProperty["ID"])):?>href="<?=$arProperty["URL"]?>"<?endif;?>><?=$arProperty["TITLE"]?></a>
				<? if($arProperty["ADDRESS"]):?><div class="description"><?=$arProperty["ADDRESS"]?></div><?endif;?>
			</li>
		<?endforeach;?>
	</ul>
<?endif;?>
<script>
	$(document).ready(function()
	{
		$("ul.stores_list a").click(function()
		{
			if (!$(this).parents("li").is(".cur"))
			{
				$(this).parents(".stores_list").find("li").removeClass("cur");
				$(this).parents("li").addClass("cur");
			}
		});
	});
</script>