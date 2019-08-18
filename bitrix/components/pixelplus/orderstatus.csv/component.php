<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();	

if (!$arParams['FILE_URL']) {
	$arResult['ERROR'][] = "Ошибка! Файл не указан в параметрах компонента.";
} else {
	if (!is_file($_SERVER['DOCUMENT_ROOT'].$arParams['FILE_URL'])) {
		$arResult['ERROR'][] = "Ошибка! Файл не найден.";
	} else {
		$filename = trim($arParams['FILE_URL'], ". \r\n\t");
		$arr = explode(".", $filename);
		$ext = strtoupper($arr[count($arr)-1]);
		if ($ext != "CSV") {
			$arResult['ERROR'][] = "Ошибка! Файл не является файлом формата csv.";
		}
	}
}

if (!$arResult['ERROR']) {

	$fields_type = "R"; //разделитель F - фиксирован.
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
	$csvFile = new CCSVData();
	$csvFile->LoadFile($_SERVER['DOCUMENT_ROOT'].$arParams['FILE_URL']);			
	$csvFile->SetFieldsType($fields_type);
	$csvFile->SetFirstHeader(true); //первая строка заголовки
	$csvFile->SetDelimiter(";");
	while ($arCsvData = $csvFile->Fetch()) {
		foreach ($arCsvData as &$field) {
			$field = CUtil::ConvertToLangCharset($field);
		}
		$arCsvItems[$arCsvData[1]] = $arCsvData;
	}
	Cmodule::IncludeModule('iblock');
	$el = new CIBlockElement;

	debugmessage($arCsvItems);

	foreach($arCsvItems as $xmlID => $arItem) {
		$PRODUCT_NAME = $arItem[10]." ".$arItem[0]." ".$arItem[2]." ".$arItem[4]." / ".$arItem[3]."J PCD ".$arItem[5]."x".$arItem[6]." ЦО ".$arItem[9]." Вылет ".$arItem[8];


		$PROP["PROIZVODITEL"] = $arItem[0];
		$PROP["MODEL_DISKA"] = $arItem[2];
		$PROP["COUNT_OTVERSTIY"] = $arItem[5];
		$PROP["MEZHBOLTOVOE_RASSTOYANIE"] = $arItem[6];
		$PROP["VYLET_DISKA"] = $arItem[8];
		$PROP["DIAMETR_STUPITSY"] = $arItem[9];
		$PROP["POSADOCHNYY_DIAMETR_DISKA"] = $arItem[4];
		$PROP["SHIRINA_DISKA"] = $arItem[3];
		$PROP["PRODUCT_CODE"] = $arItem[1];
		$PROP["CML2_ARTICLE"] = $arItem[1];

		$arParamsTranslate = array("replace_space"=>"-","replace_other"=>"-");
		$trans = Cutil::translit(strtolower($arItem[1]),"ru",$arParamsTranslate);

		$arElementFields = Array(
			"IBLOCK_ID"      => 12,
			"NAME"           => $PRODUCT_NAME,
			"XML_ID"		 => $arItem[1],
			"ACTIVE"         => "Y",
			"PROPERTY_VALUES" => $PROP,
			"CODE" => $trans,
			"DETAIL_PICTURE" => CFile::MakeFileArray($arItem[15])
		);

		if ($PRODUCT_ID = $el->Add($arElementFields)) {
			echo 'Товар создан (в разделе '.$brandName.' '.$modelName.') '.$PRODUCT_NAME.' ID: '.$PRODUCT_ID.'<br>';
		} else {
			echo '<span style="color:#ff0000;">Ошибка при создании товара (в разделе '.$brandName.' '.$modelName.') '.$PRODUCT_NAME.': '.$el->LAST_ERROR.'</span><br>';
			continue;
		}
	}
}

$this->IncludeComponentTemplate();
?>