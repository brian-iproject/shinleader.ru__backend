<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<form id="auth_params" action="<?=SITE_DIR?>ajax/show_personal_block.php">
		<input type="hidden" id="dfgdfg" name="REGISTER_URL" value="<?=$arParams["REGISTER_URL"]?>" />
		<input type="hidden" id="dfgfgddfg" name="FORGOT_PASSWORD_URL" value="<?=$arParams["FORGOT_PASSWORD_URL"]?>" />
		<input type="hidden" id="dfgdfgdfg" name="PROFILE_URL" value="<?=$arParams["PROFILE_URL"]?>" />
		<input type="hidden" id="dfgfgdddfg" name="SHOW_ERRORS" value="<?=$arParams["SHOW_ERRORS"]?>" />
	</form>

<?if(!$USER->IsAuthorized()):?>
	<div class="module-enter no-have-user">
		<!--noindex--><a class="reg" rel="nofollow" href="<?=SITE_DIR?>auth/registration/"><span><?=GetMessage("AUTH_REGISTER");?></span></a><!--/noindex-->	
		<!--noindex--><a class="avtorization-call enter"  rel="nofollow"><span><?=GetMessage("AUTH_LOGIN_BUTTON");?></span></a><!--/noindex-->
	</div>
<?else:?>
	<div class="module-enter have-user">
		<?$name = explode(' ', $arResult["USER_NAME"]);?>
		<?$name = $name[0];?>
		<!--noindex--><a href="<?=$arResult["PROFILE_URL"]?>" class="reg" rel="nofollow"><span><?=$arResult["USER_NAME"]?></span></a><!--/noindex-->
		<!--noindex--><a href="<?=SITE_DIR?>?logout=yes" class="exit" rel="nofollow"><span><?=GetMessage("AUTH_LOGOUT_BUTTON");?></span></a><!--/noindex-->
	</div>	
<?endif;?>
