<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="module-form-block-wr lk-page">

<?ShowError($arResult["strProfileError"]);?>
<?if( $arResult['DATA_SAVED'] == 'Y' ) ShowNote(GetMessage('PROFILE_DATA_SAVED')); ?>
<script>
	$(document).ready(function()
	{
		$(".form-block form").validate({rules:{ EMAIL: { email: true }}	});
	})
</script>
<div class="form-block-title"><?=GetMessage("PERSONAL_DATA")?></div>
	<div class="form-block">
		<form method="post" name="form1" class="main" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_EMAIL")?>:<span class="star">*</span></label>
				<input required type="text" name="EMAIL" maxlength="50" placeholder="name@company.ru" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
				<div class="pr em"><?=GetMessage("PERSONAL_EMAIL_DESCRIPTION")?></div>
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_NAME")?>:<span class="star">*</span></label>
				<input required type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
			</div>
			<div class="r">
				<label><?=GetMessage("PERSONAL_LASTNAME")?>:</label>
				<input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
			</div>
			<div class="r">
				<label><?=GetMessage("PERSONAL_FATHERNAME")?>:</label>
				<input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_PHONE")?>:<span class="star">*</span></label>
				<input required type="text" name="PERSONAL_PHONE" class="phone-input" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_CITY")?>:</label>
				<?$GLOBALS["APPLICATION"]->IncludeComponent(
					"bitrix:sale.ajax.locations",
					".default",
					array(
						"AJAX_CALL" => "N",
						"COUNTRY_INPUT_NAME" => "COUNTRY_INPUT",
						"REGION_INPUT_NAME" => "REGION_INPUT",
						"CITY_INPUT_NAME" => "PERSONAL_CITY",
						"CITY_OUT_LOCATION" => "Y",
						"LOCATION_VALUE" => $arResult["arUser"]["PERSONAL_CITY"],
						"ORDER_PROPS_ID" => 1,
						"ONCITYCHANGE" => "",
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);?>
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_STREET")?>:</label>
				<input type="text" name="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" />
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_HOUSE")?>:</label>
				<input type="text" name="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" />
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_FLOOR")?>:</label>
				<input type="text" name="PERSONAL_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MAILBOX"]?>" />
			</div>
			
			<div class="r">
				<label><?=GetMessage("PERSONAL_APARTMENT")?>:</label>
				<input type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" />
			</div>
						
			<div class="but-r">
				<div class="clearboth"></div>
				<div class="prompt">
					&mdash;&nbsp; <?=GetMessage("REQUIRED_FIELDS")?>
				</div>
				<button class="button1" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>"><span><?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?></span></button>
				<?/*<a class="cancel"><?=GetMessage('MAIN_RESET');?></a>*/?>
			</div>
			
		</form>
		
	</div>
</div>