<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="r selects-row">
	<label><?=GetMessage("AUTO_LIST_AUTO");?>:</label>
	<div class="sel-row">
		<div class="left-label">
			<?=GetMessage("AUTO_LIST_MAKE");?>
		</div>
		<div class="right-side">
			<select name="UF_AUTO_MARK" class="cars-list" id="CAR">
				<option value="" <?=!empty( $arParams["AUTO_MARK"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["CARS"] as $car ){?>
					<option value="<?=$car["NAME"]?>" <?=$arParams["AUTO_MARK"] == $car["NAME"] ? 'selected="selected"' : ''?>><?=$car["NAME"]?></option>
				<?}?>
			</select>
		</div>
	</div>
	<div class="sel-row">
		<div class="left-label">
			<?=GetMessage("AUTO_LIST_MODEL");?>
		</div>
		<div class="right-side">
			<select name="UF_AUTO_MODEL" class="cars-list" id="MODEL">
				<option value="" <?=!empty( $arParams["AUTO_MODEL"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["MODEL"] as $model ){?>
					<option value="<?=$model["NAME"]?>" <?=$arParams["AUTO_MODEL"] == $model["NAME"] ? 'selected="selected"' : ''?>><?=$model["NAME"]?></option>
				<?}?>
			</select>
		</div>
	</div>	
	<div class="sel-row">
		<div class="left-label">
			<?=GetMessage("AUTO_LIST_YEAR");?>
		</div>
		<div class="right-side">
			<select name="UF_AUTO_YEAR" class="cars-list" id="YEAR">
				<option value="" <?=!empty( $arParams["AUTO_YEAR"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["YEAR"] as $year ){?>
					<option value="<?=$year["NAME"]?>" <?=$arParams["AUTO_YEAR"] == $year["NAME"] ? 'selected="selected"' : ''?>><?=$year["NAME"]?></option>
				<?}?>
			</select>
		</div>
	</div>
	<div class="sel-row">
		<div class="left-label">
			<?=GetMessage("AUTO_LIST_COMPLECTATION");?>
		</div>
		<div class="right-side">
			<select name="UF_AUTO_COMPLECT" class="cars-list" id="MODIFICATION">
				<option value="" <?=!empty( $arParams["AUTO_COMPLECT"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["MODIFICATION"] as $modification ){?>
					<option value="<?=$modification["NAME"]?>" <?=$arParams["AUTO_COMPLECT"] == $modification["NAME"] ? 'selected="selected"' : ''?>><?=$modification["NAME"]?></option>
				<?}?>
			</select>
		</div>
	</div>
</div>

<script>
	var checkSelects = function()
	{
		$('select.cars-list').each(function() 
		{ 
			if ($(this).find("option").length==1) { $(this).attr("disabled", true);  } 
		});
	}
	$(document).ready(function(){
		checkSelects();
		$('select.cars-list').on('change', function(){
			$.ajax(
			{
				url: '/ajax/car_list.php?template=personal&car='+$('select#CAR').val()+'&model='+$('select#MODEL').val()+'&year='+$('select#YEAR').val()+'&modification='+$('select#MODIFICATION').val()
			})
			.done(function( text ) 
			{
				$('#car_list_wrap').html(text);
				checkSelects();
			});
		})
	})
</script>