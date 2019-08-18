<?
	/*SKU -- */
	$basePriceType = CCatalogGroup::GetBaseGroup();
	$basePriceTypeName = $basePriceType["NAME"];

	$arOffersIblock = CIBlockPriceTools::GetOffersIBlock($arResult["IBLOCK_ID"]);
	$OFFERS_IBLOCK_ID = is_array($arOffersIblock)? $arOffersIblock["OFFERS_IBLOCK_ID"]: 0;
	if ($OFFERS_IBLOCK_ID > 0)
	{
		$dbOfferProperties = CIBlock::GetProperties($OFFERS_IBLOCK_ID, Array(), Array("!XML_ID" => "CML2_LINK"));
		$arIblockOfferProps = array();
		$offerPropsExists = false;
		while($arOfferProperties = $dbOfferProperties->Fetch())
		{
			if (!in_array($arOfferProperties["CODE"],$arParams["OFFERS_PROPERTY_CODE"]))
				continue;
			$arIblockOfferProps[] = array("CODE" => $arOfferProperties["CODE"], "NAME" => $arOfferProperties["NAME"]);
			$arIblockOfferProps2[] = array("CODE" => "SKU_".$arOfferProperties["CODE"], "NAME" => $arOfferProperties["NAME"]);
			$offerPropsExists = true;
		}
	}
	/* -- SKU */
	$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
	$arNotify = unserialize($notifyOption);
	foreach($arResult["ITEMS"] as $cell=>$arElement)
	{
		$arResult["ITEMS"][$cell]["DELETE_COMPARE_URL"] = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=DELETE_FROM_COMPARE_LIST&id=".$arElement["ID"], array("action", "id")));
		if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])) //Product has offers
		{
			$arSku = array();
			$minItemPrice = 0;
			$minItemPriceFormat = "";
			$arResult["ITEMS"][$cell]["OFFERS_CATALOG_QUANTITY"] = 0;
			
			foreach($arElement["OFFERS"] as $arOffer)
			{
				$arResult["ITEMS"][$cell]["OFFERS_CATALOG_QUANTITY"]  += $arOffer["CATALOG_QUANTITY"];
				
				foreach($arOffer["PRICES"] as $code=>$arPrice)
				{
					if($arPrice["CAN_ACCESS"])
					{
						if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
						{
							$minOfferPrice = $arPrice["DISCOUNT_VALUE"];
							$minOfferPriceFormat = $arPrice["PRINT_DISCOUNT_VALUE"];
						}
						else
						{
							$minOfferPrice = $arPrice["VALUE"];
							$minOfferPriceFormat = $arPrice["PRINT_VALUE"];
						}

						if ($minItemPrice > 0 && $minOfferPrice < $minItemPrice)
						{
							$minItemPrice = $minOfferPrice;
							$minItemPriceFormat = $minOfferPriceFormat;
						}
						elseif ($minItemPrice == 0)
						{
							$minItemPrice = $minOfferPrice;
							$minItemPriceFormat = $minOfferPriceFormat;
						}
					}
				}
				/*foreach($arElement["PRICES"] as $key=>$price)
				{
					if ($price["VALUE"] < $minItemPrice)
					{
						$minItemPrice = $price["VALUE"];
						$minItemPriceFormat = $price["PRINT_VALUE"];
					}
				}*/
	/*SKU -- */
				$arSkuTmp = array();
				if ($offerPropsExists)
				{
					foreach($arIblockOfferProps as $key2 => $arCode)
					{
						if (!array_key_exists($arCode["CODE"], $arOffer["PROPERTIES"]))
						{
							$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
							continue;
						}
						if (empty($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
							$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
						elseif (is_array($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
							$arSkuTmp[] = implode("/", $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]);
						else
							$arSkuTmp[] = $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"];
					}
				}
				else
				{
					if (in_array("NAME", $arParams["OFFERS_FIELD_CODE"]))
						$arSkuTmp[] = $arOffer["NAME"];
					else
						break;
				}
				$arSkuTmp["ID"] = $arOffer["ID"];
				if (is_array($arOffer["PRICES"][$basePriceTypeName]))
				{
					if ($arOffer["PRICES"][$basePriceTypeName]["DISCOUNT_VALUE"] < $arOffer["PRICES"][$basePriceTypeName]["VALUE"])
					{
						$arSkuTmp["PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_VALUE"];
						$arSkuTmp["DISCOUNT_PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_DISCOUNT_VALUE"];
					}
					else
					{
						$arSkuTmp["PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_VALUE"];
						$arSkuTmp["DISCOUNT_PRICE"] = "";
					}
				}
				if (CModule::IncludeModule('sale'))
				{
					$dbBasketItems = CSaleBasket::GetList(
						array(
							"ID" => "ASC"
						),
						array(
							"PRODUCT_ID" => $arOffer['ID'],
							"FUSER_ID" => CSaleBasket::GetBasketUserID(),
							"LID" => SITE_ID,
							"ORDER_ID" => "NULL",
						),
						false,
						false,
						array()
					);
					$arSkuTmp["CART"] = "";
					if ($arBasket = $dbBasketItems->Fetch())
					{
						if($arBasket["DELAY"] == "Y")
							$arSkuTmp["CART"] = "delay";
						elseif ($arBasket["SUBSCRIBE"] == "Y" &&  $arNotify[SITE_ID]['use'] == 'Y')
							$arSkuTmp["CART"] = "inSubscribe";
						else
							$arSkuTmp["CART"] = "inCart";
					}
				}
				$arSkuTmp["CAN_BUY"] = $arOffer["CAN_BUY"];
				$arSkuTmp["ADD_URL"] = htmlspecialcharsback($arOffer["ADD_URL"]);
				$arSkuTmp["SUBSCRIBE_URL"] = htmlspecialcharsback($arOffer["SUBSCRIBE_URL"]);
				$arSkuTmp["COMPARE"] = "";
				if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$arOffer["ID"]]))
					$arSkuTmp["COMPARE"] = "inCompare";
				$arSkuTmp["COMPARE_URL"] = htmlspecialcharsback($arOffer["COMPARE_URL"]);
				$arSku[] = $arSkuTmp;
	/* -- SKU*/
			}
			if ($minItemPrice > 0)
			{
				$arResult["ITEMS"][$cell]["MIN_PRODUCT_OFFER_PRICE"] = $minItemPrice;
				$arResult["ITEMS"][$cell]["MIN_PRODUCT_OFFER_PRICE_PRINT"] = $minItemPriceFormat;
			}
			if ((!is_array($arIblockOfferProps2) || empty($arIblockOfferProps2)) && is_array($arSku) && !empty($arSku))
				$arIblockOfferProps2[] = array("CODE" => "TITLE", "NAME" => GetMessage("CATALOG_OFFER_NAME"));
			$arResult["ITEMS"][$cell]["SKU_ELEMENTS"] = $arSku;
			$arResult["ITEMS"][$cell]["SKU_PROPERTIES"] = $arIblockOfferProps2;
		}
	}

	if (strtoupper($arParams["ELEMENT_SORT_FIELD"])=="PROPERTY_".$arParams["MATCHING_ELEMENT_PROPERTIES"]["PROIZVODITEL"])
	{
	
	
		//сортировка по свойству производитель
		$arManufacturers = array();
		foreach($arResult["ITEMS"] as $key => $arItem)
		{ 
			if (!in_array($arManufacturers, $arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["PROIZVODITEL"]]["VALUE"]) 
				&& trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["PROIZVODITEL"]]["VALUE"])) 
			{ 
				$arManufacturers[] = $arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["PROIZVODITEL"]]["VALUE"]; 
			} 
		}
		$arManufacturers = array_unique($arManufacturers);
		
		$arItemsByManufacturer = array();
		foreach($arResult["ITEMS"] as $key => $arItem)
		{
			foreach ( $arManufacturers as $i => $manufacturer)
			{
				if (trim($arItem["PROPERTIES"][$arParams["MATCHING_ELEMENT_PROPERTIES"]["PROIZVODITEL"]]["VALUE"]) == trim($manufacturer))
				{
					if (empty($arItemsByManufacturer[$i]) || !is_array($arItemsByManufacturer[$i])) 
					{ 
						$arItemsByManufacturer[$i] = array();
						$arItemsByManufacturer[$i]["NAME"] = $manufacturer; 
					}
					$arItemsByManufacturer[$i]["ITEMS"][] = $arItem;
				}
			}
		}
		$arResult["ITEMS_BY_MANUFACTURER"] = $arItemsByManufacturer;
	
	
	
		/*
		//сортировка по родительскому разделу
		//получаем id разделов элеметов текущей страницы
		$arSectionsID = array();
		foreach($arResult["ITEMS"] as $key => $arItem)
		{ if (!in_array($arSectionsID, $arItem["IBLOCK_SECTION_ID"])) { $arSectionsID[] = $arItem["IBLOCK_SECTION_ID"]; } }
		
		//получаем depth level и названия этих разделов
		$arSections = array();
		$db_res = CIBlockSection::GetList(Array("SORT"=>"ASC"),  Array("ID"=>$arSectionsID),  false,  Array("ID", "NAME", "SORT", "IBLOCK_SECTION_ID", "DEPTH_LEVEL"), false);
		while ($res = $db_res->GetNext()) { $arSections[] = $res; }

		//вдруг моделей нет?
		$only_parents = true;
		foreach ($arSections as $key=>$section) { if ($section["DEPTH_LEVEL"]!=1) { $only_parents = false; break; } }
		
		$arElementsParentSections = array(); //тут будет лежать массив с производителями
		
		if (!$only_parents) //модели есть, будем разбирать по производителям :-(
		{
			//получаем названия производителей (разделы первого уровня)
			$arParentSections = array();
			$db_res = CIBlockSection::GetList(Array("SORT"=>"ASC"),  Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "DEPTH_LEVEL"=>1, "ACTIVE"=>"Y"),  false,  Array("ID", "NAME", "SORT"), false);
			while ($res = $db_res->GetNext()) { $arParentSections[] = $res; }
			
			//сортируем разделы в адекватный массив
			$arElementsParentSections = array();
			foreach ($arSections as $key=>$section)
			{
				if ($section["DEPTH_LEVEL"]=="1") //если это итак производитель
				{
					//тогда записываем его в результирующий массив
					if (!in_array($arElementsParentSections, $section)) { $arElementsParentSections[$section["ID"]] = $section; }
				}
				elseif ($section["DEPTH_LEVEL"]=="2") //если это модель
				{
					//тогда ищем какого производителя это модель и записываем её туда
					foreach ($arParentSections as $k=>$v)
					{
						if ($section["IBLOCK_SECTION_ID"] == $v["ID"])
						{
							if (!$arElementsParentSections[$v["ID"]]["NAME"]) { $arElementsParentSections[$v["ID"]]["NAME"]  = $v["NAME"]; }
							$arElementsParentSections[$v["ID"]]["SECTIONS"][] = $section;
						}
					}
				}
			}
		}
		else 
		{ 
			foreach ($arSections as $key => $value) 
			{ $arElementsParentSections[$value["ID"]] = $value; }
		}
		
		//echo var_dump($arElementsParentSections); //готовый массив с производителями и возможно моделями

		//отсортируем товары по производителям
		$arItemsByManufacturer = array();
		foreach($arResult["ITEMS"] as $key => $arItem)
		{
			foreach ( $arElementsParentSections as $i => $val)
			{
				if ($arItem["IBLOCK_SECTION_ID"] == $i)
				{
					if (empty($arItemsByManufacturer[$i])) { $arItemsByManufacturer[$i] = $val; }
					$arItemsByManufacturer[$i]["ITEMS"][] = $arItem;
				}
				else
				{
					foreach ($val["SECTIONS"] as $j=>$v)
					{
						if ($arItem["IBLOCK_SECTION_ID"] == $v["ID"])
						{
							if (empty($arItemsByManufacturer[$i])) {$arItemsByManufacturer[$i] = $val; }
							$arItemsByManufacturer[$i]["ITEMS"][] = $arItem;
						}
					}
				}
			}
		}
		
		//echo var_dump($arItemsByManufacturer); //готовый массив с товарами, разделенными по производителям
		$arResult["ITEMS_BY_MANUFACTURER"] = $arItemsByManufacturer;	*/
	} else { $arResult["ITEMS_BY_MANUFACTURER"][]["ITEMS"] = $arResult["ITEMS"];	}
?>