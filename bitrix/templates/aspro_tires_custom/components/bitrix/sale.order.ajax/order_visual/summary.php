<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section">
<div class="title summary"><?=GetMessage("SOA_TEMPL_SUM_TITLE")?></div>

<table class="sale_data-table summary">
<thead>
	<tr class="colored">
		<th class="item-name-th"><?=GetMessage("SOA_TEMPL_SUM_NAME")?></th>
		<th class="th-props"><?=GetMessage("SOA_TEMPL_SUM_PROPS")?></th>
		<th class="th-discount"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?></th>
		<th class="th-weight"><?=GetMessage("SOA_TEMPL_SUM_WEIGHT")?></th>
		<th class="th-count"><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></th>
		<th class="th-price"><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></th>
	</tr>
</thead>
<tbody>
	<?
		foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
		{
			?>
			<tr>
				<td class="name-cell"><?=$arBasketItems["NAME"]?></td>
				<td class="props-cell">
					<? foreach($arBasketItems["PROPS"] as $val) { echo $val["NAME"].": ".$val["VALUE"]."<br />"; } ?>
				</td>
				<td class="discount-cell"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
				<td class="weight-cell"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
				<td class="count-cell"><?=$arBasketItems["QUANTITY"]?></td>
				<td class="price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			</tr>
			<?
		}
	?>
	</tbody>
</table>	
	
<div class="result">
	<div>
		<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></span>
		<span class="price"><?=$arResult["ORDER_WEIGHT_FORMATED"]?></span>
	</div>
	<div>
		<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></span>
		<span class="price"><?=$arResult["ORDER_PRICE_FORMATED"]?></span>
	</div>
	<?
	if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
	{
		?>
		<div>
			<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</td>
			<span class="price"><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?></span>
		</div>
		<?
	}
	if(!empty($arResult["arTaxList"]))
	{
		foreach($arResult["arTaxList"] as $val)
		{
			?>
			<div>
				<span class="itog"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</span>
				<span class="price"><?=$val["VALUE_MONEY_FORMATED"]?></span>
			</div>
			<?
		}
	}
	if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
	{
		?>
		<div>
			<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></span>
			<span class="price"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></span>
		</div>
		<?
	}
	if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
	{
		?>
		<div>
			<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></span>
			<span class="price"><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></span>
		</div>
		<?
	}
	?>
	<div class="last">
		<span class="itog"><?=GetMessage("SOA_TEMPL_SUM_IT")?></span>
		<span class="price"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></span>
	</div>
</div>



<div class="title"><?=GetMessage("SOA_TEMPL_SUM_ADIT_INFO")?></div>

<table class="sale_order_table">
	<tr>
		<td class="order_comment">
			<div><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></div>
			<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
		</td>
	</tr>
</table>
</div>