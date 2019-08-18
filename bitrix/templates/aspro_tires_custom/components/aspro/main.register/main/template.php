<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?><? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<div class="module-form-block-wr registraion-page">
<?/*if( !empty($arResult["ERRORS"]) ){
	$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
	ShowError(implode("<br />", $arResult["ERRORS"]));
}*/
if (count($arResult["ERRORS"][0]) > 0){
	//print_r($arResult["ERRORS"][0]);
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));}
?>

<?if( empty($arResult["ERRORS"]) && !empty($_POST["register_submit_button"])){
	LocalRedirect('/personal/');
}else{?>
	<div class="form-block-title">Персональные данные</div>
    
    <div class="form-block">
	<form id="registraion-page-form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">					
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif;?>
			<? // Переопределяем вывод стандартных полей
				/*$tmp = array( "LOGIN", "EMAIL", "PASSWORD", "CONFIRM_PASSWORD" );
				for( $i = 4; $i < count($arResult["SHOW_FIELDS"]); $i++ )
					$tmp[] = $arResult["SHOW_FIELDS"][$i];                    
				$arResult["SHOW_FIELDS"] = $tmp;*/
                $arResult['SHOW_FIELDS'] = array(
                                           'NAME',
                                           'PERSONAL_PHONE',
                                           'EMAIL',                                           
                                           'PASSWORD',
                                           'CONFIRM_PASSWORD',
                                           'PERSONAL_STREET'
                                        );
			?>
			<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>

<div class="r">	
<?if( $FIELD != "LOGIN" ):?>				
<label ><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="star">*</span><?endif;?></label>
<?endif;?>			
            
            <?switch ($FIELD){
					case "PASSWORD":?>
						<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
						
<?break;
					case "CONFIRM_PASSWORD":?>
						<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
					
<?break;
					case "PERSONAL_GENDER":?>
						<select name="REGISTER[<?=$FIELD?>]">
							<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
							<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
							<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
						</select>
						<?break;
					case "PERSONAL_COUNTRY":
					case "WORK_COUNTRY":?>
						<select name="REGISTER[<?=$FIELD?>]">
							<?foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value){?>
								<option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
							<?}?>
						</select>
						<?break;
					case "PERSONAL_PHOTO":
					case "WORK_LOGO":?>
						<input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" />
						<?break;
					case "PERSONAL_NOTES":
					case "WORK_NOTES":?>
						<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea>
						
<?case "PERSONAL_STREET":?>
						<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea>
						<?break;?>
<?case "EMAIL":?>
						<input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" placeholder="example@mail.ru" /> 
                        <div class="pr em">Если Вы укажете свой e-mail - это существенно ускорит обработку заказа. <br>Пожалуйста проверяйте свою почту чаще!</div>      
					<?break;?>
<?case "PERSONAL_PHONE":?>
						<input size="30" type="text" name="REGISTER[<?=$FIELD?>]" class="phone-input" value="<?=$arResult["VALUES"][$FIELD]?>"  /> 
                        <div class="pr">Телефон необходим для подтверждения заказа</div>      
					<?break;?>	
<?break;
					default:?>
						<?// Скрываем логин?>
						<input size="30" <?=$FIELD == "LOGIN" ? 'type="hidden"' : 'type="text"'?> name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" />
						<?break;?>
			
                <?}?>
	
				<?if( $FIELD != "LOGIN" && array_key_exists( $FIELD, $arResult["ERRORS"] ) ):?>
					<label class="error">Поле обязательно для заполнения.</label>
			
<?endif;?>
            
    </div>
	<?//endif?>
<?endforeach?>
			<div class="but-r">
				<button class="button-30" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>">
					<span>Зарегистрироваться</span>
				</button>
				
			</div>
		</form>	
        <div class="prompt">
					  —&nbsp; Обязательные поля
				</div>	
	</div>
<?//}?>
</div><?}?>