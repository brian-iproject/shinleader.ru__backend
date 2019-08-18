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
			
			/*if ($prodType == "wheel") {
				$arTmpAttr["SIZE"] = explode(" / ", $arTmpAttr["SIZE"]); // для дисков надо разделить размер на две составляющие
				$arTmpAttr["SIZE"][1] = str_replace("J", "", $arTmpAttr["SIZE"][1]);
			}*/
			
			$arResult[strtoupper($prodType)."S"][$arTmpAttr["ID"]] = $arTmpAttr;
			
			// удаляем временную переменную
			unset($arTmpAttr);
		}
	}
	
	$iblockArray = array("TIRES"=>1, "WHEELS"=>2);
	
	foreach ($iblockArray as $catalogType => $iblock_id) {
	
		$arItemOrder = array();
		$arItemFilter = array("IBLOCK_ID" => $iblock_id);
		$arItemSelect = array("ID", "NAME", "XML_ID");
		
		$res = CIBlockElement::GetList($arItemOrder, $arItemFilter, false, false, $arItemSelect);
		
		// Если находим элемент, определяем его ID
		while ($arRes = $res->GetNext())
		{		
			$PRODUCT_ID = $arRes["ID"];
			
			if ($arResult[$catalogType][$arRes["XML_ID"]]) {
				$arElement = $arResult[$catalogType][$arRes["XML_ID"]];
				
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
					$PRODUCT_PRICE = 0;
				}
				
				/*if ($catalogType == "TIRES") {
					if ($PRODUCT_PURCHASING_PRICE > 2500) {
						$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*12+$PRODUCT_PURCHASING_PRICE;
					} else {
						$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*15+$PRODUCT_PURCHASING_PRICE;
					}
				} else if ($catalogType == "WHEELS") {
					if ($PRODUCT_PURCHASING_PRICE > 2500) {
						$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*10+$PRODUCT_PURCHASING_PRICE;
					} else {
						$PRODUCT_PRICE = $PRODUCT_PURCHASING_PRICE/100*13+$PRODUCT_PURCHASING_PRICE;
					}
				}*/
					
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
				$res2 = CPrice::GetList(
					array(),
					array(
						"PRODUCT_ID" => $PRODUCT_ID,
						"CATALOG_GROUP_ID" => $PRODUCT_PRICE_TYPE_ID
					)
				);
	
				// Если задана, обновляем, иначе добавляем новую
				if ($arRes2 = $res2->Fetch())
				{
					CPrice::Update($arRes2["ID"], $arPriceFields);
				} else {
					CPrice::Add($arPriceFields);
				}


				CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("CML2_ARTICLE" => $arElement["SKU"]));
			} else {
				$PRODUCT_QUANTITY = 0;
				
				// Собираем массив для товара
				$arProductFields = array(
					"ID" => $PRODUCT_ID,
					"QUANTITY" => $PRODUCT_QUANTITY,
					"PURCHASING_CURRENCY" => "RUB"
				);
				// Обновляем товар
				CCatalogProduct::Add($arProductFields);


				CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("CML2_ARTICLE" => ""));
			}
		}
	}		
}
?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>