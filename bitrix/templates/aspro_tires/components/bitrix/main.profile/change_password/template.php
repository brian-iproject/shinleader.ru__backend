<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="module-form-block-wr lk-page">
	<?ShowError($arResult["strProfileError"]);?>
	<?if ($arResult['DATA_SAVED'] == 'Y') ShowNote(GetMessage('PROFILE_DATA_SAVED'));?>
	<script>
		$(document).ready(function(){
			$(".form-block form").validate({
				rules:{NEW_PASSWORD_CONFIRM: {equalTo: '#pass'}},
				messages:{NEW_PASSWORD_CONFIRM: {equalTo: '<?=GetMessage("PASSWORDS_DOES_NOT_MATCH")?>'}}	
			});
		})
	</script>
	<div class="form-block-title"><?=GetMessage("CHANGE_PASSWORD")?></div>
	<div class="form-block">
		<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="LOGIN" maxlength="50" value="<?=$arResult["arUser"]["LOGIN"]?>" />
			<input type="hidden" name="EMAIL" maxlength="50" placeholder="name@company.ru" value="<?=$arResult["arUser"]["EMAIL"]?>" />
			
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			
			<div class="r">
				<label><?=GetMessage('NEW_PASSWORD_REQ')?><span class="star">*</span></label>
				<input required type="password" name="NEW_PASSWORD" maxlength="50" value="" id='pass' autocomplete="off" class="bx-auth-input" />
				<div class="pr"><?=GetMessage("PASSWORD_MIN_LENGTH")?></div>
			</div>	
			
			<div class="r">
				<label><?=GetMessage('NEW_PASSWORD_CONFIRM')?><span class="star">*</span></label>
				<input required type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
			</div>
			
			<div class="but-r">
				<div class="prompt">&mdash;&nbsp; <?=GetMessage("REQUIRED_FIELDS")?></div>
				<button class="button1" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>"><?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?></button>
				<?/*<a class="cancel"><?=GetMessage('MAIN_RESET');?></a>*/?>
			</div>

		</form>
		
	</div>
</div>