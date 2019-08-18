<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$_REQUEST["show_all"]="Y";?>
<div class="module-order-history">
	<?
		$cache = new CPHPCache();
		$cache_time = 0;
		$cache_path = SITE_DIR.'order_year/';
		$cache_id = 'order_year';
		
		if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) )
		{
			$res = $cache->GetVars();
			$arYear = $res["arYear"];
		}
		else
		{	
			$arYear = array();
			global $USER;
			$rsOrder = CSaleOrder::GetList( array( "DATE_INSERT" => "ASC" ), array("USER_ID"=>$USER->GetID()) );
			while( $arOrder = $rsOrder->GetNext() )
			{
				$date = explode( ' ', $arOrder["DATE_INSERT"] );
				$year = explode( '.', $date[0] );
				$arYear[$year[2]] = $year[2];
			}
			if ($cache_time > 0)
			{
				$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
				$cache->EndDataCache(array("arYear" => $arYear));
			}
		}
		
		if( !empty( $_REQUEST["filter_date_from"] ) )
		{
			$cur_date = explode( '.', $_REQUEST["filter_date_from"] );
			$cur_date = $cur_date[2];
		} else {$cur_date = 'all';}
	?>
	
	<span class="form-block-title"><?=GetMessage("ORDER_HISTORY")?></span>
	<ul class="tabs">
		<li <?=$cur_date == 'all' ? 'class="cur"' : ''?>>
			<a href="<?=$arParams["SEF_FOLDER"]?>" ><?=GetMessage("PERSONAL_ORDER_ALL")?></a>
			<div class="triangle"></div>
		</li>
		<?foreach( $arYear as $year ):?>
			<li <?=$cur_date == $year ? 'class="cur"' : ''?>>
				<a href="<?=$arParams["SEF_FOLDER"]?>?filter_date_from=01.01.<?=$year?>&filter_date_to=31.12.<?=$year?>&filter=Y"><?=$year?></a>
				<div class="triangle"></div>
			</li>
		<?endforeach;?>
	</ul>
	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.personal.order.list",
		"orders",
		array(
			"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
			"PATH_TO_DETAIL" => $arResult["PATH_TO_DETAIL"],
			"PATH_TO_CANCEL" => $arResult["PATH_TO_CANCEL"],
			"PATH_TO_COPY" => $arResult["PATH_TO_LIST"].'?ID=#ID#',
			"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
			"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
			"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
			"SET_TITLE" =>$arParams["SET_TITLE"],
			"ID" => $arResult["VARIABLES"]["ID"],
			"NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
		),
		$component
	);?>
</div>