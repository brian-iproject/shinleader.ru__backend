<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(strlen($arResult["ERROR_MESSAGE"]) > 0):?>
	<?ShowError($arResult["ERROR_MESSAGE"]);?>
<?endif;?>
<?if($arResult["STORES"]):?>
	<?$sMeasure = GetMessage("MEASURE_DEFAULT");?>
	<div class="stores_block_wrap">
		<?foreach($arResult["STORES"] as $pid => $arProperty):?>
			<div class="stores_block">
				<span class="stores_text_wrapp">
					<a href="<?=$arProperty["URL"]?>"><?=$arProperty["TITLE"]?></a>
					<?if(isset($arProperty["PHONE"])):?>
						<span class="store_phone">,&nbsp;<?=GetMessage('S_PHONE')?> <?=$arProperty["PHONE"]?></span>
					<?endif;?>
					<?if(isset($arProperty["SCHEDULE"])):?>
						<span>,&nbsp;<?=GetMessage('S_SCHEDULE')?>&nbsp;<?=$arProperty["SCHEDULE"]?></span>
					<?endif;?>
				</span>
				<?if($amount = $arProperty["NUM_AMOUNT"]):?>
					<?
					if(($arParams["USE_MIN_AMOUNT"] == 'Y') && ($arParams["USE_ONLY_MAX_AMOUNT"] == "Y")){
						if(intval($amount) > $arParams["MAX_AMOUNT"]){
							$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
							$indicators = 3;
						}
						elseif(intval($amount) >= $arParams["MIN_AMOUNT"]){
							$amount = '<span class="sufficient">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 2;
						}
						elseif(intval($amount) == 0){
							$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
							$indicators = 0;
						}
						elseif(intval($amount) < $arParams["MIN_AMOUNT"]){
							$amount = '<span class="few">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 1;
						}
					}
					elseif($arParams["USE_MIN_AMOUNT"] == 'Y'){	
						if(intval($amount) > $arParams["MAX_AMOUNT"]){
							$amount = '<span class="many">'.GetMessage("MANY_GOODS").'</span>';
							$indicators = 3;
						}
						elseif(intval($amount) >= $arParams["MIN_AMOUNT"]){
							$amount = '<span class="sufficient">'.GetMessage("SUFFICIENT_GOODS").'</span>';
							$indicators = 2;
						}
						elseif(intval($amount) == 0){
							$amount = '<span class="under_order">'.GetMessage("NO_GOODS").'</span>';
							$indicators = 0;
						}
						elseif(intval($amount) < $arParams["MIN_AMOUNT"]){
							$amount = '<span class="few">'.GetMessage("FEW_GOODS").'</span>';
							$indicators = 1;
						}
					}
					else{
						if(!$arParams["MAX_AMOUNT"] && !$arParams["MIN_AMOUNT"]){
							$amount = '<span class="few">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 1;
						}
						elseif(intval($amount) > $arParams["MAX_AMOUNT"]){
							$amount = '<span class="many">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 3;
						}
						elseif(intval($amount) >= $arParams["MIN_AMOUNT"]){
							$amount = '<span class="sufficient">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 2;
						}
						elseif(intval($amount) == 0){
							$amount = '<span class="under_order">'.$arProperty["NUM_AMOUNT"].'</span>';
							$indicators = 0;
						}
						elseif(intval($amount) < $arParams["MIN_AMOUNT"]){
							$amount = '<span class="few">'.$arProperty["NUM_AMOUNT"].'&nbsp;'.$sMeasure.'</span>';
							$indicators = 1;
						}
					}
					?>
					<span class="quantity-wrapp">
						<span class="quantity-indicators">
							<?for($i =1 ; $i <= 3; ++$i):?>
								<span class="<?=(($indicators) >= $i) ? 'r' : ''?><?=($i == 1) ? ' first' : ''?>"></span>
							<?endfor;?>
						</span>
						<span class="value"><?=$amount?></span>
					</span>
				<?else:?>
					<span class="quantity-wrapp">
						<span class="value"><?=GetMessage("BY_ORDER");?></span>
					</span>
				<?endif;?>
			</div>
		<?endforeach;?>
	</div>
<?else:?>
	<?=GetMessage("S_NO_STORES");?>
<?endif;?>