<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$count=ceil($arResult["SECTIONS_COUNT"]/$arParams["SECTION_PAGE_ELEMENT"]);?>
<?if($count>1){?>
	<div class="module-pagination ">

		<?if($_REQUEST["PAGEN_2"]>1 && $_REQUEST["PAGEN_2"]<$count){?>
				<a href="<?=$APPLICATION->GetCurPageParam("PAGEN_2=".($_REQUEST["PAGEN_2"]-1), array("PAGEN_2"))?>" class="prev"></a>
		<?}elseif($_REQUEST["PAGEN_2"]<=1){?>
			<a href="" class="prev disabled"></a>
		<?}elseif($_REQUEST["PAGEN_2"]=$count){?>
			<a href="<?=$APPLICATION->GetCurPageParam("PAGEN_2=".($_REQUEST["PAGEN_2"]-1), array("PAGEN_2"))?>" class="prev"></a>
		<?}?>
		
		<span class="nums">
			<?for($i=0; $i<$count;$i++){?>
					<?if($_REQUEST["PAGEN_2"]==$i+1 || ($_REQUEST["PAGEN_2"]=='' && $i+1==1) ){?>
						<a href="#" class="cur"><?=$i+1;?></a>
					<?}else{?>
					<a href="<?=$APPLICATION->GetCurPageParam("PAGEN_2=".($i+1), array("PAGEN_2"))?>"><?=$i+1;?></a>
					<?}?>
			<?}?>
		</span>
		
		<?if($_REQUEST["PAGEN_2"]>1 && $_REQUEST["PAGEN_2"]<$count){?>
			<a href="<?=$APPLICATION->GetCurPageParam("PAGEN_2=".($_REQUEST["PAGEN_2"]+1), array("PAGEN_2"))?>" class="next"></a>			
		<?}elseif($_REQUEST["PAGEN_2"]<=1){?>
			<a href="<?=$APPLICATION->GetCurPageParam("PAGEN_2=".($_REQUEST["PAGEN_2"]+1), array("PAGEN_2"))?>" class="next"></a>
		<?}elseif($_REQUEST["PAGEN_2"]=$count){?>
			<a href="" class="next disabled"></a>
		<?}?>
		
	</div>
<?}?>
<?$APPLICATION->SetTitle($arResult["SECTION"]["NAME"]);?>
<script>
	$(document).ready(function()
	{
		$(".module-pagination span.nums a").live("click", function()
		{
			if (!$(this).is(".cur"))
			{
				$(".module-pagination span.nums a").removeClass("cur"); 
				$(this).addClass("cur");
			}
		});
		$(".module-pagination .next").live("click", function()
		{
		console.log($(this).is(".disabled"));
		
		
		
			if (!$(this).is(".disabled"))
			{
				element = $(".module-pagination span.nums a.cur");
				$(".module-pagination span.nums a").removeClass("cur"); 
				element.next("span.nums a").addClass("cur");
			}
		});
		$(".module-pagination .prev").live("click", function()
		{
			if (!$(this).is(".disabled"))
			{
				element = $(".module-pagination span.nums a.cur");
				$(".module-pagination span.nums a").removeClass("cur"); 
				element.prev("span.nums a").addClass("cur");
			}
		});
		
	});
</script>