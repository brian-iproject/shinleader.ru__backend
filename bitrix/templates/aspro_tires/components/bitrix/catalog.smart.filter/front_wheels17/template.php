<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$arResult["JS_FILTER_PARAMS"]['SEF_SET_FILTER_URL'] = $arResult["JS_FILTER_PARAMS"]['SEF_DEL_FILTER_URL'] = false;?>
<div class="img-l"><span><?=GetMessage("WHEELS_FILTER_NAME");?></span></div>
<div class="filter-data">
	<h4 class="filter-title"><?=GetMessage("WHEELS_FILTER_NAME");?></h4>
	<form class="filter_form_disk" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=SITE_DIR?>search/wheels/" method="get">
		<input type="hidden" name="set_filter" value="Y" />
		<input type="hidden" name="type_filter" value="wheels" />
		<?foreach($arResult["HIDDEN"] as $arItem){?>
			<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<?}?>
		<div class="sel-row d">

			<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"] ) && !empty( $arResult["PROP"]["SHIRINA_DISKA"])){?>
				<span class="filter_row">
			<?}?>
				<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"] ) ){?>
					<div class="sel-section">
						<div class="label"><?=GetMessage("DIAMETER")?></div>
						<select class="s1">
							<option value="">&mdash;</option>
							<?foreach( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"][0]["VALUES"] as $val ){?>
								<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
							<?}?>
						</select>
					</div>
					<span class="inline-help x">&times;</span>
				<?}?>
				<?if( !empty( $arResult["PROP"]["SHIRINA_DISKA"] ) ){?>
					<div class="sel-section">
						<div class="label"><?=GetMessage("WIDTH")?></div>
						<select class="s2">
							<option value="">&mdash;</option>
							<?foreach( $arResult["PROP"]["SHIRINA_DISKA"][0]["VALUES"] as $val ){?>
								<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
							<?}?>
						</select>
					</div>
				<?}?>
			<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"] ) &&!empty( $arResult["PROP"]["SHIRINA_DISKA"])){?>
				</span>
			<?}?>

			<?if( !empty( $arResult["PROP"]["COUNT_OTVERSTIY"] ) &&!empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"])){?>
				<span class="filter_row">
			<?}?>

				<?if( !empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"] ) ){?>
					<div class="sel-section">
						<div class="label"><?=GetMessage("HOLE");?></div>
						<select class="s4">
							<option value="">&mdash;</option>
							<?foreach( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"][0]["VALUES"] as $val ){?>
								<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
							<?}?>
						</select>
					</div>
				<?}?>

				<span class="inline-help x ml">&times;</span>



				<?if( !empty( $arResult["PROP"]["COUNT_OTVERSTIY"] ) ){?>
					<div class="sel-section no-label">
						<div class="label"><?=GetMessage("COUNT_OTVERSTIY");?></div>
						<select class="s3">
							<option value="">&mdash;</option>
							<?foreach( $arResult["PROP"]["COUNT_OTVERSTIY"][0]["VALUES"] as $val ){?>
								<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
							<?}?>
						</select>
					</div>
				<?}?>


			<?if( !empty( $arResult["PROP"]["COUNT_OTVERSTIY"] ) &&!empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"])){?>
				</span>
			<?}?>

			<div class="but-row d">
				<!--noindex-->
					<button class="button1" type="submit" name="box_type" id="set_filter_wheels" onclick="return sendQueryWheels();" value="params"><span><?=GetMessage("SUBMIT")?></span></button>
					<?if (COption::GetOptionString("aspro.tires", "USE_FILTERS", SITE_ID)=="Y"){?>
						<button class="button2 full" type="submit" name="box_type" value="avto"><span><?=GetMessage("BY_CAR")?></span></button>
						<button class="button2 short" type="submit" name="box_type" value="avto"><span><?=GetMessage("BY_CAR_SHORT")?></span></button>
					<?}?>
				<!--/noindex-->
			</div>
		</div>
	</form>
</div>
<script>
var sendQueryWheels = function(){
	smartFilterWheels.click($(".filter_form_disk input").first()[0])
	return false;
}

var smartFilterWheels = new JCSmartFilter('<?=SITE_DIR.'search/wheels/'?>', 'horizontal', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);

$('form.filter_form_disk select').change(function(){
	$(this).attr('name', $(this).find('option:eq('+$(this)[0].selectedIndex+')').attr('data-value'));
})
</script>