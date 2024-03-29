<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?>
<?=GetMessage("LOGIN_AS")?>:
<div class="row">
	<?foreach($arParams["~AUTH_SERVICES"] as $service):?>
		<?
		if(($arParams["~FOR_SPLIT"] == 'Y') && (is_array($service["FORM_HTML"])))
			$onClickEvent = $service["FORM_HTML"]["ON_CLICK"];
		else
			$onClickEvent = "onclick=\"BxShowAuthService('".$service['ID']."', '".$arParams['SUFFIX']."')\"";
		?>
		<a title="<?=htmlspecialcharsbx($service["NAME"])?>" href="javascript:void(0)"  <?=$onClickEvent?> class="s <?=$service["ICON"];?>" id="bx_auth_href_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>">
			<i class="soc-icon <?=htmlspecialcharsbx($service["ICON"])?>"></i>
			<span class="name"><?=$service["NAME"]?></span>
		</a>
	<?endforeach?>
</div>

<script>
	function BxShowAuthService(id, suffix)
	{
		var bxCurrentAuthId = ''; 
		if(window['bxCurrentAuthId'+suffix])
			bxCurrentAuthId = window['bxCurrentAuthId'+suffix];

		BX('bx_auth_serv'+suffix).style.display = '';
		if(bxCurrentAuthId != '' && bxCurrentAuthId != id)
		{
			BX('bx_auth_href_'+suffix+bxCurrentAuthId).className = '';
			BX('bx_auth_serv_'+suffix+bxCurrentAuthId).style.display = 'none';
		}
		BX('bx_auth_href_'+suffix+id).className = 'bx-ss-selected';
		BX('bx_auth_href_'+suffix+id).blur();
		BX('bx_auth_serv_'+suffix+id).style.display = '';
		var el = BX.findChild(BX('bx_auth_serv_'+suffix+id), {'tag':'input', 'attribute':{'type':'text'}}, true);
		if(el)
			try{el.focus();}catch(e){}
		window['bxCurrentAuthId'+suffix] = id;
		if(document.forms['bx_auth_services'+suffix])
			document.forms['bx_auth_services'+suffix].auth_service_id.value = id;
		else if(document.forms['bx_user_profile_form'+suffix])
			document.forms['bx_user_profile_form'+suffix].auth_service_id.value = id;
	}

	var bxAuthWnd = false;
	function BxShowAuthFloat(id, suffix)
	{
		var bCreated = false;
		if(!bxAuthWnd)
		{
			bxAuthWnd = new BX.CDialog({
				'content':'<div id="bx_auth_float_container"></div>', 
				'width': 640,
				'height': 400,
				'resizable': false
			});
			bCreated = true;
		}
		bxAuthWnd.Show();

		if(bCreated)
			BX('bx_auth_float_container').appendChild(BX('bx_auth_float'));
				
		BxShowAuthService(id, suffix);
	}
</script>