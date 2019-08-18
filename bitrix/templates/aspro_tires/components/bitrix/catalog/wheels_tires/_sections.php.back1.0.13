<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arParams["USE_FILTER"]=="Y"):?>
	<?if (CSite::InDir(SITE_DIR.'catalog/tires')):?>
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
	<?elseif(CSite::InDir(SITE_DIR.'catalog/wheels')):?>
		<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_wheels", array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => "",
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SAVE_IN_SESSION" => "N",
			"INSTANT_RELOAD" => "Y",
			"PRICE_CODE" => array(),
			"POSADOCHNYY_DIAMETR_DISKA" => $arParams["POSADOCHNYY_DIAMETR_DISKA"],
			"SHIRINA_DISKA" => $arParams["SHIRINA_DISKA"],
			"COUNT_OTVERSTIY" => $arParams["COUNT_OTVERSTIY"],
			"DIAMETR_STUPITSY" => $arParams["DIAMETR_STUPITSY"],
			"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MEZHBOLTOVOE_RASSTOYANIE"],
			"VYLET_DISKA" => $arParams["VYLET_DISKA"],
			"PROIZVODITEL" => $arParams["PROIZVODITEL"],
			),
			false
		);?> 
	<?elseif(CSite::InDir(SITE_DIR.'catalog/accumulators')):?>
		<?$APPLICATION->IncludeComponent("aspro:catalog.smart.filter", "search_accumulators", array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => "",
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SAVE_IN_SESSION" => "N",
			"INSTANT_RELOAD" => "Y",
			"PRICE_CODE" => array(),
			"POSADOCHNYY_DIAMETR_DISKA" => $arParams["POSADOCHNYY_DIAMETR_DISKA"],
			"SHIRINA_DISKA" => $arParams["SHIRINA_DISKA"],
			"DIAMETR_STUPITSY" => $arParams["DIAMETR_STUPITSY"],
			"MEZHBOLTOVOE_RASSTOYANIE" => $arParams["MEZHBOLTOVOE_RASSTOYANIE"],
			"VYLET_DISKA" => $arParams["VYLET_DISKA"],
			"PROIZVODITEL" => $arParams["PROIZVODITEL"],
			),
			false
		);?> 
	<?endif;?>
<?endif;?>

<div id="no_products" style="display: none;">
	<p class="no_products"><?=GetMessage("NO_PRODUCTS")?></p>
</div>
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
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	), $component
);?>

