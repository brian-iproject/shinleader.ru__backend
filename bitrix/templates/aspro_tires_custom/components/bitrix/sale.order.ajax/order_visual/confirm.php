<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult["ORDER"])){?>

	<div class="cart_confirmation">
		<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr><td>
			<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/images/cart_confirmation.png"></div>
		</td><td>
			<div class="text">
				<h2><?=GetMessage("ORDER_ISSUED")?></h2>
				<?=GetMessage("ORDER_ISSUED_DESCRIPTION")?>
				<p><?$APPLICATION->IncludeFile(SITE_DIR."include/order_success.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("ORDER_SUCCESS_INLUDE")));?></p>
				<table class="order-confirmation">
					<tr>
						<td>
							<span class="title"><?=GetMessage("SALE_ORDER_NUMBER");?>:</span><br />
							<span class="value"><?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?></span>
						</td>
						<td>
							<span class="title"><?=GetMessage("SALE_ORDER_DATE");?>:</span><br />
							<span class="value"><?=$arResult["ORDER"]["DATE_INSERT"]?></span>
						</td>
						<?if($arParams["AJAX_CALL"]!="Y"):?>
							<td>
								<span class="description"><?=GetMessage("SALE_ORDER_DESCRIPTION", array("#CLIENT_EMAIL#" => $arResult["ORDER"]["USER_EMAIL"]));?></span>
							</td>
						<?endif;?>
					</tr>
				</table>
				<?if($arParams["AJAX_CALL"]!="Y"):?><?=GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"]))?><?endif;?>
				<?if (!empty($arResult["PAY_SYSTEM"])){?>
					<br /><br /><p><?=GetMessage("SOA_TEMPL_PAY")?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?></p>
					<? if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0) {?>
						<? if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y") { ?>
							<script language="JavaScript"> window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?= $arResult["ORDER_ID"] ?>'); </script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"])) ?>
						<?} else { if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0) { include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]); } }?>
					<?}?>
				<?}?>
			</div>
		</td></tr></table>
		<div class="clearboth"></div>
	</div>
	
<?}else{?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />
	<table class="sale_order_full_table"><tr><td>
		<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
		<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
	</td></tr></table>
<?}?>
