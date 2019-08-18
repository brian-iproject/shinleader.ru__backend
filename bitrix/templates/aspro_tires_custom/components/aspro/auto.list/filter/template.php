<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arParams["VYLET_DISKA_TYPE"] = ((isset($arParams["VYLET_DISKA_TYPE"]) && strlen($arParams["VYLET_DISKA_RANGE_MIN"])) ? $arParams["VYLET_DISKA_TYPE"] : "RANGE");
$arParams["DIAMETR_STUPITSY_TYPE"] = ((isset($arParams["DIAMETR_STUPITSY_TYPE"]) && strlen($arParams["VYLET_DISKA_RANGE_MIN"])) ? $arParams["DIAMETR_STUPITSY_TYPE"] : "RANGE");
if($arParams["VYLET_DISKA_TYPE"] == "RANGE"){
	$arParams["VYLET_DISKA_RANGE_MIN"] = ((isset($arParams["VYLET_DISKA_RANGE_MIN"]) && strlen($arParams["VYLET_DISKA_RANGE_MIN"])) ? abs($arParams["VYLET_DISKA_RANGE_MIN"]) : 3);
	$arParams["VYLET_DISKA_RANGE_MAX"] = ((isset($arParams["VYLET_DISKA_RANGE_MAX"]) && strlen($arParams["VYLET_DISKA_RANGE_MAX"])) ? abs($arParams["VYLET_DISKA_RANGE_MAX"]) : 3);
}
else{
	$arParams["VYLET_DISKA_RANGE_MIN"] = 0;
	$arParams["VYLET_DISKA_RANGE_MAX"] = 0;
}
if($arParams["DIAMETR_STUPITSY_TYPE"] == "RANGE"){
	$arParams["DIAMETR_STUPITSY_RANGE_MIN"] = ((isset($arParams["DIAMETR_STUPITSY_RANGE_MIN"]) && strlen($arParams["DIAMETR_STUPITSY_RANGE_MIN"])) ? abs($arParams["DIAMETR_STUPITSY_RANGE_MIN"]) : 0);
	$arParams["DIAMETR_STUPITSY_RANGE_MAX"] = ((isset($arParams["DIAMETR_STUPITSY_RANGE_MAX"]) && strlen($arParams["DIAMETR_STUPITSY_RANGE_MAX"])) ? abs($arParams["DIAMETR_STUPITSY_RANGE_MAX"]) : 1000);
}
else{
	$arParams["DIAMETR_STUPITSY_RANGE_MIN"] = 0;
	$arParams["DIAMETR_STUPITSY_RANGE_MAX"] = 0;
}
?>
<span class="filter_left">
	<div class="parameters-selects">
		<div class="row">
			<div class="label"><?=GetMessage("AUTO_LIST_MANUFACTURER")?></div>
			<select name="car" class="cars-list" id="CAR">
				<option value="" <?=!empty( $arParams["AUTO_MARK"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["CARS"] as $car ){?>
					<option value="<?=$car["NAME"]?>" <?=$arParams["AUTO_MARK"] == $car["NAME"] ? 'selected="selected"' : ''?>><?=$car["NAME"]?></option>
				<?}?>
			</select>
		</div>
		<div class="row">
			<div class="label"><?=GetMessage("AUTO_LIST_MODEL")?></div>
			<select name="model" class="cars-list" id="MODEL">
				<option value="" <?=!empty( $arParams["AUTO_MODEL"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["MODEL"] as $model ){?>
					<option value="<?=$model["NAME"]?>" <?=$arParams["AUTO_MODEL"] == $model["NAME"] ? 'selected="selected"' : ''?>><?=$model["NAME"]?></option>
				<?}?>
			</select>
		</div>
		<div class="row">
			<div class="label"><?=GetMessage("AUTO_LIST_YEAR")?></div>
			<select name="year" class="cars-list" id="YEAR">
				<option value="" <?=!empty( $arParams["AUTO_YEAR"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["YEAR"] as $year ){?>
					<option value="<?=$year["NAME"]?>" <?=$arParams["AUTO_YEAR"] == $year["NAME"] ? 'selected="selected"' : ''?>><?=$year["NAME"]?></option>
				<?}?>
			</select>
		</div>
		<div class="row">
			<div class="label"><?=GetMessage("AUTO_LIST_EQUIPMENT")?></div>
			<select name="modification" class="cars-list" id="MODIFICATION">
				<option value="" <?=!empty( $arParams["AUTO_COMPLECT"] ) ? '' : 'selected="selected"'?>>&mdash;</option>
				<?foreach( $arResult["MODIFICATION"] as $modification ){?>
					<option value="<?=$modification["NAME"]?>" <?=$arParams["AUTO_COMPLECT"] == $modification["NAME"] ? 'selected="selected"' : ''?>><?=$modification["NAME"]?></option>
				<?}?>
			</select>
		</div>
	</div>
</span>

<?if(empty( $arResult["TYPE"] )){?>
	<span class="filter_right">
		<div class="info-icon"><?=GetMessage("SELECT_MODEL")?></div>
	</span>
<?} elseif( !empty( $arResult["TYPE"] ) && $arResult["TYPE_T"] == 'tires' ){?>
	<span class="filter_right">
		<?foreach( $arResult["TYPE"] as $name => $arType ){
			if( !empty( $arType ) ){?>
				<div class="filter-b inb">
					<div class="label"><?if( $name == "DEFAULT" ){ echo GetMessage("AUTO_LIST_RECOMENDED_SIZES"); }elseif( $name == 'ALTERNATIVE' ){ echo GetMessage("AUTO_LIST_ALLOWABLE_SIZES"); }elseif( $name == 'TUNING' ){ echo GetMessage("AUTO_LIST_ALLOWABLE_SIZES"); }elseif( $name == 'TUNING' ){ echo GetMessage("AUTO_LIST_TUNING"); }?></div>
					<?if( !empty( $arType["FRONT"] ) && !empty( $arType["BACK"] ) ){?>
						<div class="label child"><?=GetMessage("AUTO_LIST_FRONT")?></div>
						<?foreach( $arType["FRONT"] as $arData ){?>
							<div class="ch">
								<input name="tyre_type" id="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-h="<?=$arData["HEIGHT"]?>" data-d="<?=$arData["DIAM"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" <?=isset( $_REQUEST["tyre_type"] ) && $arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name == $_REQUEST["tyre_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>"><?=$arData["WIDTH"]?>/<?=$arData["HEIGHT"]?> R<?=$arData["DIAM"]?></label>
							</div>
						<?}?>
						
						<div class="label child"><?=GetMessage("AUTO_LIST_REAR")?></div>
						<?foreach( $arType["BACK"] as $arData ){?>
							<div class="ch">
								<input name="tyre_type" id="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-h="<?=$arData["HEIGHT"]?>" data-d="<?=$arData["DIAM"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" <?=isset( $_REQUEST["tyre_type"] ) && $arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name == $_REQUEST["tyre_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>"><?=$arData["WIDTH"]?>/<?=$arData["HEIGHT"]?> R<?=$arData["DIAM"]?></label>
							</div>
						<?}?>
					<?}elseif( !empty( $arType["FRONT"] ) ){?>
						<?foreach( $arType["FRONT"] as $arData ){?>
							<div class="ch">
								<input name="tyre_type" id="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-h="<?=$arData["HEIGHT"]?>" data-d="<?=$arData["DIAM"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" <?=isset( $_REQUEST["tyre_type"] ) && $arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name == $_REQUEST["tyre_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>"><?=$arData["WIDTH"]?>/<?=$arData["HEIGHT"]?> R<?=$arData["DIAM"]?></label>
							</div>
						<?}?>
					<?}?>
				</div>
				<hr />
			<?}?>
		<?}?>
		<div id="car_select_season"></div>
	</span>
<?}elseif( !empty( $arResult["TYPE"] ) && $arResult["TYPE_T"] == 'wheels' ){?>
	<span class="filter_right">
		<?foreach( $arResult["TYPE"] as $name => $arType ){
			if( !empty( $arType ) ){?>
				<div class="filter-b inb">
					<div class="label"><?if( $name == "DEFAULT" ){ echo GetMessage("AUTO_LIST_RECOMENDED_SIZES"); }elseif( $name == 'ALTERNATIVE' ){ echo GetMessage("AUTO_LIST_ALLOWABLE_SIZES"); }elseif( $name == 'TUNING' ){ echo GetMessage("AUTO_LIST_TUNING"); }?></div>
					<?if( !empty( $arType["FRONT"] ) && !empty( $arType["BACK"] ) ){?>
						<div class="label child"><?=GetMessage("AUTO_LIST_FRONT")?></div>
						<?foreach( $arType["FRONT"] as $arData ){?>
							<div class="ch">
								<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" <?=($arData["ET"] ? "data-et='".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "")."'" : "")?> <?=($arData["DIA"] ? "data-dia='".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "")."'" : "")?> class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>&times;<?=$arData["DIAM"]?> <?=$arData["LZ"]?>&times;<?=$arData["PCD"]?> <?=($arData["ET"] ? "ET ".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "") : "")?> <?=($arData["DIA"] ? "DIA ".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "") : "")?></label>
							</div>
						<?}?>
						<div class="label child"><?=GetMessage("AUTO_LIST_REAR")?></div>
						<?foreach( $arType["BACK"] as $arData ){?>
							<div class="ch">
								<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" <?=($arData["ET"] ? "data-et='".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "")."'" : "")?> <?=($arData["DIA"] ? "data-dia='".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "")."'" : "")?> class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>&times;<?=$arData["DIAM"]?> <?=$arData["LZ"]?>&times;<?=$arData["PCD"]?> <?=($arData["ET"] ? "ET ".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "") : "")?> <?=($arData["DIA"] ? "DIA ".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "") : "")?></label>
							</div>
						<?}?>
					<?}elseif( !empty( $arType["FRONT"] ) ){?>
						<?foreach( $arType["FRONT"] as $arData ){?>
							<div class="ch">
								<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" <?=($arData["ET"] ? "data-et='".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "")."'" : "")?> <?=($arData["DIA"] ? "data-dia='".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "")."'" : "")?> class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
								<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>&times;<?=$arData["DIAM"]?> <?=$arData["LZ"]?>&times;<?=$arData["PCD"]?> <?=($arData["ET"] ? "ET ".number_format($arData["ET"], (strlen(intval($arData["ET"])) === strlen($arData["ET"]) ? 0 : 1), ".", "") : "")?> <?=($arData["DIA"] ? "DIA ".number_format($arData["DIA"], (strlen(intval($arData["DIA"])) === strlen($arData["DIA"]) ? 0 : 1), ".", "") : "")?></label>
							</div>
						<?}?>
					<?}?>
				</div>
				<hr />
			<?}?>
		<?}?>
		<div id="car_select_season"></div>
	</span>
<?}?>


<script>
	var checkSelects = function(){
		$('select.cars-list').each(function(){ 
			if ($(this).find("option").length == 1){
				$(this).attr("disabled", true);
			}
		});
	}

	$(document).ready(function(){
		checkSelects();
		$('select.cars-list').on('change', function(){
			var instant_reload = "<?=$arParams["INSTANT_RELOAD"]?>";
			var et_type = "<?=$arParams["VYLET_DISKA_TYPE"]?>";
			var et_range0 = <?=$arParams["VYLET_DISKA_RANGE_MIN"]?>;
			var et_range1 = <?=$arParams["VYLET_DISKA_RANGE_MAX"]?>;
			var dia_type = "<?=$arParams["DIAMETR_STUPITSY_TYPE"]?>";
			var dia_range0 = <?=$arParams["DIAMETR_STUPITSY_RANGE_MIN"]?>;
			var dia_range1 = <?=$arParams["DIAMETR_STUPITSY_RANGE_MAX"]?>;
			$.ajax({
				url: '/ajax/car_list.php',
				type: 'POST',
				data: {
					template: 'filter',
					type_filter: $('input[name="type_filter"]').val(),
					instant_reload: instant_reload,
					car: $('select#CAR').val(), 
					model: $('select#MODEL').val(),
					year: $('select#YEAR').val(),
					modification: $('select#MODIFICATION').val(),
					VYLET_DISKA_TYPE: et_type,
					VYLET_DISKA_RANGE_MIN: et_range0,
					VYLET_DISKA_RANGE_MAX: et_range1,
					DIAMETR_STUPITSY_TYPE: dia_type,
					DIAMETR_STUPITSY_RANGE_MIN: dia_range0,
					DIAMETR_STUPITSY_RANGE_MAX: dia_range1,
				}
			}).done(function(text) {
				$('#car_list_wrap').html(text);
				checkSelects();
			});
		})
		
		$('input[type="radio"].cars-list').on('change', function(){
			if($("input[name=type_filter]").val() == "tires"){
				var findTires = true;
				
				var auto_w0 = $(this).attr('data-w'); var auto_w1 = auto_w0 * 1;
				if($('select.tyre_width option:findContent("'+ auto_w0 +'")').length || $('select.tyre_width option:findContent("'+ auto_w1 +'")').length){
					$('select.tyre_width').attr('name', $('select.tyre_width option:findContent("'+ auto_w0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.tyre_width').attr('name', $('select.tyre_width option:findContent("'+ auto_w1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findTires = false; $('select.tyre_width').removeAttr("name");
					$('select.tyre_width option[data-value=default]').attr('selected', 'selected');
				}
				
				var auto_h0 = $(this).attr('data-h'); var auto_h1 = auto_h0 * 1;
				if($('select.tyre_height option:findContent("'+ auto_h0 +'")').length || $('select.tyre_height option:findContent("'+ auto_h1 +'")').length){
					$('select.tyre_height').attr('name', $('select.tyre_height option:findContent("'+ auto_h0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.tyre_height').attr('name', $('select.tyre_height option:findContent("'+ auto_h1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findTires = false; $('select.tyre_height').removeAttr("name");
					$('select.tyre_height option[data-value=default]').attr('selected', 'selected');
				}
				
				var auto_d0 = $(this).attr('data-d'); var auto_d1 = auto_d0 * 1;
				if($('select.tyre_diam option:findContent("'+ auto_d0 +'")').length || $('select.tyre_diam option:findContent("'+ auto_d1 +'")').length){
					$('select.tyre_diam').attr('name', $('select.tyre_diam option:findContent("'+ auto_d0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.tyre_diam').attr('name', $('select.tyre_diam option:findContent("'+ auto_d1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findTires = false; $('select.tyre_diam').removeAttr("name");
					$('select.tyre_diam option[data-value=default]').attr('selected', 'selected');
				}
			}
			
			
			if($("input[name=type_filter]").val() == "wheels"){
				var findWheels = true;

				var auto_d0 = $(this).attr('data-d'); var auto_d1 = auto_d0 * 1;
				if($('select.disk_diam option:findContent("'+ auto_d0+'")').length || $('select.disk_diam option:findContent("'+ auto_d1+'")').length){
					$('select.disk_diam').attr('name', $('select.disk_diam option:findContent("'+ auto_d0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.disk_diam').attr('name', $('select.disk_diam option:findContent("'+ auto_d1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findWheels = false; $('select.disk_diam').removeAttr("name");
					$('select.disk_diam option[data-value=default]').attr('selected', 'selected');
				}

				var auto_w0 = $(this).attr('data-w'); var auto_w1 = auto_w0 * 1;
				if($('select.disk_width option:findContent("'+ auto_w0 +'")').length || $('select.disk_width option:findContent("'+ auto_w1 +'")').length){
					$('select.disk_width').attr('name', $('select.disk_width option:findContent("'+ auto_w0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.disk_width').attr('name', $('select.disk_width option:findContent("'+ auto_w1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findWheels = false; $('select.disk_width').removeAttr("name");
					$('select.disk_width option[data-value=default]').attr('selected', 'selected');
				}

				var auto_lz0 = $(this).attr('data-lz'); var auto_lz1 = auto_lz0 * 1;
				if($('select.disk_lz option:findContent("'+ auto_lz0 +'")').length || $('select.disk_lz option:findContent("'+ auto_lz1 +'")').length){
					$('select.disk_lz').attr('name', $('select.disk_lz option:findContent("'+ auto_lz0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.disk_lz').attr('name', $('select.disk_lz option:findContent("'+ auto_lz1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findWheels = false; $('select.disk_lz').removeAttr("name");
					$('select.disk_lz option[data-value=default]').attr('selected', 'selected');
				}

				var auto_pcd0 = $(this).attr('data-pcd'); var auto_pcd1 = auto_pcd0 * 1;
				if($('select.disk_pcd option:findContent("'+ auto_pcd0 +'")').length || $('select.disk_pcd option:findContent("'+ auto_pcd1 +'")').length){
					$('select.disk_pcd').attr('name', $('select.disk_pcd option:findContent("'+ auto_pcd0 +'")').attr('selected', 'selected').attr('data-value'));
					$('select.disk_pcd').attr('name', $('select.disk_pcd option:findContent("'+ auto_pcd1 +'")').attr('selected', 'selected').attr('data-value'));
				}
				else{
					findWheels = false; $('select.disk_pcd').removeAttr("name");
					$('select.disk_pcd option[data-value=default]').attr('selected', 'selected');
				}
				
				var auto_et = $(this).attr('data-et') * 1;
				var et_range0 = <?=$arParams["VYLET_DISKA_RANGE_MIN"]?>;
				var et_range1 = <?=$arParams["VYLET_DISKA_RANGE_MAX"]?>;
				var et_min = $('.VYLET_DISKA_abs_min').html() * 1;
				var et_max = $('.VYLET_DISKA_abs_max').html() * 1;
				var et_min_val = (auto_et - et_range0 >= et_min ? auto_et - et_range0 : '');
				var et_max_val = (auto_et + et_range1 <= et_max ? auto_et + et_range1 : '');
				$('input.disk_et_min').val((et_min_val.toString().length ? parseFloat(et_min_val.toFixed(1)) : ''));
				$('input.disk_et_max').val((et_max_val.toString().length ? parseFloat(et_max_val.toFixed(1)) : ''));
				
				var auto_dia = $(this).attr('data-dia') * 1;
				var dia_range0 = <?=$arParams["DIAMETR_STUPITSY_RANGE_MIN"]?>;
				var dia_range1 = <?=$arParams["DIAMETR_STUPITSY_RANGE_MAX"]?>;
				var dia_min = $('.DIAMETR_STUPITSY_abs_min').html() * 1;
				var dia_max = $('.DIAMETR_STUPITSY_abs_max').html() * 1;
				var dia_min_val = (auto_dia - dia_range0 >= dia_min ? auto_dia - dia_range0 : '');
				var dia_max_val = (auto_dia + dia_range1 <= dia_max ? auto_dia + dia_range1 : '');
				$('input.disk_dia_min').val((dia_min_val.toString().length ? parseFloat(dia_min_val.toFixed(1)) : ''));
				$('input.disk_dia_max').val((dia_max_val.toString().length ? parseFloat(dia_max_val.toFixed(1)) : ''));
			}
			
			<?if($arParams["INSTANT_RELOAD"]):?>
				var showEmptyResult = function(){
					$(".catalog_display").hide();
					$(".result-block").hide();
					$(".module-products-list").hide();
					$("#no_products").show();
					jsAjaxUtil.CloseLocalWaitWindow( 'id', 'content', true );
				}
				if(findTires || findWheels){
					sendQuery();
				}
				else{
					jsAjaxUtil.ShowLocalWaitWindow('id', 'content', true);
					setTimeout(showEmptyResult, 200);
				}
			<?endif;?>
		})
	})
	
</script>