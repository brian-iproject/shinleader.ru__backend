<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$cache = new CPHPCache();
	$cache_time = 100000;
	$cache_path = '/news_year/';
	
	$cache_id = 'news_year';
	
	if( $cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path) ){
		$res = $cache->GetVars();
		$arYear = $res["arYear"];
	}else{
		
		$arYear = array();
		CModule::IncludeModule("iblock");
		$rsItem = CIBlockElement::GetList( array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y"), false, false, array("DATE_ACTIVE_FROM"));
		while( $arItem = $rsItem->GetNext() ){
			$date = explode(' ', $arItem["DATE_ACTIVE_FROM"]);
			$date = $date[0];
			$date = explode('.', $date);
			$arYear[$date[2]] = $date[2];
		}
		
		if ($cache_time > 0)
		{
			$cache->StartDataCache( $cache_time, $cache_id, $cache_path );
			$cache->EndDataCache( 
				array( 
					"arYear" => $arYear
				) 
			);
		}
	}
?>
<?//print_r($arYear);?>
<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	$rss_url = str_replace(
		array("#SECTION_ID#", "#SECTION_CODE#")
		,array(urlencode($arResult["VARIABLES"]["SECTION_ID"]), urlencode($arResult["VARIABLES"]["SECTION_CODE"]))
		,$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss_section"]
	);
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$rss_url.'" href="'.$rss_url.'" />');
	?>
	<a href="<?=$rss_url?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>


	
<div class="year-list">
	<?$i = 0;?>
	<?arsort($arYear);?>
	<!--noindex--><a href="<?=$arParams["SEF_FOLDER"]?>" rel="nofollow"><span>Все</span></a><!--/noindex-->
		<?foreach( $arYear as $year ){?>
		<!--noindex--><a <?=$arResult["VARIABLES"]["SECTION_ID"] == $year ? 'class="cur"' : ''; ?> href="<?=$arParams["SEF_FOLDER"]?><?=$year?>/" rel="nofollow"><span><?=$year?></span></a><!--/noindex-->
	<?$i++;
	}?>
	<?//$APPLICATION->SetTitle("2013");?>
</div>
	
	<?$GLOBALS['arrFilter'] = array(
		">DATE_ACTIVE_FROM" => ConvertDateTime("01.01.".$arResult["VARIABLES"]["SECTION_ID"], "DD.MM.YYYY"),
		"<=DATE_ACTIVE_FROM" => ConvertDateTime("01.01.".(intval($arResult["VARIABLES"]["SECTION_ID"])+1), "DD.MM.YYYY")
	);
	?>	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"shinof_news",
	Array(
			"USE_FILTER" => "Y",
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
			"SORT_BY1"	=>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	=>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
			"SET_TITLE"	=>	"Y",
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	"Y",
			"DISPLAY_NAME"	=>	"Y",
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>  $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
			//"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
			//"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"ADD_SECTIONS_CHAIN" => "N"
		),
	$component
);?>
