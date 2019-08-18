<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( strlen($arResult["ERROR_MESSAGE"]) <= 0 ){?>
	<span class="form-block-title"><?=GetMessage("ORDER_CANCEL_TITLE")?></span>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form-block" style="padding: 19px 14px;">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
		<?=GetMessage("SALE_CANCEL_ORDER1") ?>
		<?=GetMessage("SALE_CANCEL_ORDER2")?> #<?=$arResult["ACCOUNT_NUMBER"]?>?
		<b><?= GetMessage("SALE_CANCEL_ORDER3") ?></b><br /><br />
		<?= GetMessage("SALE_CANCEL_ORDER4") ?>:<br />
		<textarea name="REASON_CANCELED" cols="60" rows="3"></textarea><br /><br />
		<input type="hidden" name="CANCEL" value="Y">
		<!--noindex-->
			<button class="button1" type="submit" name="action" value="<?=GetMessage("SALE_CANCEL_ORDER_BTN") ?>"><span><?= GetMessage("SALE_CANCEL_ORDER_BTN") ?></span></button>
		<!--/noindex-->
	</form>
<?}else{
	echo ShowError($arResult["ERROR_MESSAGE"]);
}?>