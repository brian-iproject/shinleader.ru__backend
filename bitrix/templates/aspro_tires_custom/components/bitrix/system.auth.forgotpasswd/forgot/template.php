<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="module-form-block-wr lk-page">

	<?if( !empty($_POST["send_account_info"]) && !empty($_POST["USER_EMAIL"]) ){?>
		<p><font style="color:green;"><?=GetMessage("DATA_SENDED")?></font></p>
	<?}else{?>
	
<script>
	$(document).ready(function(){ $(".form-block form").validate({ rules:{ USER_EMAIL: { email: true } } }); });
</script>

		<div class="form-block">
			<form name="bform" method="post" target="_top" class="bf" action="<?=SITE_DIR?>auth/forgot-password/">
				<?if (strlen($arResult["BACKURL"]) > 0){?><input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" /><?}?>
				<input type="hidden" name="AUTH_FORM" value="Y">
				<input type="hidden" name="TYPE" value="SEND_PWD">
				<p class="forgot-pass-description"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>

				<div class="r">
					<label><?=GetMessage("AUTH_EMAIL")?></label>
					<input type="email" name="USER_EMAIL" required maxlength="255" <?=($_POST["USER_EMAIL"]=='' && isset($_POST["USER_EMAIL"]))? 'class="error"': ''?> />           
				</div>	

				<div class="but-r">
					<div class="clearboth"></div>
					<div class="prompt">&mdash;&nbsp; <?=GetMessage("REQUIRED_FIELDS")?></div>
					<button class="button1" type="submit" name="send_account_info" value="Восстановить"><span><?=GetMessage("RETRIEVE")?></span></button>		
				</div>
			</form>	
			
			
		</div>

		<script type="text/javascript">document.bform.USER_EMAIL.focus();</script>

	<?}?>
</div>