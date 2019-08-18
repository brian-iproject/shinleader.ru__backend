<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="stores">

	<div class="left_side">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.store.list",
			"stores_list",
			Array(
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"PHONE" => $arParams["PHONE"],
				"SCHEDULE" => $arParams["SCHEDULE"],
				"TITLE" => $arParams["TITLE"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"PATH_TO_ELEMENT" => $arParams["PATH_TO_ELEMENT"],
				"PATH_TO_LISTSTORES" => $arParams["PATH_TO_LISTSTORES"],
				"MAP_TYPE" => $arParams["MAP_TYPE"],
				"CURRENT_STORE" => $arResult["ID"],
			),	$component
		);?>
	</div>

	<div class="right_side">
		<h2><b><?=$arResult["TITLE"]?></b></h2>
		<?
			if(($arResult["GPS_S"]!=0) && ($arResult["GPS_N"]!=0))
			{
				$gpsN=substr(doubleval($arResult["GPS_N"]),0,15);
				$gpsS=substr(doubleval($arResult["GPS_S"]),0,15);
				$arPlacemarks[]=array("LON"=>$gpsS,"LAT"=>$gpsN,"TEXT"=>$arResult["TITLE"]);
			}
			if($arResult["MAP"]==0)
			{
				$APPLICATION->IncludeComponent("bitrix:map.yandex.view", "map", array(
					"INIT_MAP_TYPE" => "MAP",
					"MAP_DATA" => serialize(array("yandex_lat"=>$gpsN,"yandex_lon"=>$gpsS,"yandex_scale"=>16,"PLACEMARKS" => $arPlacemarks)),
					"MAP_WIDTH" => "100%",
					"MAP_HEIGHT" => "310",
					"CONTROLS" => array(0 => "ZOOM",),
					"OPTIONS" => array(0 => "ENABLE_SCROLL_ZOOM", 1 => "ENABLE_DBLCLICK_ZOOM", 2 => "ENABLE_DRAGGING",	),
					"MAP_ID" => ""
				), false );
			} else {
				$APPLICATION->IncludeComponent("bitrix:map.google.view", "map", array(
					"INIT_MAP_TYPE" => "MAP",
					"MAP_DATA" => serialize(array("google_lat"=>$gpsN,"google_lon"=>$gpsS,"google_scale"=>16,"PLACEMARKS" => $arPlacemarks)),
					"MAP_WIDTH" => "100%",
					"MAP_HEIGHT" => "310",
					"CONTROLS" => array(0 => "ZOOM",),
					"OPTIONS" => array(0 => "ENABLE_SCROLL_ZOOM", 1 => "ENABLE_DBLCLICK_ZOOM", 2 => "ENABLE_DRAGGING"),
					"MAP_ID" => ""
				), false );
			}
		?>
				
		<div class="store_description">
			<?if ($arResult["IMAGE_ID"]>0):?>
				<span class="store_property image">
					<?$img_photo_small = CFile::ResizeImageGet( $arResult["IMAGE_ID"], array( "width" => 200, "height" => 200 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
					<?$img_photo_big = CFile::ResizeImageGet( $arResult["IMAGE_ID"], array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
					<a class="fancy" href="<?=$img_photo_big["src"]?>">
						<div class="fancy_hover" style="height:<?=($img_photo_small["height"]-3)?>px; width:<?=($img_photo_small["width"]-6)?>px;"></div>
						<img src="<?=$img_photo_small["src"]?>" alt="<?=$arResult["TITLE"]?>" title="<?=$arResult["TITLE"]?>" />
					</a>
				</span>
			<?endif;?>
			<?if($arResult["ADDRESS"]):?>
				<span class="store_property address">
					<div class="title">
						<i></i><?=GetMessage("ADDRESS");?>
					</div>
					<div class="value"><?=$arResult["ADDRESS"]?></div>
				</span>
			<?endif;?>
			<?if($arResult["PHONE"]):?>
				<span class="store_property phone">
					<div class="title">
						<i></i><?=GetMessage("PHONE");?>
					</div>
					<div class="value"><?=$arResult["PHONE"]?></div>
				</span>
			<?endif;?>
			<? if($arResult["SCHEDULE"]):?>
				<span class="store_property schedule">
					<div class="title">
						<i></i><?=GetMessage("SCHEDULE");?>
					</div>
					<div class="value"><?=$arResult["SCHEDULE"]?></div>
				</span>
			<?endif;?>
			<? if($arResult["~DESCRIPTION"]):?>
				<span class="store_property additional">
					<div class="title" />
						<i></i><?=GetMessage("ADDITIONAL_INFORMATION");?>
					</div>
					<div class="value"><?=$arResult["~DESCRIPTION"]?></div>
				</span>
			<?endif;?>
		</div>
	</div>
</div>

<?
	$APPLICATION->AddChainItem($arResult["TITLE"], "");
?>