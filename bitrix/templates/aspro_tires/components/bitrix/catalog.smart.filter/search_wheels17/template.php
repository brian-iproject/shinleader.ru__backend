<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$arResult["JS_FILTER_PARAMS"]['SEF_SET_FILTER_URL'] = $arResult["JS_FILTER_PARAMS"]['SEF_DEL_FILTER_URL'] = false;?>
<?global $USER;?>
	<div class="module-filter wheels">

		<form class="styled" id="filter_form" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get">
			<input type="hidden" name="type_filter" value="wheels" />
			<?if (!empty($arResult["HIDDEN"])):?>
				<?foreach($arResult["HIDDEN"] as $arItem){?><input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" /><?}?>
			<?endif;?>

			<div class="filter-boxes">

				<?
					if (COption::GetOptionString("aspro.tires", "USE_FILTERS", SITE_ID)=="Y")
					{ $box_type = isset( $_REQUEST["box_type"] ) ? $_REQUEST["box_type"] : ''; }
					else {$box_type="params";}
				?>
				<ul class="filter-tabs">
					<li class="tab opt <?=$box_type == 'params' ? 'cur' : ''?>">
						<span><?=(COption::GetOptionString("aspro.tires", "USE_FILTERS", SITE_ID)=="Y") ? GetMessage("BY_PARAMS") : GetMessage("PARAMS");?></span><i class="triangle"></i>
					</li>
					<?if (COption::GetOptionString("aspro.tires", "USE_FILTERS", SITE_ID)=="Y"){?>
						<li class="tab avto <?=$box_type == 'avto' ? 'cur' : ''?>">
							<span><?=GetMessage("BY_AUTO");?></span><i class="triangle"></i>
						</li>
					<?}?>
				</ul>

				<div class="filter_content">

					<div class="box <?=$box_type == 'params' ? 'visible' : ''?>">
						<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"] ) || !empty( $arResult["PROP"]["SHIRINA_DISKA"] ) || !empty( $arResult["PROP"]["COUNT_OTVERSTIY"] ) || !empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"] ) )?>
						<?{?>
							<span class="filter_left">
								<div class="parameters-selects">

									<div class="row">
										<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"] ) ){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("DIAMETER")?></div>
												<select class="disk_diam">
													<option value="" data-value="default">&mdash;</option>
													<?foreach( $arResult["PROP"]["POSADOCHNYY_DIAMETR_DISKA"][0]["VALUES"] as $val ){
														if( $val["CHECKED"] ){?>
															<script>
																$('select.disk_diam').attr('name', '<?=$val["CONTROL_ID"]?>');
															</script>
														<?}?>
														<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
													<?}?>
												</select>
											</div>
											<?if( !empty( $arResult["PROP"]["SHIRINA_DISKA"] ) ):?><div class="inline-help">&times;</div><?endif;?>
										<?}?>
										<?if( !empty( $arResult["PROP"]["SHIRINA_DISKA"] ) ){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("WIDTH")?></div>
												<select class="disk_width">
													<option value="" data-value="default">&mdash;</option>
													<?foreach( $arResult["PROP"]["SHIRINA_DISKA"][0]["VALUES"] as $val ){
														if( $val["CHECKED"] ){?>
															<script>
																$('select.disk_width').attr('name', '<?=$val["CONTROL_ID"]?>');
															</script>
														<?}?>
														<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
													<?}?>
												</select>
											</div>
										<?}?>
									</div>

									<div class="row">
										<hr />
										<?if( !empty( $arResult["PROP"]["COUNT_OTVERSTIY"] ) ){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("HOLE")?></div>
												<select class="disk_lz">
													<option value="" data-value="default">&mdash;</option>
													<?foreach( $arResult["PROP"]["COUNT_OTVERSTIY"][0]["VALUES"] as $val ){
														if( $val["CHECKED"] ){?>
															<script>
																$('select.disk_lz').attr('name', '<?=$val["CONTROL_ID"]?>');
															</script>
														<?}?>
														<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
													<?}?>
												</select>
											</div>
											<?if( !empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"] ) ):?><div class="inline-help">&times;</div><?endif;?>
										<?}?>
										<?if( !empty( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"] ) ){?>

											<div class="sel-bl">
												<div class="label">&nbsp;</div>
												<select class="disk_pcd">
													<option value="" data-value="default">&mdash;</option>
													<?foreach( $arResult["PROP"]["MEZHBOLTOVOE_RASSTOYANIE"][0]["VALUES"] as $val ){
														if( $val["CHECKED"] ){?>
															<script>
																$('select.disk_pcd').attr('name', '<?=$val["CONTROL_ID"]?>');
															</script>
														<?}?>
														<option data-value="<?=$val["CONTROL_ID"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
													<?}?>
												</select>
											</div>
										<?}?>
									</div>

									<?if($arResult["PROP"]["VYLET_DISKA"][0]["PROPERTY_TYPE"] == "S" && $USER->IsAdmin()):?>
										<div class="row">
											<div class="sel-bl">
												<div class="label"><?=GetMessage("OFFSET")?></div>
												<div class="badtype"><?=GetMessage("WARNING_PROPERTY_NOT_A_NUMBER")?></div>
											</div>
										</div>
									<?elseif($arResult["PROP"]["VYLET_DISKA"][0]["PROPERTY_TYPE"] != "S"):?>
										<div class="row">
											<hr />
											<?if( !empty( $arResult["PROP"]["VYLET_DISKA"] ) ){?>
												<div class="sel-bl">
													<div class="label"><?=GetMessage("OFFSET")?></div>
													<?
													$arItem = $arResult["PROP"]["VYLET_DISKA"][0];
													$cur_min = !empty( $arItem["VALUES"]["MIN"]["HTML_VALUE"] ) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"];
													$cur_max = !empty( $arItem["VALUES"]["MAX"]["HTML_VALUE"] ) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"];
													$cur_min = number_format( $cur_min, 0, '.',  '');
													$cur_max = number_format( $cur_max, 0, '.',  '');
													if( $arItem["VALUES"]["MIN"]["VALUE"] != $arItem["VALUES"]["MAX"]["VALUE"] ){?>
														<div class="select-section <?=$arItem["CODE"]?>">
															<label><?=$name?></label>
															<div class="slider_block">
																<input type="text" class="minCost disk_et_min" id="<?=$arItem["CODE"]?>_abs_min" placeholder="<?=GetMessage("OT")?>" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" />
																<span class="inline-help">&mdash;</span>
																<input type="text" class="maxCost disk_et_max" id="<?=$arItem["CODE"]?>_abs_max" placeholder="<?=GetMessage("DO")?>" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" />
																<div class="filter_<?=$arItem["CODE"]?>"></div>
																<div class="min_abs_price <?=$arItem["CODE"]?>_abs_min"><?=number_format( $arItem["VALUES"]["MIN"]["VALUE"], 0, '.', '');?></div>
																<div class="max_abs_price <?=$arItem["CODE"]?>_abs_max"><?=number_format( $arItem["VALUES"]["MAX"]["VALUE"], 0, '.', '');?></div>
																<div style="clear:both"></div>
															</div>
														</div>
														<script>
															$(".filter_<?=$arItem["CODE"]?>").slider({
																min: <?=$arItem["VALUES"]["MIN"]["VALUE"]?>,
																max: <?=$arItem["VALUES"]["MAX"]["VALUE"]?>,
																values: [<?=$cur_min?>,<?=$cur_max?>],
																range: true,
																stop: function(event, ui) {
																	if( ui.values[0] == <?=$arItem["VALUES"]["MIN"]["VALUE"]?> && ui.values[1] == <?=$arItem["VALUES"]["MAX"]["VALUE"]?> ){
																		$(this).parent().find("input.minCost").val('').change();
																		$(this).parent().find("input.maxCost").val('').change();
																	}else{
																		$(this).parent().find("input.minCost").val(ui.values[0]).change();
																		$(this).parent().find("input.maxCost").val(ui.values[1]).change();
																	}
																	if(ui.values[0]==ui.values[1]) return false;
																	sendQuery();
																},
																slide: function(event, ui){
																	if( parseInt( ui.values[0] + 6 ) > ui.values[1] )
																		return false;
																	$(this).parent().find("input.minCost").val(ui.values[0]).change();
																	$(this).parent().find("input.maxCost").val(ui.values[1]).change();
																}
															});
															$(".<?=$arItem["CODE"]?> input.minCost").keyupDelay( function(e){
																var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
																var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
																if( min_value < <?=$arItem["VALUES"]["MIN"]["VALUE"]?> ) { min_value = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.minCost").val(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>)}
																if(parseInt(min_value) > parseInt(max_value)){
																	min_value = max_value;
																	$(".<?=$arItem["CODE"]?> input.minCost").val(min_value);
																}
																sendQuery();
																$(".filter_<?=$arItem["CODE"]?>").slider("values", 0, min_value);
															}, 1000);

															$(".<?=$arItem["CODE"]?> input.maxCost").keyupDelay( function(e){
																var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
																var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
																if (max_value > <?=$arItem["VALUES"]["MAX"]["VALUE"]?>) { max_value = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.maxCost").val(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>)}
																if(parseInt(min_value) > parseInt(max_value)){
																	max_value = min_value;
																	$(".<?=$arItem["CODE"]?> input.maxCost").val(max_value);
																}
																sendQuery();
																$(".filter_<?=$arItem["CODE"]?>").slider("values", 1, max_value);
															}, 1000);
														</script>
													<?}?>
												</div>
											<?}?>
										</div>
									<?endif;?>

									<?if($arResult["PROP"]["DIAMETR_STUPITSY"][0]["PROPERTY_TYPE"] == "S" && $USER->IsAdmin()):?>
										<div class="row">
											<div class="sel-bl">
												<div class="label"><?=GetMessage("HUB_DIAMETER")?></div>
												<div class="badtype">Для работы слайдера требуется изменить тип свойства в значение <b>Чило</b> в настройке инфоблока, а также при синхорнизации с сайтом в вашей системе учета.</div>
											</div>
										</div>
									<?elseif($arResult["PROP"]["DIAMETR_STUPITSY"][0]["PROPERTY_TYPE"] != "S"):?>
										<div class="row">
											<?if( !empty( $arResult["PROP"]["DIAMETR_STUPITSY"] ) ){?>
												<div class="sel-bl">
													<div class="label"><?=GetMessage("HUB_DIAMETER")?></div>
													<?
													$arItem = $arResult["PROP"]["DIAMETR_STUPITSY"][0];
													$cur_min = !empty( $arItem["VALUES"]["MIN"]["HTML_VALUE"] ) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"];
													$cur_max = !empty( $arItem["VALUES"]["MAX"]["HTML_VALUE"] ) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"];
													$cur_min = number_format( $cur_min, 0, '.',  '');
													$cur_max = number_format( $cur_max, 0, '.',  '');
													if( $arItem["VALUES"]["MIN"]["VALUE"] != $arItem["VALUES"]["MAX"]["VALUE"] ){?>
														<div class="select-section <?=$arItem["CODE"]?>">
															<label><?=$name?></label>
															<div class="slider_block">
																<input type="text" class="minCost disk_dia_min" id="<?=$arItem["CODE"]?>_abs_min" placeholder="от" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" />
																<span class="inline-help">&mdash;</span>
																<input type="text" class="maxCost disk_dia_max" id="<?=$arItem["CODE"]?>_abs_max" placeholder="до" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" />
																<div class="filter_<?=$arItem["CODE"]?>"></div>
																<div class="min_abs_price <?=$arItem["CODE"]?>_abs_min"><?=number_format( $arItem["VALUES"]["MIN"]["VALUE"], 0, '.', '');?></div>
																<div class="max_abs_price <?=$arItem["CODE"]?>_abs_max"><?=number_format( $arItem["VALUES"]["MAX"]["VALUE"], 0, '.', '');?></div>
																<div style="clear:both"></div>
															</div>
														</div>
														<script>
															$(".filter_<?=$arItem["CODE"]?>").slider({
																min: <?=$arItem["VALUES"]["MIN"]["VALUE"]?>,
																max: <?=$arItem["VALUES"]["MAX"]["VALUE"]?>,
																values: [<?=$cur_min?>,<?=$cur_max?>],
																range: true,
																stop: function(event, ui) {
																	if( ui.values[0] == <?=$arItem["VALUES"]["MIN"]["VALUE"]?> && ui.values[1] == <?=$arItem["VALUES"]["MAX"]["VALUE"]?> ){
																		$(this).parent().find("input.minCost").val('').change();
																		$(this).parent().find("input.maxCost").val('').change();
																	}else{
																		$(this).parent().find("input.minCost").val(ui.values[0]).change();
																		$(this).parent().find("input.maxCost").val(ui.values[1]).change();
																	}
																	if(ui.values[0]==ui.values[1]) return false;
																	sendQuery();
																},
																slide: function(event, ui){
																	if( parseInt( ui.values[0] + 1) > ui.values[1] )
																		return false;
																	$(this).parent().find("input.minCost").val(ui.values[0]).change();
																	$(this).parent().find("input.maxCost").val(ui.values[1]).change();
																}
															});
															$(".<?=$arItem["CODE"]?> input.minCost").keyupDelay( function(e){
																var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
																var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
																if( min_value < <?=$arItem["VALUES"]["MIN"]["VALUE"]?> ) { min_value = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.minCost").val(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>)}
																if(parseInt(min_value) > parseInt(max_value)){
																	min_value = max_value;
																	$(".<?=$arItem["CODE"]?> input.minCost").val(min_value);
																}
																sendQuery();
																$(".filter_<?=$arItem["CODE"]?>").slider("values", 0, min_value);
															}, 1000);

															$(".<?=$arItem["CODE"]?> input.maxCost").keyupDelay( function(e){
																var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
																var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
																if (max_value > <?=$arItem["VALUES"]["MAX"]["VALUE"]?>) { max_value = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.maxCost").val(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>)}
																if(parseInt(min_value) > parseInt(max_value)){
																	max_value = min_value;
																	$(".<?=$arItem["CODE"]?> input.maxCost").val(max_value);
																}
																sendQuery();
																$(".filter_<?=$arItem["CODE"]?>").slider("values", 1, max_value);
															}, 1000);
														</script>
													<?}?>
												</div>
											<?}?>
										</div>
									<?endif;?>
								</div>
							</span>
						<?}?>

						<?if( !empty( $arResult["PROP"]["PROIZVODITEL"] ) ){?>
							<span class="filter_right">
								<div class="filter-b makers-list">
									<div class="label"><?=GetMessage("MANUFACTURER")?></div>
									<?$i = 0;?>
									<?foreach( $arResult["PROP"]["PROIZVODITEL"][0]["VALUES"] as $val => $ar ){
										if( $i >= 12 ) break;?>
										<div class="ch">
											<input id="<?=$ar["CONTROL_ID"]?>" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" value="<?=$ar["HTML_VALUE"]?>" <?=$ar["CHECKED"]? 'checked="checked"': ''?> />
											<label for="<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"]?></label>
										</div><?$i++?>
									<?}?>
									<?if( count( $arResult["PROP"]["PROIZVODITEL"][0]["VALUES"] ) >= 12 ){
										$checked = false; $i = 0;
										foreach( $arResult["PROP"]["PROIZVODITEL"][0]["VALUES"] as $val => $ar )
											{ if( $i < 12 ){ $i++; continue; } if( $ar["CHECKED"] ){$checked = true;} }
										?>
										<span class="view-all <?=$checked ? 'show' : 'hide'?>">
											<?$i = 0;?>
											<?foreach( $arResult["PROP"]["PROIZVODITEL"][0]["VALUES"] as $val => $ar )
											{ if( $i < 12 ){ $i++; continue; }?>
												<div class="ch">
													<input id="<?=$ar["CONTROL_ID"]?>" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" value="<?=$ar["HTML_VALUE"]?>" <?=$ar["CHECKED"]? 'checked="checked"': ''?> />
													<label for="<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"]?></label>
												</div><?$i++?>
											<?}?>
										</span>
										<a href="<?=$_SERVER["REQUEST_URI"]?>" class="more_small<?=$checked ? " opened" : ""?>"><span><?=$checked ? GetMessage("HIDE") : GetMessage("SHOW_ALL")?></span></a>
									<?}?>
								</div>
							</span>
						<?}?>

						<?if (!$arParams["INSTANT_RELOAD"]):?>
							<!--noindex-->
								<div class="filter_submit">
									<button class="button1" type="submit" name="set_filter" value="yes" onclick="sendQuery()"><span><?=GetMessage("FILTER_SUBMIT")?></span></button>
								</div>
							<!--/noindex-->
						<?endif;?>

						<div class="filter_image"></div>
					</div>

					<?if (COption::GetOptionString("aspro.tires", "USE_FILTERS", SITE_ID)=="Y"){?>
						<div class="box <?=$box_type == 'avto' ? 'visible' : ''?>">
							<div id="car_list_wrap">
								 <?$APPLICATION->IncludeComponent(
	"aspro:auto.list",
	"filter",
	array(
		"AUTO_MARK" => $_REQUEST["car"],
		"AUTO_MODEL" => $_REQUEST["model"],
		"AUTO_YEAR" => $_REQUEST["year"],
		"AUTO_COMPLECT" => $_REQUEST["modification"],
		"TYPE_FILTER" => "wheels",
		"INSTANT_RELOAD" => "N",
		"VYLET_DISKA_TYPE" => "RANGE",
		"VYLET_DISKA_RANGE_MIN" => "3",
		"VYLET_DISKA_RANGE_MAX" => "3",
		"DIAMETR_STUPITSY_TYPE" => "RANGE",
		"DIAMETR_STUPITSY_RANGE_MIN" => "0",
		"DIAMETR_STUPITSY_RANGE_MAX" => "10000"
	),
	false
);?>
							</div>

							<!--noindex-->
							<div class="filter_submit<?=($arParams["INSTANT_RELOAD"] ? ' hidden' : '')?>">
								<button class="button1" type="submit" name="set_filter" id="set_filter" value="yes" onclick="sendQuery()"><span><?=GetMessage("FILTER_SUBMIT")?></span></button>
							</div>
							<!--/noindex-->
							<div class="filter_image"></div>
						</div>
					<?}?>



				</div>
			</div>
		</form>
	</div>

	<?if( intval($arResult["FINDED_COUNT"]) > 0):?>
		<div class="result-block">
			<?=declOfNum($arResult["FINDED_COUNT"], array(GetMessage("FINDED_1"), GetMessage("FINDED_2"), GetMessage("FINDED_2")))?>
			<span><?=$arResult["FINDED_COUNT"];?></span>
			<?=declOfNum($arResult["FINDED_COUNT"], array(GetMessage("PRODUCTS_1"), GetMessage("PRODUCTS_2"), GetMessage("PRODUCTS_3")))?>
		</div>
	<?endif;?>

	<script>
	var sendQuery = function( send_query )
	{
		smartFilterWheels.click($("#filter_form input").first()[0])
		return false;

		var query_full_addr = window.location.pathname.split( '/' );
		var query_path = "<?=SITE_DIR?>search/";

		if ("/"+$.trim(query_full_addr[1])+"/"=="<?=SITE_DIR?>") { query_path = query_path + query_full_addr[3]+"/?"; }
		else { query_path = query_path + query_full_addr[2]+"/?"; }

		query = query_path;

		if( send_query == undefined )
		{
			query = query + decodeURIComponent($("#filter_form").serialize());
			query += '&set_filter=yes&r=1';
		} else { query = send_query; }

		var History = window.History;
		if ( !History.enabled ) { return false; }

		History.pushState(null,document.title, query);

		//console.log(query);

		jsAjaxUtil.ShowLocalWaitWindow( 'id', 'content', true );
		$.ajax( { url: query }).done(function( text )
		{
			$('#content').html(text);
			jsAjaxUtil.CloseLocalWaitWindow( 'id', 'content' );
		});
	};

	var boxType = "<?=$box_type?>";
	if (!boxType)
	{
		var filterCurrentTab = localStorage['wheelsTiresFilterTiresCurrentTab'];
		if (filterCurrentTab)
		{
			$(".filter-tabs li").removeClass("cur");
			$(".filter-tabs li:eq("+filterCurrentTab+")").addClass("cur");
			$(".filter_content .box").removeClass("visible");
			$(".filter_content .box:eq("+filterCurrentTab+")").addClass("visible");
		}
		else
		{
			filterCurrentTab = 0;
			$(".filter-tabs li").removeClass("cur");
			$(".filter-tabs li:eq("+filterCurrentTab+")").addClass("cur");
			$(".filter_content .box").removeClass("visible");
			$(".filter_content .box:eq("+filterCurrentTab+")").addClass("visible");
		}
	}

	$('.filter-tabs').delegate('.tab:not(.cur)', 'click', function()
	{
		localStorage['wheelsTiresFilterTiresCurrentTab'] = $(this).index();
		$(this).addClass('cur').siblings().removeClass('cur')
		.parents('.module-filter').find('div.box').eq($(this).index()).addClass('visible').siblings('div.box').removeClass('visible');
		$('input[name="box_type"]').remove();
		if( $(this).hasClass('opt') )
		{
			$('form#filter_form').prepend('<input type="hidden" name="box_type" value="params" />');
		}
		else if( $(this).hasClass('avto') )
		{
			$('form#filter_form').prepend('<input type="hidden" name="box_type" value="avto" />');
		}
	})



	$('form#filter_form select:not(.cars-list)').on("change", function()
	{
		$(this).attr('name', $(this).find('option:eq('+$(this)[0].selectedIndex+')').attr('data-value'));
		<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery();<?endif;?>
	});

	$('form#filter_form input[type="checkbox"]:not(.cars-list)').on("change", function()
	{
		<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery();<?endif;?>
	});

	$('form#filter_form .reset').on("click", function(e)
	{
		e.preventDefault();
		<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery($(this).attr('href'));<?endif;?>
	});


	$(document).ready( function()
	{

		$('.more_small').on('click', function(e){
			e.preventDefault();
			if( $('.view-all').hasClass('hide') )
			{
				$('.view-all').removeClass('hide');
				$(this).addClass("opened").html('<span><?=GetMessage("HIDE")?></span>');
			}
			else
			{
				$('.view-all').addClass('hide');
				$(this).removeClass("opened").html('<span><?=GetMessage("SHOW_ALL")?></span>');
			}
		})
	});
	</script>
<script type="text/javascript">
	var smartFilterWheels = new JCSmartFilter('<?echo CUtil::JSEscape(str_replace('catalog', 'search', $arResult["FORM_ACTION"]))?>', 'horizontal', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>