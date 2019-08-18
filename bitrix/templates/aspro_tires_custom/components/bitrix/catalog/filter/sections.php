<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$iBlock = CIBlock::GetList(Array("SORT"=>"ASC"),Array("ID" =>  $arParams["IBLOCK_ID"]))->GetNext();?>
<?$APPLICATION->SetTitle($iBlock["NAME"]);?>


	<?if ($arParams["USE_FILTER"]=="Y"){?>
		<?if (CSite::InDir(SITE_DIR.'search/tires')):?>
			<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_tires", array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => "",
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => "N",
				"SAVE_IN_SESSION" => "N",
				"INSTANT_RELOAD" => "Y",
				"PRICE_CODE" => array(
				),
				"SHIRINA_PROFILYA" => $arParams["SHIRINA_PROFILYA"],
				"VYSOTA_PROFILYA" => $arParams["VYSOTA_PROFILYA"],
				"POSADOCHNYY_DIAMETR" => $arParams["POSADOCHNYY_DIAMETR"],
				"SEZONNOST" => $arParams["SEZONNOST"],
				"SHIPY" => $arParams["SHIPY"],
				"PROIZVODITEL" => $arParams["PROIZVODITEL"],
				"RUN_ON_FLAT" => $arParams["RUN_ON_FLAT"],
				),
				false
			);?> 
		<?elseif(CSite::InDir(SITE_DIR.'search/wheels')):?>
			<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_wheels", array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => "",
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => "N",
				"SAVE_IN_SESSION" => "N",
				"INSTANT_RELOAD" => "Y",
				"PRICE_CODE" => array(
				),
				"POSADOCHNYY_DIAMETR_DISKA" => $arParams["POSADOCHNYY_DIAMETR_DISKA"],
				"SHIRINA_DISKA" => $arParams["SHIRINA_DISKA"],
				"COUNT_OTVERSTIY" => $arParams["COUNT_OTVERSTIY"],
				"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MEZHBOLTOVOE_RASSTOYANIE"],
				"DIAMETR_STUPITSY" => $arParams["DIAMETR_STUPITSY"],
				"VYLET_DISKA" => $arParams["VYLET_DISKA"],
				"PROIZVODITEL" => $arParams["PROIZVODITEL"]
				),
				false
			);?> 
		<?elseif(CSite::InDir(SITE_DIR.'search/accumulators')):?>
			<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_accumulators", array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => "",
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => "N",
				"SAVE_IN_SESSION" => "N",
				"INSTANT_RELOAD" => "Y",
				"PRICE_CODE" => array(
				),
				"EMKOST" => $arParams["EMKOST"],
				"POLARNOST" => $arParams["POLARNOST"],
				"KLEMMY" => $arParams["KLEMMY"],
				"PROIZVODITEL" => $arParams["PROIZVODITEL"]
				),
				false
			);?> 
		<?endif;?>
	<?}?>


	<?
		global $sCatalogDisplay;
		$sCatalogDisplay = strtolower($arParams["LIST_DEFAULT_CATALOG_TEMPLATE"]);
		if($_REQUEST['display']) {$sCatalogDisplay = $_REQUEST['display'];}
		elseif($_SESSION['display']) {$sCatalogDisplay = $_SESSION['display'];}
		$_SESSION['display'] = $sCatalogDisplay;
		
		global $sCatalogSort;
		global $sCatalogSortOrder;
		$sCatalogSort = strtolower($arParams["ELEMENT_SORT_FIELD"]);
		$sCatalogSortOrder = strtolower($arParams["ELEMENT_SORT_ORDER"]);
		if($_REQUEST['sort']) {$sCatalogSort = $_REQUEST['sort'];}
		elseif($_SESSION['sort']) {$sCatalogSort = $_SESSION['sort'];}
		$_SESSION['sort'] = $sCatalogSort;
		if($_REQUEST['order']) {$sCatalogSortOrder = $_REQUEST['order'];}
		elseif($_SESSION['order']) {$sCatalogSortOrder = $_SESSION['order'];}
		$_SESSION['order'] = $sCatalogSortOrder;
	?>
				
	<div class="catalog_display filter">
	
		<span class="catalog_sort">
			<span class="sort_title"><?=GetMessage("CATALOG_SORT");?></span>
			<select>
				<?
					$basePrice = CCatalogGroup::GetBaseGroup();
					$arSorts = array(
						"POPULARITY" => array("NAME"=>"SHOW_COUNTER", "ORDER"=>array("asc", "desc")),
						"PRICE" => array("NAME"=>"CATALOG_PRICE_".$basePrice["ID"], "ORDER"=>array("asc", "desc")),
						"MANUFACTURER" => array("NAME"=>"PROPERTY_".$arParams["PROIZVODITEL"], "ORDER"=>array("asc", "desc")),
						"NAME" => array("NAME"=>"NAME", "ORDER"=>array("asc", "desc")),
					);
					foreach($arSorts as $key=>$arSort)
					{
						foreach($arSort["ORDER"] as $sortOrder)
						{
							$selected="";
							if ((strtoupper($sCatalogSort)==$arSort["NAME"])&&(strtoupper($sCatalogSortOrder)==strtoupper($sortOrder))){$selected="selected ";}
							echo '<option '.$selected.'value="'.$APPLICATION->GetCurPageParam('sort='.strtolower($arSort["NAME"]).'&order='.$sortOrder, array("sort", "order")).'">'
								.GetMessage("SORT_".$key."_".strtoupper($sortOrder)).'</option>';
						}
					}
				?>
			</select>
		</span>
	
		<a rel="nofollow" <?if ($sCatalogDisplay!="block"):?>href="<?=$APPLICATION->GetCurPageParam('display=block', array('display', 'mode'))?>"<?endif;?> class="block<?if ($sCatalogDisplay=="block"):?> current<?endif;?>">
			<span><?=GetMessage("DISPLAY_BLOCK")?></span>
		</a>
		<a rel="nofollow" <?if ($sCatalogDisplay!="list"):?>href="<?=$APPLICATION->GetCurPageParam('display=list', 	array('display', 'mode'))?>"<?endif;?> class="list<?if ($sCatalogDisplay=="list"):?> current<?endif;?>">
			<span><?=GetMessage("DISPLAY_LIST")?></span>
		</a>
	</div>	
	<script>
		$(".catalog_display a").onselectstart = function() { return false; };
		$(".catalog_display a").click(function()
		{
			if (!$(this).is(".current"))
			{
				$(this).parents(".catalog_display").find("a").removeClass("current");			
				$(this).addClass("current");
			}
		});
		$(".catalog_sort select").change(function()
		{
			document.location.href = $(this).attr("value");
		});
	</script>
	
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"catalog_".$sCatalogDisplay."_filter",
		Array(
			"DISCOUNT_PRICE_CODE" => $arParams["DISCOUNT_PRICE_CODE"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ORDER_BUTTON_VIEW" => \Bitrix\Main\Config\Option::get("aspro.tires", "ORDER_BUTTON", "order"),
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"ELEMENT_SORT_FIELD" => $sCatalogSort,
			"ELEMENT_SORT_ORDER" => $sCatalogSortOrder,
			"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"MATCHING_ELEMENT_PROPERTIES" => array
			(
				"POSADOCHNYY_DIAMETR_DISKA" => $arParams["POSADOCHNYY_DIAMETR_DISKA"],
				"SHIRINA_DISKA" => $arParams["SHIRINA_DISKA"],
				"DIAMETR_STUPITSY" => $arParams["DIAMETR_STUPITSY"],
				"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MEZHBOLTOVOE_RASSTOYANIE"],
				"VYLET_DISKA" => $arParams["VYLET_DISKA"],
				"SHIRINA_PROFILYA" => $arParams["SHIRINA_PROFILYA"],
				"VYSOTA_PROFILYA" => $arParams["VYSOTA_PROFILYA"],
				"POSADOCHNYY_DIAMETR" => $arParams["POSADOCHNYY_DIAMETR"],
				"SEZONNOST" => $arParams["SEZONNOST"],
				"SHIPY" => $arParams["SHIPY"],
				"COUNT_OTVERSTIY" => $arParams["COUNT_OTVERSTIY"],
				"PROIZVODITEL" => $arParams["PROIZVODITEL"],
				
			),
			"LIST_DISPLAY_POPUP_IMAGE" => $arParams["LIST_DISPLAY_POPUP_IMAGE"],
			
			"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			
			"USE_STORE" => $arParams["USE_STORE"],
			"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
			"MIN_AMOUNT"=>$arParams["MIN_AMOUNT"],
			"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
			"MAIN_TITLE"=>$arParams["MAIN_TITLE"],
			"MAIN_TITLE_LIST"=>$arParams["MAIN_TITLE_LIST"],
			"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
			"SHOW_ALL_WO_SECTION" => "Y",
			
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
			"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"MAX_COUNT" => $arParams["MAX_COUNT"],
			"USE_REVIEW" => $arParams["USE_REVIEW"],
			"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
			"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
			"REVIEW_AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
			"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
			"FORUM_ID" => $arParams["FORUM_ID"],
			"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
			"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
			"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
			"USE_RATING" => $arParams["USE_RATING"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"ADD_SECTIONS_CHAIN" => "Y",
			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
			
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"SECTION_USER_FIELDS" =>array(
				0 => "UF_NEW",
				1 => "UF_AKCIYA",
				2 => "UF_HIT",
				3 => "UF_MORE_FILES"
			),
			"DETAIL_URL" => trim($arParams["SEF_FOLDER_CATALOG"]).$arResult["URL_TEMPLATES"]["element"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		), 	$component
	);?>
	
	<div id="no_products" style="display: none;">
		<p class="no_products"><?=GetMessage("NO_PRODUCTS")?></p>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"manufacturers",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => 1,
				"SECTION_URL" => trim($arParams["SEF_FOLDER_CATALOG"]).$arResult["URL_TEMPLATES"]["section"],
			), $component
		);?>
	</div>
		