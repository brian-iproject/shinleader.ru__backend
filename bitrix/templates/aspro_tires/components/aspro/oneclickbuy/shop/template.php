<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="popup-intro">
		<div class="pop-up-title"><?=GetMessage('FORM_HEADER_CAPTION')?></div>
		<div class="after-title">
			<span class="description-wrapp">
				<?=GetMessage("FORM_DESCRIPTION")?>
			</span>
		</div>
	</div>
	<a class="jqmClose close"></a>

	<div class="form-wr">

		<form method="post" id="one_click_buy_form" action="<?=$arResult['SCRIPT_PATH']?>/script.php">
				<?foreach($arParams['PROPERTIES'] as $field):?>
					<div class="r">
						<?
							if ($USER->IsAuthorized())
							{
								if ($field=='EMAIL') $value = $USER->GetEmail();
								elseif ($field=='FIO') $value = $USER->GetFullName();
								elseif ($field=='PHONE') $value = $arResult['USER_PHONE'];
							}
						?>
						<label class="description">
							<?//=GetMessage('CAPTION_'.$field)?>
							<?if($field == "COMMENT"):?>
								<?=GetMessage('CAPTION_'.$field)?>
							<?else:?>
								<?=$arResult["PROPS"][$field];?>
							<?endif;?>
							<?if (in_array($field, $arParams['REQUIRED'])):?><span class="star">*</span><?endif;?>
						</label>
						<?if ($field=="COMMENT"):?><textarea name="ONE_CLICK_BUY[<?=$field?>]" id="one_click_buy_id_<?=$field?>"></textarea>
						<?else:?><input class="<?=strtolower($field);?> <?=((in_array($field, $arParams['REQUIRED'])) ? 'required' : '');?>" type="text" name="ONE_CLICK_BUY[<?=$field?>]" value="<?=$value?>" id="one_click_buy_id_<?=$field?>" /><?endif;?>
					</div>
				<?endforeach;?>
				<?if(COption::GetOptionString("aspro.tires", "SHOW_LICENCE", "N") == "Y"):?>
					<div class="clearboth"></div>
					<div class="r">
						<div class="licence_block filter label_block">
							<label for="licenses_popup_OCB" class="license">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
							</label>
							<input type="checkbox" id="licenses_popup_OCB" name="licenses_popup_OCB" required value="Y">
						</div>
					</div>
				<?endif;?>
				<?if ($arParams['USE_SKU']=="Y"):?>
					<input type="hidden" name="IBLOCK_ID" value="<?=$arParams['IBLOCK_ID']?>" />
					<input type="hidden" name="USE_SKU" value="Y" />
					<input type="hidden" name="SKU_CODES" value="<?=$arResult['SKU_PROPERTIES_STRING']?>" />
					<label><?=GetMessage('CAPTION_SKU_SELECT')?></label>
					<select name="ELEMENT_ID"><?foreach($arResult['OFFERS'] as $id => $offer_data):?><option value="<?=$id?>"><?=$offer_data?></option><?endforeach;?></select>
				<?endif;?>
				<div class="but-r">
					<!--noindex-->
						<button class="button1" type="submit" id="one_click_buy_form_button" name="one_click_buy_form_button" value="<?=GetMessage('ORDER_BUTTON_CAPTION')?>"><span><?=GetMessage("ORDER_BUTTON_CAPTION")?></span></button>
					<!--/noindex-->
					<div class="prompt">
						&mdash;&nbsp; <?=GetMessage("IBLOCK_FORM_IMPORTANT")?>
					</div>
				</div>
				<? if ($arParams['USE_SKU']!="Y"):?><input type="hidden" name="ELEMENT_ID" value="<?=$arParams['ELEMENT_ID']?>" /><?endif;?>
				<? if ($arParams['BUY_ALL_BASKET']=="Y"):?><input type="hidden" name="BUY_TYPE" value="ALL" /><?endif;?>
				<? if (intVal($arParams['ELEMENT_QUANTITY'])):?><input type="hidden" name="ELEMENT_QUANTITY" value="<?=intVal($arParams['ELEMENT_QUANTITY']);?>" /><?endif;?>
				<input type="hidden" name="CURRENCY" value="<?=$arParams['DEFAULT_CURRENCY']?>" />
				<input type="hidden" name="PROPERTIES" value='<?=serialize($arParams['PROPERTIES'])?>' />
				<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arParams['DEFAULT_PAYMENT']?>" />
				<input type="hidden" name="DELIVERY_ID" value="<?=$arParams['DEFAULT_DELIVERY']?>" />
				<input type="hidden" name="PERSON_TYPE_ID" value="<?=$arParams['DEFAULT_PERSON_TYPE']?>" />
				<?if($_REQUEST['OFFER_PROPS']){
					$arSkuProps=json_decode($_REQUEST["OFFER_PROPS"]);
					// $arSkuProps=explode(";", $_REQUEST['OFFER_PROPS']);
					?>
					<input type="hidden" name="OFFER_PROPS" value='<?=serialize($arSkuProps);?>' />
				<?}?>
				<?=bitrix_sessid_post()?>
		</form>

		<div class="one_click_buy_result" id="one_click_buy_result">
			<div class="one_click_buy_result_success"><?=GetMessage('ORDER_SUCCESS')?></div>
			<div class="one_click_buy_result_fail"><?=GetMessage('ORDER_ERROR')?></div>
			<div class="one_click_buy_result_text"><?=GetMessage('ORDER_SUCCESS_TEXT')?></div>
		</div>

	</div>

<script>
	$('#one_click_buy_form').validate({onfocusout: false,  rules:
	{
		<?
			foreach ($arParams['REQUIRED'] as $key => $value)
			{
				echo '"ONE_CLICK_BUY['.$value.']": {required : true}';
				if ($arParams['REQUIRED'][$key+1]) echo ',';
			}
		?>
	},messages:{
      licenses_popup_OCB: {
        required : BX.message('JS_REQUIRED_LICENSES')
      }
	}
	});
	$('.popup').jqmAddClose('.jqmClose');
	$('#one_click_buy_id_PHONE').mask('<?=trim(COption::GetOptionString("aspro.tires", "PHONE_MASK", "+9 (999) 999-99-99", SITE_ID));?>');
</script>