<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<div class="module-filter accumulators">
		
		<form class="styled" id="filter_form" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get">
			<?foreach($arResult["HIDDEN"] as $arItem){?><input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" /><?}?>
						
			<div class="filter-boxes">
				<div class="filter_content">
					<div class="box visible">
						<?if( !empty( $arResult["PROP"]["EMKOST"] ) || !empty( $arResult["PROP"]["POLARITY"] ) || !empty( $arResult["PROP"]["KLEMMY"] ) )?>
						<?{?>
							<span class="filter_left">
								<div class="parameters-selects">
									
										<?if( !empty( $arResult["PROP"]["EMKOST"] ) ){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("CAPACITY")?></div>
												<select class="disk_pcd">
													<option value="">&mdash;</option>
													<?foreach( $arResult["PROP"]["EMKOST"][0]["VALUES"] as $val ){
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
										
										<?if( !empty( $arResult["PROP"]["POLARNOST"] )){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("POLARITY")?></div>
												<?$i = 0;?>
												<?foreach( $arResult["PROP"]["POLARNOST"][0]["VALUES"] as $val => $ar ){
													if( $i >= 12 ) break;?>
													<div class="ch">
														<input id="<?=$ar["CONTROL_ID"]?>" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" value="<?=$ar["HTML_VALUE"]?>" <?=$ar["CHECKED"]? 'checked="checked"': ''?> />
														<label for="<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"]?></label>
													</div><?$i++?>
												<?}?>
											</div>
										<?}?>
										
										<?if( !empty( $arResult["PROP"]["KLEMMY"] )){?>
											<div class="sel-bl">
												<div class="label"><?=GetMessage("TERMINALS")?></div>
												<?$i = 0;?>
												<?foreach( $arResult["PROP"]["KLEMMY"][0]["VALUES"] as $val => $ar ){
													if( $i >= 12 ) break;?>
													<div class="ch">
														<input id="<?=$ar["CONTROL_ID"]?>" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" value="<?=$ar["HTML_VALUE"]?>" <?=$ar["CHECKED"]? 'checked="checked"': ''?> />
														<label for="<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"]?></label>
													</div><?$i++?>
												<?}?>
											</div>
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
	

		
		$('.filter-tabs').delegate('.tab:not(.cur)', 'click', function() 
		{
			$(this).addClass('cur').siblings().removeClass('cur')
			.parents('.module-filter').find('div.box').eq($(this).index()).addClass('visible').siblings('div.box').removeClass('visible');
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