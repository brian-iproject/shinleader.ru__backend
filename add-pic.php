<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<?
$file_list = scandir($_SERVER["DOCUMENT_ROOT"]."/upload/new-site-pic/nz/");

if (!empty($file_list)) {
    $arArticleList = array();
    foreach ($file_list as &$file) {
        $file = explode(".", $file);
        if ($file[1] == "png") {
            $arArticleList[] = $file[0];
			$model = explode("_", $file[0]);
            $arFileList[ToUpper($model[0])] = $_SERVER["DOCUMENT_ROOT"] . "/upload/new-site-pic/nz/" . $file[0] . "." . $file[1];
        }
    }
	debugmessage($arFileList);
    if (CModule::IncludeModule("iblock")) {
        $el = new CIBlockElement;

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PICTURE", "PROPERTY_MODEL_DISKA");
        $arFilter = Array("IBLOCK_ID" => 2, "DETAIL_PICTURE" => false);
        $res = $el->GetList(Array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arRes = $ob->GetFields();

            $arItems[] = $arRes;
			if ($arFileList[$arRes["PROPERTY_MODEL_DISKA_VALUE"]]) {
				$arFieldArray = array(
					"DETAIL_PICTURE" => CFile::MakeFileArray($arFileList[$arRes["PROPERTY_MODEL_DISKA_VALUE"]])
				);
			
				$res2 = $el->Update($arRes["ID"], $arFieldArray, false, true, true);
				echo $arRes["NAME"] . "<br>";
			}
        }
    }
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>