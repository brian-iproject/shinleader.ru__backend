<?
$_SERVER["DOCUMENT_ROOT"] = "/var/www/vhosts/shinleader.ru/httpdocs";
define("STOP_STATISTICS", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
$strTmpCat = "";
$strTmpOff = "";

$strAll = '<?$disableReferers = false;';
$strAll .= "\n";
$strAll .= 'if (!isset($_GET["referer1"]) || strlen($_GET["referer1"])<=0) $_GET["referer1"] = "yandext";';
$strAll .= "\n";
$strAll .= '$strReferer1 = htmlspecialchars($_GET["referer1"]);';
$strAll .= "\n";
$strAll .= 'if (!isset($_GET["referer2"]) || strlen($_GET["referer2"])<=0) $_GET["referer2"] = "";';
$strAll .= "\n";
$strAll .= '$strReferer2 = htmlspecialchars($_GET["referer2"]);';
$strAll .= "\n";
$strAll .= 'header("Content-Type: text/xml; charset=windows-1251");?>';
$strAll .= "\n";
$strAll.= '<?echo "<?xml version=\"1.0\" encoding=\"windows-1251\"?>"?>';
$strAll .= "\n<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n";
$strAll .= "<yml_catalog date=\"".date("Y-m-d H:i")."\">\n";
$strAll .= "<shop>\n";
$strAll .= "<name>".$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString("main", "site_name", "")), LANG_CHARSET, 'windows-1251')."</name>\n";
$strAll .= "<company>".$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString("main", "site_name", "")), LANG_CHARSET, 'windows-1251')."</company>\n";
$strAll .= "<url>http://".htmlspecialcharsbx(COption::GetOptionString("main", "server_name", ""))."</url>\n";
$strAll .= "<platform>1C-Bitrix</platform>\n";


$strTmpCat = "<category id=\"1\">Авто</category>\n";
$strTmpCat .= "<category id=\"2\" parentId=\"1\">Шины и диски</category>\n";
$strTmpCat .= "<category id=\"3\" parentId=\"2\">Шины</category>\n";
$strTmpCat .= "<category id=\"4\" parentId=\"2\">Колесные диски</category>\n";
$strTmpCat .= "<category id=\"5\" parentId=\"1\">Масла и технические жидкости</category>\n";

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL","DETAIL_PICTURE","CATALOG_GROUP_1","PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>array(1,2,11,12), "ACTIVE"=>"Y", "CATALOG_AVAILABLE"=>"Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($arRes = $res->GetNextElement()){
    $arFields = $arRes->GetFields();
    $arProps = $arRes->GetProperties();


    $res2 = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
    if ($arRes2 = $res2->GetNext()) {
        $arSection = $arRes2;
    }

    $strTmpOff .= "<offer id=\"".$arFields["ID"]."\" available=\"true\">\n";

    $strTmpOff .= "<url>http://".SITE_SERVER_NAME.htmlspecialcharsbx($arFields["DETAIL_PAGE_URL"]).(strstr($arFields['DETAIL_PAGE_URL'], '?') === false ? '?' : '&amp;')."r1=<?echo \$strReferer1; ?>&amp;r2=<?echo \$strReferer2; ?></url>\n";
    $GetOptimalPrice = CCatalogProduct::GetOptimalPrice($arFields["ID"]);
    $arFields["ROUND_PRICE"] = $GetOptimalPrice["DISCOUNT_PRICE"];
    unset($GetOptimalPrice);
    $strTmpOff .= "<price>".$arFields["ROUND_PRICE"]."</price>\n";

    //$strTmpOff .= "<currencyId>".$arFields["CATALOG_CURRENCY_1"]."</currencyId>\n";
    $strTmpOff .= "<currencyId>RUB</currencyId>\n";
    if ($arFields["IBLOCK_ID"] == 1) {
        $strTmpOff .= "<categoryId>3</categoryId>\n";
    } else if ($arFields["IBLOCK_ID"] == 2 || $arFields["IBLOCK_ID"] == 12) {
        $strTmpOff .= "<categoryId>4</categoryId>\n";
    } else if ($arFields["IBLOCK_ID"] == 11) {
        $strTmpOff .= "<categoryId>5</categoryId>\n";
    }
    if ($arFields["IBLOCK_ID"] == 1) {
        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
    } else if ($arFields["IBLOCK_ID"] == 2 || $arFields["IBLOCK_ID"] == 12) {
        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
    } else {
        $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
    }
    if ($arFields["DETAIL_PICTURE"]["SRC"]) {
        $strTmpOff .= "<picture>http://".SITE_SERVER_NAME.$arFields["DETAIL_PICTURE"]["SRC"]."</picture>\n";
    }
    if ($arFields["IBLOCK_ID"] == 11) {
        $strTmpOff .= "<vendor>MOTUL</vendor>\n";
    } else {
        $strTmpOff .= "<vendor>".$arProps["PROIZVODITEL"]["VALUE"]."</vendor>\n";
    }
    if ($arFields["IBLOCK_ID"] != 11) {
        $strTmpOff .= "<model>".$arSection["NAME"]."</model>\n";
    }
    $strTmpOff .= "<vendorCode>".$arProps["CML2_ARTICLE"]["VALUE"]."</vendorCode>\n";

    if ($arFields["IBLOCK_ID"] == 11) {
        $strTmpOff .= "<name>".str_replace("&", "&amp;", $arFields["NAME"])."</name>\n";
    } else {
        $strTmpOff .= "<name>".$arFields["NAME"]."</name>\n";
    }
    $strTmpOff .= "<description>".$arFields["PREVIEW_TEXT"]."</description>\n";
    if ($arFields["IBLOCK_ID"] == 1) {
        $strTmpOff .= "<param name=\"".$arProps["VYSOTA_PROFILYA"]["NAME"]."\">".$arProps["VYSOTA_PROFILYA"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["INDEKS_NAGRUZKI"]["NAME"]."\">".$arProps["INDEKS_NAGRUZKI"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["INDEKS_SKOROSTI"]["NAME"]."\">".$arProps["INDEKS_SKOROSTI"]["VALUE"]."</param>\n";
        if (!empty($arProps["RUNFLAT"]["VALUE"])) {
            $strTmpOff .= "<param name=\"".$arProps["RUNFLAT"]["NAME"]."\">".$arProps["RUNFLAT"]["VALUE"]."</param>\n";
        }
        $strTmpOff .= "<param name=\"".$arProps["POSADOCHNYY_DIAMETR"]["NAME"]."\">".$arProps["POSADOCHNYY_DIAMETR"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["SEZONNOST"]["NAME"]."\">".$arProps["SEZONNOST"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["SHIRINA_PROFILYA"]["NAME"]."\">".$arProps["SHIRINA_PROFILYA"]["VALUE"]."</param>\n";
    } else if ($arFields["IBLOCK_ID"] == 2 || $arFields["IBLOCK_ID"] == 12) {
        $strTmpOff .= "<param name=\"".$arProps["VYLET_DISKA"]["NAME"]."\">".$arProps["VYLET_DISKA"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["DIAMETR_STUPITSY"]["NAME"]."\">".$arProps["DIAMETR_STUPITSY"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["COUNT_OTVERSTIY"]["NAME"]."\">".$arProps["COUNT_OTVERSTIY"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["MEZHBOLTOVOE_RASSTOYANIE"]["NAME"]."\">".$arProps["MEZHBOLTOVOE_RASSTOYANIE"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["POSADOCHNYY_DIAMETR_DISKA"]["NAME"]."\">".$arProps["POSADOCHNYY_DIAMETR_DISKA"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["SHIRINA_DISKA"]["NAME"]."\">".$arProps["SHIRINA_DISKA"]["VALUE"]."</param>\n";
    } else if ($arFields["IBLOCK_ID"] == 11) {
        $strTmpOff .= "<param name=\"".$arProps["CAPACITY"]["NAME"]."\">".$arProps["CAPACITY"]["VALUE"]."</param>\n";
        $strTmpOff .= "<param name=\"".$arProps["OIL_TYPE"]["NAME"]."\">".ucfirst(strtolower($arProps["OIL_TYPE"]["VALUE"]))."</param>\n";
    }
    $strTmpOff .= "</offer>\n";
}

$strAll .= "<currencies>";
$strAll .= "<currency id=\"RUB\" rate=\"1\"/>";
$strAll .= "</currencies>";

$strAll .= "<categories>\n";
$strAll .= $strTmpCat;
$strAll .= "</categories>\n";

$strAll .= "<offers>\n";
$strAll .= $APPLICATION->ConvertCharset($strTmpOff, LANG_CHARSET, 'windows-1251');
$strAll .= "</offers>\n";

$strAll .= "</shop>\n";
$strAll .= "</yml_catalog>\n";

if ($fp = @fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/catalog_export/yandex-market.php", 'wb'))
{
    fwrite($fp, $strAll);
    fclose($fp);
}

unset($strTmpCat, $strTmpOff, $strAll);
?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
