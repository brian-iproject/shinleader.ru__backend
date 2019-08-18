<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="filter-b selects">
	<div class="row">
		<label>Марка</label>
		<select name="car" class="cars-list" id="CAR">
			<option value="" <?=!empty( $arParams["AUTO_MARK"] ) ? '' : 'selected="selected"'?>>-</option>
			<?foreach( $arResult["CARS"] as $car ){?>
				<option value="<?=$car["NAME"]?>" <?=$arParams["AUTO_MARK"] == $car["NAME"] ? 'selected="selected"' : ''?>><?=$car["NAME"]?></option>
			<?}?>
		</select>
	</div>
	<div class="row">
		<label>Модель</label>
		<select name="model" class="cars-list" id="MODEL">
			<option value="" <?=!empty( $arParams["AUTO_MODEL"] ) ? '' : 'selected="selected"'?>>-</option>
			<?foreach( $arResult["MODEL"] as $model ){?>
				<option value="<?=$model["NAME"]?>" <?=$arParams["AUTO_MODEL"] == $model["NAME"] ? 'selected="selected"' : ''?>><?=$model["NAME"]?></option>
			<?}?>
		</select>
	</div>
	<div class="row">
		<label>Год выпуска</label>
		<select name="year" class="cars-list" id="YEAR">
			<option value="" <?=!empty( $arParams["AUTO_YEAR"] ) ? '' : 'selected="selected"'?>>-</option>
			<?foreach( $arResult["YEAR"] as $year ){?>
				<option value="<?=$year["NAME"]?>" <?=$arParams["AUTO_YEAR"] == $year["NAME"] ? 'selected="selected"' : ''?>><?=$year["NAME"]?></option>
			<?}?>
		</select>
	</div>
	<div class="row">
		<label>Комлектация</label>
		<select name="modification" class="cars-list" id="MODIFICATION">
			<option value="" <?=!empty( $arParams["AUTO_COMPLECT"] ) ? '' : 'selected="selected"'?>>-</option>
			<?foreach( $arResult["MODIFICATION"] as $modification ){?>
				<option value="<?=$modification["NAME"]?>" <?=$arParams["AUTO_COMPLECT"] == $modification["NAME"] ? 'selected="selected"' : ''?>><?=$modification["NAME"]?></option>
			<?}?>
		</select>
	</div>
</div>

<?if( !empty( $arResult["TYPE"] ) && $arResult["TYPE_T"] == 'tires' ){?>
	<?foreach( $arResult["TYPE"] as $name => $arType ){
		if( !empty( $arType ) ){?>
			<div class="filter-b inb">
				<div class="block-title"><?if( $name == "DEFAULT" ){ echo 'Рекомендуемые размеры'; }elseif( $name == 'ALTERNATIVE' ){ echo 'Допустимые размеры'; }elseif( $name == 'TUNING' ){ echo 'Тюнинг'; }?></div>
				
				<?if( !empty( $arType["FRONT"] ) && !empty( $arType["BACK"] ) ){?>
					<div class="block-title">Передние</div>
					<?foreach( $arType["FRONT"] as $arData ){?>
						<div class="ch">
							<input name="tyre_type" id="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-h="<?=$arData["HEIGHT"]?>" data-d="<?=$arData["DIAM"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>" <?=isset( $_REQUEST["tyre_type"] ) && $arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name == $_REQUEST["tyre_type"] ? 'checked="checked"' : ''?> />
							<label for="TYPE_<?=$arData["WIDTH"].$arData["HEIGHT"].$arData["DIAM"].$name?>"><?=$arData["WIDTH"]?>/<?=$arData["HEIGHT"]?> R<?=$arData["DIAM"]?></label>
						</div>
					<?}?>
					
					<div class="block-title">Задние</div>
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
		<?}?>
	<?}?>
<?}?>

<?if( !empty( $arResult["TYPE"] ) && $arResult["TYPE_T"] == 'wheels' ){?>
	<?foreach( $arResult["TYPE"] as $name => $arType ){?>
		<div class="filter-b inb">
			<div class="block-title"><?if( $name == "DEFAULT" ){ echo 'Рекомендуемые размеры'; }elseif( $name == 'ALTERNATIVE' ){ echo 'Допустимые размеры'; }elseif( $name == 'TUNING' ){ echo 'Тюнинг'; }?></div>
			
			<?if( !empty( $arType["FRONT"] ) && !empty( $arType["BACK"] ) ){?>
				<div class="block-title">Передние</div>
				<?foreach( $arType["FRONT"] as $arData ){?>
					<div class="ch">
						<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
						<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>x<?=$arData["DIAM"]?> <?=$arData["LZ"]?>x<?=$arData["PCD"]?></label>
					</div>
				<?}?>
				
				<div class="block-title">Задние</div>
				<?foreach( $arType["BACK"] as $arData ){?>
					<div class="ch">
						<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
						<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>x<?=$arData["DIAM"]?> <?=$arData["LZ"]?>x<?=$arData["PCD"]?></label>
					</div>
				<?}?>
			<?}elseif( !empty( $arType["FRONT"] ) ){?>
				<?foreach( $arType["FRONT"] as $arData ){?>
					<div class="ch">
						<input name="disk_type" id="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" data-w="<?=$arData["WIDTH"]?>" data-d="<?=$arData["DIAM"]?>" data-lz="<?=$arData["LZ"]?>" data-pcd="<?=$arData["PCD"]?>" class="cars-list" type="radio" value="<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>" <?=isset( $_REQUEST["disk_type"] ) && $arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name == $_REQUEST["disk_type"] ? 'checked="checked"' : ''?> />
						<label for="TYPE_<?=$arData["WIDTH"].$arData["DIAM"].$arData["LZ"].$arData["PCD"].$name?>"><?=$arData["WIDTH"]?>x<?=$arData["DIAM"]?> <?=$arData["LZ"]?>x<?=$arData["PCD"]?></label>
					</div>
				<?}?>
			<?}?>
		</div>
	<?}?>
<?}?>

<script>
	$(document).ready(function(){
		$('select.cars-list').on('change', function(){
			$.ajax({
				url: '/ajax/car_list.php?template=.default&car='+$('select#CAR').val()+'&model='+$('select#MODEL').val()+'&year='+$('select#YEAR').val()+'&modification='+$('select#MODIFICATION').val()+'&type_filter='+$('input[name="type_filter"]').val()
			}).done(function( text ) {
				$('#car_list_wrap').html(text);
			});
		})
		
		$('input[type="radio"].cars-list').on('change', function(){
			$('select.tyre_width').attr('name', $('select.tyre_width option:findContent("'+$(this).attr('data-w')+'")').attr('selected', 'selected').attr('data-value'));
			$('select.tyre_height').attr('name', $('select.tyre_height option:findContent("'+$(this).attr('data-h')+'")').attr('selected', 'selected').attr('data-value'));
			$('select.tyre_diam').attr('name', $('select.tyre_diam option:findContent("'+$(this).attr('data-d')+'")').attr('selected', 'selected').attr('data-value'));
			
			$('select.disk_diam').attr('name', $('select.disk_diam option:findContent("'+$(this).attr('data-d')+'")').attr('selected', 'selected').attr('data-value'));
			$('select.disk_width').attr('name', $('select.disk_width option:findContent("'+$(this).attr('data-w')+'")').attr('selected', 'selected').attr('data-value'));
			$('select.disk_lz').attr('name', $('select.disk_lz option:findContent("'+$(this).attr('data-lz')+'")').attr('selected', 'selected').attr('data-value'));
			$('select.disk_pcd').attr('name', $('select.disk_pcd option:findContent("'+$(this).attr('data-pcd')+'")').attr('selected', 'selected').attr('data-value'));
			sendQuery();
		})
		
		var checked = false;
		
		$('#car_list_wrap input[type="radio"]').each( function(){
			var disable = false;
			if( $('input[name="type_filter"]').val() == 'tyres' ){
				if( !$('select.tyre_width option:findContent("'+$(this).data('w')+'")').html() ){
					disable = true;
				}
				if( !$('select.tyre_height option:findContent("'+$(this).data('h')+'")').html() ){
					disable = true;
				}
				if( !$('select.tyre_diam option:findContent("'+$(this).data('d')+'")').html() ){
					disable = true;
				}
			}else if( $('input[name="type_filter"]').val() == 'disk' ){
				if( !$('select.disk_diam option:findContent("'+$(this).data('d')+'")').html() ){
					disable = true;
				}
				if( !$('select.disk_width option:findContent("'+$(this).data('w')+'")').html() ){
					disable = true;
				}
				if( !$('select.disk_lz option:findContent("'+$(this).data('lz')+'")').html() ){
					disable = true;
				}
				if( !$('select.disk_pcd option:findContent("'+$(this).data('pcd')+'")').html() ){
					disable = true;
				}
			}
			
			if( disable ){
				$(this).attr('disabled', 'disabled').siblings('label').after('<font style="color: red; display: inline-block; *display: inline; zoom: 1; vertical-align: top; margin-top: 3px;">Нет в наличии</font>').parent().css('width', 'auto');
			}
			
			if( $(this).attr('checked') == 'checked' ){
				checked = true;
			}
		})
		
		if( !checked ){
			$('#car_list_wrap input[type="radio"]').first().click();
		}
	})
</script>