<?
$_SERVER["DOCUMENT_ROOT"] = "/var/www/vhosts/shinleader.ru/httpdocs";
define("STOP_STATISTICS", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
Cmodule::IncludeModule('iblock');
Cmodule::IncludeModule('catalog');
$sect = new CIBlockSection;
$el = new CIBlockElement;
global $USER;
global $APPLICATION;
$arResult = array();
$arParamsTranslate = array("replace_space"=>"-","replace_other"=>"-");

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/xml.php');
$strQueryText = QueryGetData(
	"www.shinservice.ru",
	'443',
	"/xml/shinservice-b2b.xml?id=88929572",
	false,
	$error_number,
	$error_text,
	"GET",
	"ssl://"
);

$file = $_SERVER["DOCUMENT_ROOT"]."/upload/shinservice-b2b.xml";
if (!$strQueryText && file_exists($file)) {
	$strQueryText = file_get_contents($file);
}
if (!$strQueryText) {
	$arResult["ERROR"] = "Сервис временно недоступен";
}


if (empty($arResult["ERROR"])) {
	file_put_contents($file, $strQueryText);
	$xml = new SimpleXMLElement($file, false, true);

	// проход по типам товара
	foreach ($xml as $prodType => $prodCat) {
		// для того, чтобы сослаться на тип товара (tyre, wheel) отсекаем последнюю 's' у группы товаров
		$prodType = substr($prodType, 0, -1);
		
		// проход по товарам
		foreach ($prodCat->$prodType as $prod) {
			// проходим по атрибутам, вписываем во временную переменную с переводом ключа в верхний регистр для удобства
			foreach ($prod->attributes() as $attr => $value) {
				$arTmpAttr[strtoupper((string)$attr)] = (string)$value;
			}
			// записываем массив атрибутов в элемент
			if ($prodType == "wheel") {
				$arTmpAttr["SIZE"] = explode(" / ", $arTmpAttr["SIZE"]); // для дисков надо разделить размер на две составляющие
				$arTmpAttr["SIZE"][1] = str_replace("J", "", $arTmpAttr["SIZE"][1]);
			}
			$arResult[strtoupper($prodType)."S"][$arTmpAttr["BRAND"]][$arTmpAttr["MODEL"]][$arTmpAttr["ID"]] = $arTmpAttr;
			
			// удаляем временную переменную
			unset($arTmpAttr);
		}
	}
	
	// Проход по каталогам. Ключ - тип каталога
	foreach ($arResult as $catalogType => $arCatalog) {
		// Для каждого каталога определяем ID инфоблока
		if ($catalogType == "TIRES") {
			$IBLOCK_ID = 1;
		} else if ($catalogType == "WHEELS") {
			$IBLOCK_ID = 2;
		}
		
		// Проход по производителям. Ключ - название брэнда
		foreach ($arCatalog as $brandName => $arBrand) {
			// Ищем раздел по названию
			$arBrandOrder = array();
			$arBrandFilter = array("IBLOCK_ID" => $IBLOCK_ID, "NAME" => $brandName);
			$arBrandSelect = array("ID", "NAME");
			
			$res = CIBlockSection::GetList($arBrandOrder, $arBrandFilter, false, $arBrandSelect, false);
			// Если находим, то записываем во временную переменную его ID
			if ($arRes = $res->GetNext())
			{
				$arBrandSectionID = $arRes["ID"];
			// Если нет, то создаём новый раздел. И записываем его ID во временную переменную
			} else {
				$trans = Cutil::translit(strtolower(str_replace("+", " plus ", $brandName)),"ru",$arParamsTranslate);
				$arBrandFields = Array(
					"ACTIVE" => "Y",
					"IBLOCK_ID" => $IBLOCK_ID,
					"NAME" => $brandName,
					"CODE" => $trans
				);
				
				if ($brandID = $sect->Add($arBrandFields)) {
					echo 'Брэнд создан '.$brandName.' ID: '.$brandID.'<br>';
					$arBrandSectionID = $brandID;
				} else {
					echo '<span style="color:#ff0000;">Ошибка при создании брэнда ('.$brandName.'): '.$sect->LAST_ERROR.'</span><br>';
					continue;
				}
				
			}
			
			// Проход по моделям. Ключ - название модели
			foreach ($arBrand as $modelName => $arModel) {
				
				// Модели нужны только в шинах
				if ($catalogType == "TIRES") {
					// Ищем раздел по названию
					$arModelOrder = array();
					$arModelFilter = array("IBLOCK_ID" => $IBLOCK_ID, "SECTION_ID" => $arBrandSectionID, "NAME" => $modelName);
					$arModelSelect = array("ID", "NAME");
					
					$res2 = CIBlockSection::GetList($arModelOrder, $arModelFilter, false, $arModelSelect, false);
					// Если находим, то записываем во временную переменную его ID
					if ($arRes2 = $res2->GetNext())
					{
						$arModelSectionID = $arRes2["ID"];
					// Если нет, то создаём новый раздел. И записываем его ID во временную переменную
					} else {
						$trans = Cutil::translit(strtolower(str_replace("+", " plus ", $modelName)),"ru",$arParamsTranslate);
						$arModelFields = Array(
							"ACTIVE" => "Y",
							"IBLOCK_ID" => $IBLOCK_ID,
							"IBLOCK_SECTION_ID" => $arBrandSectionID,
							"NAME" => $modelName,
							"CODE" => $trans
						);						
						
						if ($modelID = $sect->Add($arModelFields)) {
							echo 'Модель создана (в разделе '.$brandName.') '.$modelName.' ID: '.$modelID.'<br>';
							$arModelSectionID = $modelID;
						} else {
							echo '<span style="color:#ff0000;">Ошибка при создании модели  (в разделе '.$brandName.') '.$modelName.': '.$sect->LAST_ERROR.'</span><br>';
							continue;
						}
					}
				}
				
				
							
				// Проход по товарам
				foreach ($arModel as $code => $arElement) {					
					// Задаём переменные для полей
					if ($arElement["STOCK"] > 4) {
						$PRODUCT_QUANTITY = $arElement["STOCK"];
					} else {
						$PRODUCT_QUANTITY = 0;
					}
					
					$PRODUCT_PURCHASING_PRICE = (int)$arElement["PRICE"];
					$PRODUCT_PRICE_TYPE_ID = 1;
					
					$RETAIL_PRICE = (int)$arElement["RETAIL_PRICE"];
					$STICKER_PRICE = (int)$arElement["STICKER_PRICE"];
					$PRODUCT_PRICE = 0;
					
					if ($RETAIL_PRICE > 12000) {
						$PRODUCT_PRICE = $RETAIL_PRICE - 400;
					} elseif ($RETAIL_PRICE > 8000) {
						$PRODUCT_PRICE = $RETAIL_PRICE - 300;
					} elseif ($RETAIL_PRICE > 6000) {
						$PRODUCT_PRICE = $RETAIL_PRICE - 200;
					} elseif ($RETAIL_PRICE > 4000) {
						$PRODUCT_PRICE = $RETAIL_PRICE - 130;
					} elseif ($RETAIL_PRICE > 3000) {
						$PRODUCT_PRICE = $RETAIL_PRICE - 100;
					} else {
						$PRODUCT_PRICE = $RETAIL_PRICE + 50;
					}
					
					if ($PRODUCT_PRICE < $STICKER_PRICE) {
						$PRODUCT_PRICE = $STICKER_PRICE;
					}
					
					if (empty($arElement["RETAIL_PRICE"]) || $arElement["RETAIL_PRICE"] == 0) {
						$PRODUCT_QUANTITY = 0;
					}
					
					if ($catalogType == "TIRES") {
						$PRODUCT_NAME = $arElement["BRAND"]." ".$arElement["MODEL"]." ".$arElement["WIDTH"]."/".$arElement["PROFILE"]." ".$arElement["DIAM"]." ".$arElement["LOAD"].$arElement["SPEED"].($arElement["RUNFLAT"]?" Runflat":"");
					} else if ($catalogType == "WHEELS") {
						$PRODUCT_NAME = $arElement["TYPE"]." ".$arElement["BRAND"]." ".$arElement["MODEL"]." ".$arElement["SIZE"][0]." / ".$arElement["SIZE"][1]."J PCD ".$arElement["BP"]."x".$arElement["PCD"]." ЦО ".$arElement["CENTERBORE"]." Вылет ".$arElement["ET"];
					}
					
					/*if ($catalogType == "TIRES") {
						if ($PRODUCT_PURCHASING_PRICE > 2500) {
							$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*12+$PRODUCT_PURCHASING_PRICE;
						} else {
							$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*15+$PRODUCT_PURCHASING_PRICE;
						}
						$PRODUCT_NAME = $arElement["BRAND"]." ".$arElement["MODEL"]." ".$arElement["WIDTH"]."/".$arElement["PROFILE"]." ".$arElement["DIAM"]." ".$arElement["LOAD"].$arElement["SPEED"].($arElement["RUNFLAT"]?" Runflat":"");
					} else if ($catalogType == "WHEELS") {
						if ($PRODUCT_PURCHASING_PRICE > 2500) {
							$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*10+$PRODUCT_PURCHASING_PRICE;
						} else {
							$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*13+$PRODUCT_PURCHASING_PRICE;
						}
						$PRODUCT_NAME = $arElement["TYPE"]." ".$arElement["BRAND"]." ".$arElement["MODEL"]." ".$arElement["SIZE"][0]." / ".$arElement["SIZE"][1]."J PCD ".$arElement["BP"]."x".$arElement["PCD"]." ЦО ".$arElement["CENTERBORE"]." Вылет ".$arElement["ET"];
					}*/
					
					
					
					// Ищем элемекнт по коду товара (внешний код элемента)
					$arItemOrder = array();
					$arItemFilter = array("IBLOCK_ID" => $IBLOCK_ID, "XML_ID" => $code);
					$arItemSelect = array("ID", "NAME", "XML_ID");
					
					$res3 = CIBlockElement::GetList($arItemOrder, $arItemFilter, false, false, $arItemSelect);
					
					// Если находим элемент, определяем его ID
					if ($arRes3 = $res3->GetNext())
					{
						$PRODUCT_ID = $arRes3["ID"];
					// Если элемент не находим, то создаём новый
					} else {
						if ($arElement["SEASON"] == "S") {
							$tireSeason = "1";
						} else {
							$tireSeason = "2";
						}
						$PROP = array();
						
						if ($catalogType == "TIRES") {
							$PROP["SEZONNOST"] = array("VALUE" => $tireSeason);
							$PROP["PROIZVODITEL"] = $arElement["BRAND"];
							$PROP["MODEL_AVTOSHINY"] = $arElement["MODEL"];
							$PROP["SHIRINA_PROFILYA"] = $arElement["WIDTH"];
							$PROP["VYSOTA_PROFILYA"] = $arElement["PROFILE"];
							$PROP["POSADOCHNYY_DIAMETR"] = $arElement["DIAM"];
							$PROP["INDEKS_NAGRUZKI"] = $arElement["LOAD"];
							$PROP["INDEKS_SKOROSTI"] = $arElement["SPEED"];
							if ($arElement["PIN"]) {
								$PROP["SHIPY"] = array("VALUE" => 3);
							}							
							
							if ($arElement["RUNFLAT"]) {
								$PROP["RUNFLAT"] = array("VALUE" => 28);
							}
						} else {
							$PROP["PROIZVODITEL"] = $arElement["BRAND"];
							$PROP["MODEL_DISKA"] = $arElement["MODEL"];
							$PROP["COUNT_OTVERSTIY"] = $arElement["BP"];
							$PROP["MEZHBOLTOVOE_RASSTOYANIE"] = $arElement["PCD"];
							$PROP["VYLET_DISKA"] = $arElement["ET"];
							$PROP["DIAMETR_STUPITSY"] = $arElement["CENTERBORE"];
							$PROP["POSADOCHNYY_DIAMETR_DISKA"] = $arElement["SIZE"][0];
							$PROP["SHIRINA_DISKA"] = $arElement["SIZE"][1];
						}
						$PROP["PRODUCT_CODE"] = $code;
						$PROP["CML2_ARTICLE"] = $arElement["SKU"];

						$trans = Cutil::translit(strtolower($code),"ru",$arParamsTranslate);
						$arElementFields = Array(
							"IBLOCK_SECTION_ID" => $catalogType == "TIRES"?$arModelSectionID:$arBrandSectionID,
							"IBLOCK_ID"      => $IBLOCK_ID,
							"NAME"           => $PRODUCT_NAME,
							"XML_ID"		 => $code,
							"ACTIVE"         => "Y",
							"PROPERTY_VALUES" => $PROP,
							"CODE" => $trans
						);
						
						if ($PRODUCT_ID = $el->Add($arElementFields)) {
							echo 'Товар создан (в разделе '.$brandName.' '.$modelName.') '.$PRODUCT_NAME.' ID: '.$PRODUCT_ID.'<br>';
						} else {
							echo '<span style="color:#ff0000;">Ошибка при создании товара (в разделе '.$brandName.' '.$modelName.') '.$PRODUCT_NAME.': '.$el->LAST_ERROR.'</span><br>';
							continue;
						}
					}
					
					// Собираем массив для товара
					$arProductFields = array(
						"ID" => $PRODUCT_ID,
						"QUANTITY" => $PRODUCT_QUANTITY,
						"PURCHASING_PRICE" => $PRODUCT_PURCHASING_PRICE,
						"PURCHASING_CURRENCY" => "RUB"
					);
					// Обновляем товар
					CCatalogProduct::Add($arProductFields);
					
					// Собираем массив для цены
					$arPriceFields = Array(
						"PRODUCT_ID" => $PRODUCT_ID,
						"CATALOG_GROUP_ID" => $PRODUCT_PRICE_TYPE_ID,
						"PRICE" => $PRODUCT_PRICE,
						"CURRENCY" => "RUB",
						"QUANTITY_FROM" => false,
						"QUANTITY_TO" => false
					);
					
					// Смотрим задана ли уже цена
					$res4 = CPrice::GetList(
						array(),
						array(
							"PRODUCT_ID" => $PRODUCT_ID,
							"CATALOG_GROUP_ID" => $PRODUCT_PRICE_TYPE_ID
						)
					);
		
					// Если задана, обновляем, иначе добавляем новую
					if ($arRes4 = $res4->Fetch())
					{
						CPrice::Update($arRes4["ID"], $arPriceFields);
					} else {
						CPrice::Add($arPriceFields);
					}				
				}
			}
		}		
	}
			
	//echo "<pre>";
	//print_r($arResult);
	//echo "</pre>";			
}
?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>