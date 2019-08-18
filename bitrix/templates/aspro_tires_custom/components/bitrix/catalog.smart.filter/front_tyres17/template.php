<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$arResult["JS_FILTER_PARAMS"]['SEF_SET_FILTER_URL'] = $arResult["JS_FILTER_PARAMS"]['SEF_DEL_FILTER_URL'] = false;?>
<div class="img-l"><span><?=GetMessage("TIRES_FILTER_NAME");?></span></div>
<div class="filter-data">
	<h4 class="filter-title"><?=GetMessage("TIRES_FILTER_NAME");?></h4>
	<form class="filter_form_tyres" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=SITE_DIR?>search/tires/" method="get">
		<input type="hidden" name="set_filter" value="Y" />
		<input type="hidden" name="type_filter" value="tires" />
		<?foreach($arResult["HIDDEN"] as $arItem){?>
			<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<?}?>
		<div class="sel-row <?=($arResult["PROP"][$arParams["RUN_ON_FLAT"]] ? "rnf" : "" );?>">
			<?if( !empty( $arResult["PROP"]["SHIRINA_PROFILYA"] ) || !empty( $arResult["PROP"]["VYSOTA_PROFILYA"] ) || !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR"] ) ){?>
				<div class="params_section">
					<?if( !empty( $arResult["PROP"]["SHIRINA_PROFILYA"] ) ){?>
						<div class="sel-section">
							<div class="label"><?=GetMessage("WIDTH");?></div>
							<select>
								<option value="">&mdash;</option>
								<?foreach( $arResult["PROP"]["SHIRINA_PROFILYA"][0]["VALUES"] as $val ){?>
									<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
								<?}?>
							</select>
						</div>
						<span class="inline-help slash">/</span>
					<?}?>
					<?if( !empty( $arResult["PROP"]["VYSOTA_PROFILYA"] ) ){?>
						<div class="sel-section">
							<div class="label"><?=GetMessage("HEIGHT");?></div>
							<select>
								<option value="">&mdash;</option>
								<?foreach( $arResult["PROP"]["VYSOTA_PROFILYA"][0]["VALUES"] as $val ){?>
									<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
								<?}?>
							</select>
						</div>
					<?}?>
					<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR"] ) ){?>
						<span class="inline-help radius">R</span>
						<div class="sel-section">
							<div class="label"><?=GetMessage("DIAMETER");?></div>
							<select>
								<option value="">&mdash;</option>
								<?foreach( $arResult["PROP"]["POSADOCHNYY_DIAMETR"][0]["VALUES"] as $val ){?>
									<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
								<?}?>
							</select>
						</div>
					<?}?>
				</div>
			<?}?>
			<?if( !empty( $arResult["PROP"]["SEZONNOST"] ) || !empty( $arResult["PROP"]["SHIPY"] ) || !empty( $arResult["PROP"][$arParams["RUN_ON_FLAT"]] ) ){?>
				<div class="ch-section">
					<?if($arResult["PROP"]["SEZONNOST"]){?>
						<?foreach( $arResult["PROP"]["SEZONNOST"][0]["VALUES"] as $arValue ){?>
							<div class="check-block">
								<input type="checkbox" name="<?=$arValue["CONTROL_ID"]?>" id="<?=$arValue["CONTROL_ID"]?>" value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
								<?
									$seasonClass = "";
									if (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
									elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
									elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
								?>
								<label <?if (strlen($seasonClass)):?>class="icon-<?=$seasonClass?>"<?endif;?> for="<?=$arValue["CONTROL_ID"]?>">

									<span><?=$arValue["VALUE"]?></span>
								</label>
							</div>
						<?}?>
					<?}?>
					<?if(!empty($arResult["PROP"]["SHIPY"][0]["VALUES"])){?>
						<?foreach ($arResult["PROP"]["SHIPY"][0]["VALUES"] as $key => $arValue){?>
							<div class="check-block">
								<input type="checkbox" name="<?=$arValue["CONTROL_ID"]?>" id="<?=$arValue["CONTROL_ID"]?>" value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
								<label class="icon-spikes" for="<?=$arValue["CONTROL_ID"]?>"><span><?=$arResult["PROP"]["SHIPY"][0]["NAME"]?></span></label>
							</div>
						<?}?>
					<?}?>
					<?if(isset($arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"] )){?>
						<div class="check-block">
							<input type="checkbox" name="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>" id="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>" value="Y" <?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
							<label class="icon-rnf" for="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>"><span><?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"];?></span></label>
						</div>
					<?}?>
				</div>
			<?}?>
			<div class="but-row">
				<!--noindex-->
					<button class="button1" type="submit" name="box_type" id="set_filter_tires" onclick="return sendQueryTires();" value="params"><span><?=GetMessage("SUBMIT");?></span></button>
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
var sendQueryTires = function(){
	smartFilterTires.click($(".filter_form_tyres input").first()[0])
	return false;
}

var smartFilterTires = new JCSmartFilter('<?=SITE_DIR.'search/tires/'?>', 'horizontal', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);

$('form.filter_form_tyres select').change(function(){
	$(this).attr('name', $(this).find('option:eq('+$(this)[0].selectedIndex+')').attr('data-value'));
})

$(document).ready(function(){
	if($('.sel-row').length && $('.sel-row').hasClass('rnf')){
		$('.sel-row').addClass('rnf');
	}
})
</script>