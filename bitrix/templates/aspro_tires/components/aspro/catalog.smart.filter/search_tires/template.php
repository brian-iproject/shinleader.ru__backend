<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	
	<div class="module-filter tires">
		
		<form class="styled" id="filter_form" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get">
			<input type="hidden" name="type_filter" value="tires" />
			<?if (!empty($arResult["HIDDEN"])):?>
				<?foreach($arResult["HIDDEN"] as $arItem){?><input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" /><?}?>
			<?endif;?>
			
			<?if( !empty( $arResult["PROP"]["SEZONNOST"] ) || !empty( $arResult["PROP"]["SHIPY"] ) ){?>
				<div class="hidden">
					<?foreach( $arResult["PROP"]["SEZONNOST"][0]["VALUES"] as $arValue ){?>
						<div class="check-block">
							<input type="checkbox" name="<?=$arValue["CONTROL_ID"]?>" id="<?=$arValue["CONTROL_ID"]?>" value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
							<?
								$seasonClass = "";
								if (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
								elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
								elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
							?>
							<label <?if (strlen($seasonClass)):?>class="icon-<?=$seasonClass?>"<?endif;?> for="<?=$arValue["CONTROL_ID"]?>"><span><?=$arValue["VALUE"]?></span></label>
						</div>
					<?}?>
					<?if(!empty($arResult["PROP"]["SHIPY"][0]["VALUES"])){?>
						<?foreach ($arResult["PROP"]["SHIPY"][0]["VALUES"] as $key => $arValue){?>
							<div class="check-block">
								<input type="checkbox" name="<?=$arValue["CONTROL_ID"]?>" id="<?=$arValue["CONTROL_ID"]?>" value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
								<label class="icon-spikes" for="<?=$arValue["CONTROL_ID"]?>"><span><?=$arResult["PROP"]["SHIPY"][0]["NAME"]?></span></label>
							</div>
						<?}?>
					<?}?>
				</div>
			<?}?>
			<?if(isset($arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"] )){?>
				<div class="hidden">
					<div class="check-block">
						<input type="checkbox" name="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>" id="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>" value="Y" <?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
						<label class="icon-rnf" for="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>"><span><?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"]?></span></label>
					</div>
				</div>
			<?}?>
			
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
						<?if( !empty( $arResult["PROP"]["SHIRINA_PROFILYA"] ) || !empty( $arResult["PROP"]["VYSOTA_PROFILYA"] ) || !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR"] ) )?>
						<?{?>
							<span class="filter_left">	
								<div class="parameters-selects">
									<?if( !empty( $arResult["PROP"]["SHIRINA_PROFILYA"] ) ){?>
										<div class="sel-bl">
											<div class="label"><?=GetMessage("WIDTH");?></div>
											<select class="tyre_width">
												<option value="" data-value="default">&mdash;</option>
												<?foreach( $arResult["PROP"]["SHIRINA_PROFILYA"][0]["VALUES"] as $val ):?>
													<?if( $val["CHECKED"] ):?>
														<script>$('select.tyre_width').attr('name', '<?=$val["CONTROL_ID"]?>');</script>
													<?endif;?>
													<option data-value="<?=$val["CONTROL_ID"]?>" data-id="<?=$val["VALUE"]?>" value="Y" <?=$val["CHECKED"] ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
												<?endforeach;?>
											</select>
										</div>
									<?}?>
									<?if( !empty( $arResult["PROP"]["VYSOTA_PROFILYA"] ) ){?>
										<div class="inline-help">/</div>
										<div class="sel-bl">
											<div class="label"><?=GetMessage("HEIGHT");?></div>
											<select class="tyre_height">
												<option value="" data-value="default">&mdash;</option>
												<?foreach( $arResult["PROP"]["VYSOTA_PROFILYA"][0]["VALUES"] as $val ):?>
													<?if( $val["CHECKED"] ):?>
														<script> $('select.tyre_height').attr('name', '<?=$val["CONTROL_ID"]?>');</script>
													<?endif;?>
													<option data-value="<?=$val["CONTROL_ID"]?>" data-id="<?=$val["VALUE"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
												<?endforeach;?>
											</select>
										</div>
									<?}?>
									<?if( !empty( $arResult["PROP"]["POSADOCHNYY_DIAMETR"] ) ){?>
										<div class="inline-help">R</div>
										<div class="sel-bl">
											<div class="label"><?=GetMessage("DIAMETER");?></div>
											<select class="tyre_diam">
												<option value="" data-value="default">&mdash;</option>
												<?foreach( $arResult["PROP"]["POSADOCHNYY_DIAMETR"][0]["VALUES"] as $val ):?>
													<?if( $val["CHECKED"] ):?>
														<script>$('select.tyre_diam').attr('name', '<?=$val["CONTROL_ID"]?>');</script>
													<?endif;?>
													<option data-value="<?=$val["CONTROL_ID"]?>" data-id="<?=$val["VALUE"]?>" value="Y" <?=$val["CHECKED"] == 1 ? 'selected="selected"' : ''?>><?=$val["VALUE"]?></option>
												<?endforeach;?>
											</select>
										</div>
									<?}?>
									
									<?if( !empty( $arResult["PROP"]["SEZONNOST"] ) || !empty( $arResult["PROP"]["SHIPY"] ) ){?>
										<hr />
										<span id="params_select_season">
											<div class="filter-b types">
												<?foreach( $arResult["PROP"]["SEZONNOST"][0]["VALUES"] as $arValue ){?>
													<div class="check-block">
														<input type="checkbox"  value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
														<?
															$seasonClass = "";
															if (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "SUMMER_ICON", "", SITE_ID))) { $seasonClass = "summer"; }
															elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "WINTER_ICON", "", SITE_ID))) { $seasonClass = "winter"; }
															elseif (trim($arValue["VALUE"])==trim(COption::GetOptionString("aspro.tires", "ALL_SEASON_ICON", "", SITE_ID))) { $seasonClass = "all-seasons"; }
														?>
														<label <?if (strlen($seasonClass)):?>class="icon-<?=$seasonClass?>"<?endif;?> for="<?=$arValue["CONTROL_ID"]?>"><span><?=$arValue["VALUE"]?></span></label>
													</div>
												<?}?>
												<?if(!empty($arResult["PROP"]["SHIPY"][0]["VALUES"])){?>
													<?foreach ($arResult["PROP"]["SHIPY"][0]["VALUES"] as $key => $arValue){?>
														<div class="check-block">
															<input type="checkbox" value="Y" <?=$arValue["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
															<label class="icon-spikes" for="<?=$arValue["CONTROL_ID"]?>"><span><?=$arResult["PROP"]["SHIPY"][0]["NAME"]?></span></label>
														</div>
													<?}?>
												<?}?>
											</div>
										</span>
									<?}?>
									<?if(isset($arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"] )){?>
										<hr />
										<span id="params_select_season">
											<div class="check-block">
												<input type="checkbox" value="Y" <?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CHECKED"] == 1 ? 'checked="checked"' : ''?> />
												<label class="icon-rnf" for="<?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["VALUE"]["CONTROL_ID"]?>"><span><?=$arResult["PROP"][$arParams["RUN_ON_FLAT"]]["NAME"];?></span></label>
											</div>
										</span>
									<?}?>
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
										"TYPE_FILTER" => "tires",
										"INSTANT_RELOAD" => "N",
									),
									false
								);?>
							</div>
							
							<?if (!$arParams["INSTANT_RELOAD"]):?>	
								<!--noindex-->
									<div class="filter_submit">
										<button class="button1" type="submit" name="set_filter" value="yes" onclick="sendQuery()"><span><?=GetMessage("FILTER_SUBMIT")?></span></button>
									</div>
								<!--/noindex-->
							<?endif;?>
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
		
		$('form#filter_form input[type="checkbox"]').on("change", function(e)
		{
			if (!$(this).parents("#car_select_season")) 
			{
				var parentCheckboxID = $(this).attr("id");
				if ($("#"+parentCheckboxID).is(":checked"))
				{ $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").attr("checked", "checked"); }
				else { $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").removeAttr("checked"); }
			}
			else
			{			
				var parentCheckboxID = $(this).parents(".check-block").find("label").attr("for");
				if ($(this).attr("id"))
				{
					if ($("#"+parentCheckboxID).is(":checked"))
					{ $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").attr("checked", "checked"); }
					else { $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").removeAttr("checked"); }
				}
				else
				{
					if ($("#"+parentCheckboxID).is(":checked")) { $("input#"+parentCheckboxID).removeAttr("checked"); }
					else { $("input#"+parentCheckboxID).attr("checked", "checked"); }
				}
			}
			<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery();<?endif;?>	
		});
		
		$('form#filter_form .reset').on("click", function(e) 
		{ 
			<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery($(this).attr('href'));<?endif;?>
		});
		
		
		$(document).ready( function()
		{
			if ($("#car_select_season").length)
			{
				$("#car_select_season").html($("#params_select_season").html());
				$("#car_select_season input[type=checkbox]").change(function(e)
				{
					var parentCheckboxID = $(this).parents(".check-block").find("label").attr("for");
					if ($(this).attr("id"))
					{
						if ($("#"+parentCheckboxID).is(":checked"))
						{ $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").attr("checked", "checked"); }
						else { $("label[for='"+parentCheckboxID+"']").prev("input[type='checkbox']").removeAttr("checked"); }
					}
					else
					{
						if ($("#"+parentCheckboxID).is(":checked")) { $("input#"+parentCheckboxID).removeAttr("checked"); }
						else { $("input#"+parentCheckboxID).attr("checked", "checked"); }
					}
					<?if ($arParams["INSTANT_RELOAD"]):?>sendQuery();<?endif;?>	
				});
			}
			
			
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