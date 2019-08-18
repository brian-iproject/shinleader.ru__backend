<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$type_filter = isset( $_REQUEST['type_filter'] ) && $_REQUEST['type_filter'] == 'disk' ? 'disk' : 'tyres';?>
<div class="errs">
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include_areas/error_car_txt.php", Array(), Array(
							"MODE"      => "html",
							"NAME"      => "Текст ошибки",
							));
						?>
</div>
<div class="filter-data">
	<form id="filters_form_auto" name="_form" action="<?=$type_filter == 'disk' ? '/search/disk/' : '/search/tyres/'?>" method="get">
		<input type="hidden" name="box_type" value="avto" />
		<div class="sel-row">
			<div class="sel-section marka-select">
				<div class="label">Марка</div> 
				<select name="car" class="cars-list" id="CAR">
					<option value="" <?=!empty( $arParams["AUTO_MARK"] ) ? '' : 'selected="selected"'?>>-</option>
					<?foreach( $arResult["CARS"] as $car ){?>
						<option value="<?=$car["NAME"]?>" <?=$arParams["AUTO_MARK"] == $car["NAME"] ? 'selected="selected"' : ''?>><?=$car["NAME"]?></option>
					<?}?>
				</select>
			</div>
			<div class="sel-section model-select">
				<div class="label">Модель</div> 
				<select name="model" class="cars-list" id="MODEL">
					<option value="" <?=!empty( $arParams["AUTO_MODEL"] ) ? '' : 'selected="selected"'?>>-</option>
					<?foreach( $arResult["MODEL"] as $model ){?>
						<option value="<?=$model["NAME"]?>" <?=$arParams["AUTO_MODEL"] == $model["NAME"] ? 'selected="selected"' : ''?>><?=$model["NAME"]?></option>
					<?}?>
				</select>
			</div>
			<div class="sel-section year-select">
				<div class="label">Год выпуска</div>
				<select name="year" class="cars-list" id="YEAR">
					<option value="" <?=!empty( $arParams["AUTO_YEAR"] ) ? '' : 'selected="selected"'?>>-</option>
					<?foreach( $arResult["YEAR"] as $year ){?>
						<option value="<?=$year["NAME"]?>" <?=$arParams["AUTO_YEAR"] == $year["NAME"] ? 'selected="selected"' : ''?>><?=$year["NAME"]?></option>
					<?}?>
				</select>
			</div>
			<div class="sel-section equipment-select">
				<div class="label">Комплектация</div>
				<select name="modification" class="cars-list" id="MODIFICATION">
					<option value="" <?=!empty( $arParams["AUTO_COMPLECT"] ) ? '' : 'selected="selected"'?>>-</option>
					<?foreach( $arResult["MODIFICATION"] as $modification ){?>
						<option value="<?=$modification["NAME"]?>" <?=$arParams["AUTO_COMPLECT"] == $modification["NAME"] ? 'selected="selected"' : ''?>><?=$modification["NAME"]?></option>
					<?}?>
				</select>
			</div>
			<div class="ch-section">
				<div class="check-block">
					<input type="radio" id="tyres" name="type_filter" value="tyres" <?=$type_filter == 'tyres' ? 'checked="checked"' : ''?> /><label class="icon-tyres" for="tyres"><span>Шины</span></label>
				</div>
				<div class="check-block">
					<input type="radio" id="wheels" name="type_filter" value="disk" <?=$type_filter == 'disk' ? 'checked="checked"' : ''?> /><label class="icon-wheels" for="wheels"><span>Диски</span></label>
				</div>
			</div>
		</div>
		<div class="but-row">
			<button class="button-25" type="submit" name="set_filter" value="Y"><span>Подобрать</span></button>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('select.cars-list').on('change', function(){
			$.ajax({
				url: '/ajax/car_list.php?template=front&car='+$('select#CAR').val()+'&model='+$('select#MODEL').val()+'&year='+$('select#YEAR').val()+'&modification='+$('select#MODIFICATION').val()+'&type_filter='+$('input[name="type_filter"]:checked').val()
			}).done(function( text ) {
				$('#car_list_wrap').html(text);
			});
		})
		$('#filters_form_auto').submit(function(){
			if(($('select[name=car]').val()=='') || ($('select[name=model]').val()=='') || ($('select[name=year]').val()=='') || ($('select[name=modification]').val()=='')){
				$(this).parent().parent().find('div.errs').show();
				return false;
			}//elseif(){
				
			//}
		});
		$('input[type="radio"]').on('change', function(){
			if( $(this).val() == 'tyres' ){
				$('form#filters_form_auto').attr('action', '/search/tyres/');
			}else if( $(this).val() == 'disk' ){
				$('form#filters_form_auto').attr('action', '/search/disk/');
			}
		})
	})
</script>