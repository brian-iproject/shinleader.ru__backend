<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Контакты");
	
	$arStores = array();
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_path = SITE_DIR.'aspro_stores_list';
	$id = '';
	$cache_id = 'aspro_stores_list';

	if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) )
	{
		$res = $cache->GetVars();
		$arStores = $res["arStores"];
	}
	else
	{
		$objRes = CCatalogStore::GetList(array(),array("ACTIVE"=>"Y"), false, false,array("ID"));
		
		if ($objRes) 
		{ 
			while($res = $objRes->GetNext()) { $arStores[] =  $res; } 
			if ($cache_time > 0)
			{
				$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
				$cache->EndDataCache(  array( "arStores" => $arStores )  );
			}
		}
	}
	if (count($arStores))
	{
		$APPLICATION->IncludeComponent("bitrix:catalog.store", "stores_list", array(
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "/contacts/",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"PHONE" => "Y",
			"SCHEDULE" => "Y",
			"SET_TITLE" => "N",
			"TITLE" => "Склады",
			"MAP_TYPE" => "1",
			"SEF_URL_TEMPLATES" => array("liststores" => "index.php",	"element" => "#store_id#/",)
			),false
		);
	} else {
?>
	<div class="stores">
		<div class="left_side">
			<ul class="stores_list">
				<li class="cur">				
					<i></i><b>Пункт выдачи</b>
					<div class="description">Москва, Шелепихинская наб., 2А</div>			
				</li>
                <li>
                <b>Время визита на склад обязательно согласовывайте заранее!</b>
                </li>
                <li>
                <b>Электронная почта</b>
                <br>
                sale@shinleader.ru
                </li>
			</ul>
		</div>
		<div class="right_side">
			<h2><b>Московский склад</b></h2>
			<?
				$APPLICATION->IncludeComponent(
	"bitrix:map.google.view", 
	"map", 
	array(
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.748554661871;s:10:\"google_lon\";d:37.523341753101;s:12:\"google_scale\";i:18;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:0:\"\";s:3:\"LON\";d:37.52311170101211;s:3:\"LAT\";d:55.74845591312352;}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "310",
		"CONTROLS" => array(
		),
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "",
		"COMPONENT_TEMPLATE" => "map",
		"API_KEY" => "AIzaSyCWQhzXtZNfWDLEHLObmFV3AOnRViCzt7g"
	),
	false
);
			?>
			<div class="store_description">
				<span class="store_property image">		
					<? /* <a class="fancy" href="<?=SITE_TEMPLATE_PATH.'/images/store_photo.jpg'?>">
						<div class="fancy_hover" style="width: 197px;height: 147px;"></div>
						<img src="<?=SITE_TEMPLATE_PATH.'/images/store_photo.jpg'?>" style="max-width: 200px" />
					</a>*/ ?>
				</span>
				<span class="store_property address">
					<div class="title"><i></i>Адрес</div>
					<div class="value">Москва, Шелепихинская наб., 2А</div>
				</span>
				<span class="store_property phone">
					<div class="title">	<i></i>Телефон</div>
					<div class="value">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/phone_code.php", Array(), Array( "MODE" => "text", "NAME" => "Код города", ));?>
						<?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array( "MODE" => "text", "NAME" => "Телефон", ));?>	
					</div>
				</span>
				<span class="store_property schedule">
					<div class="title"><i></i>Время работы</div>
					<div class="value"><?$APPLICATION->IncludeFile(SITE_DIR."include/work_time.php", Array(), Array( "MODE" => "html", "NAME"  => "Время работы"));?></div>
				</span>
				<span class="store_property additional">
					<div class="title"><i></i>Дополнительно</div>
					<div class="value">10 минут от станции «Деловой центр»</div>
				</span>
			</div>
		</div>
	</div>	
	<div class="clearboth"></div>
	<hr />
<?}?>
<div class="m16">
	<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts_text.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("CONTACTS_TEXT"),));?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>