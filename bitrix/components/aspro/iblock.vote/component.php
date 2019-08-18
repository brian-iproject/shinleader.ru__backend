<?
//Следуйте комментариям вида Число* для отслеживания пути исполнения.

//21*
//В случае AJAX запроса попадем сюда


if(!defined("B_PROLOG_INCLUDED") && isset($_REQUEST["AJAX_CALL"]) && $_REQUEST["AJAX_CALL"]=="Y")
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	//22*
	//Проверям: ключ подошел?
	if(CModule::IncludeModule("iblock"))
	{
		$arCache = CIBlockRSS::GetCache($_REQUEST["SESSION_PARAMS"]);
		if($arCache && ($arCache["VALID"] == "Y"))
		{
			//23*
			//Да!
			//Забираем параметры "подключения"
			$arParams = unserialize($arCache["CACHE"]);
			//18*
			//Добиваем теми, которые доступны "снаружи"
			foreach($arParams["PAGE_PARAMS"] as $param_name)
			{
				if(!array_key_exists($param_name, $arParams))
					$arParams[$param_name] = $_REQUEST["PAGE_PARAMS"][$param_name];
			}
			//24*
			//Эта магия позволяет нам правильно определить
			//текущий шаблон компонента (с учетом темы)
			if(array_key_exists("PARENT_NAME", $arParams))
			{
				$component = new CBitrixComponent();
				$component->InitComponent($arParams["PARENT_NAME"], $arParams["PARENT_TEMPLATE_NAME"]);
				$component->InitComponentTemplate($arParams["PARENT_TEMPLATE_PAGE"]);
			}
			else
			{
				$component = null;
			}
			
			//25*
			//Подключаем компонент
			//Результат его работы (div) заменит тот, что сейчас у клиента в браузере
			$APPLICATION->IncludeComponent($arParams["COMPONENT_NAME"], $arParams["TEMPLATE_NAME"], $arParams, $component);
		}
	}

	require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");
	die();
}

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}
/************************************************
	Processing of received parameters
*************************************************/
$arParams = array(
	"IBLOCK_ID" => intval($arParams["IBLOCK_ID"]),
	"ELEMENT_ID" => intval($arParams["ELEMENT_ID"]),
	"MAX_VOTE" => intval($arParams["MAX_VOTE"])<=0? 5: intval($arParams["MAX_VOTE"]),
	"VOTE_NAMES" => is_array($arParams["VOTE_NAMES"])? $arParams["VOTE_NAMES"]: array(),
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"]=="vote_avg"? "vote_avg": "rating",
	"READ_ONLY" => $arParams["READ_ONLY"],
);
/****************************************
	Any actions without cache
*****************************************/
//26*
//Сюда дошел в том числе и AJAX запрос

if(
	$_SERVER["REQUEST_METHOD"] == "POST"
	&& !empty($_REQUEST["vote"])
	&& ($_REQUEST["AJAX_CALL"]=="Y" || check_bitrix_sessid())
	&& $arParams["READ_ONLY"]!=="Y"
)
{
	if(!is_array($_SESSION["IBLOCK_RATING"]))
		$_SESSION["IBLOCK_RATING"] = Array();
	$RATING = intval($_REQUEST["rating"])+1;
	if($RATING>0 && $RATING<=$arParams["MAX_VOTE"])
	{
		$ELEMENT_ID = intval($_REQUEST["vote_id"]);
		if($ELEMENT_ID>0 && !array_key_exists($ELEMENT_ID, $_SESSION["IBLOCK_RATING"]))
		{
			$_SESSION["IBLOCK_RATING"][$ELEMENT_ID]=true;

			//записываем свойства раздела если этих свойств еще нет
			$propVoteCountID=0;
			$rsData = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION", "XML_ID"=>"UF_VOTE_COUNT"));
			while($arRes = $rsData->Fetch()){$propVoteCountID = $arRes["ID"];}
			
			if (!$propVoteCountID) 
			{
				$oUserTypeEntity    = new CUserTypeEntity();
				$aUserFields    = array('ENTITY_ID'         => 'IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION',
										'FIELD_NAME'        => 	'UF_VOTE_COUNT',
										'USER_TYPE_ID'      => 'double',
										'XML_ID'            => 'UF_VOTE_COUNT',
										'SORT'              => 500,
										'MULTIPLE'          => 'N',
										'MANDATORY'         => 'N',
										'SHOW_FILTER'       => 'N',
										'SHOW_IN_LIST'      => '',
										'EDIT_IN_LIST'      => '',
										'IS_SEARCHABLE'     => 'N',
										'EDIT_FORM_LABEL'   => array('ru' => GetMessage("CC_BIV_VOTE_COUNT")),
										'LIST_COLUMN_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_COUNT")),
										'LIST_FILTER_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_COUNT")));		
					
				$propVoteCountID   = $oUserTypeEntity->Add( $aUserFields ); 
				
				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_VOTE_COUNT'  => 0));
			}
			
			$propVoteSummID=0;
			$rsData = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION", "XML_ID"=>"UF_VOTE_SUMM"));
			while($arRes = $rsData->Fetch()){$propVoteSummID = $arRes["ID"];}
			if (!$propVoteSummID) 
			{
				$oUserTypeEntity    = new CUserTypeEntity();
				$aUserFields    = array('ENTITY_ID'         => 'IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION',
										'FIELD_NAME'        => 	'UF_VOTE_SUMM',
										'USER_TYPE_ID'      => 'double',
										'XML_ID'            => 'UF_VOTE_SUMM',
										'SORT'              => 500,
										'MULTIPLE'          => 'N',
										'MANDATORY'         => 'N',
										'SHOW_FILTER'       => 'N',
										'SHOW_IN_LIST'      => '',
										'EDIT_IN_LIST'      => '',
										'IS_SEARCHABLE'     => 'N',
										'EDIT_FORM_LABEL'   => array('ru' => GetMessage("CC_BIV_VOTE_SUM")),
										'LIST_COLUMN_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_SUM")),
										'LIST_FILTER_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_SUM")));						 
				$propVoteSummID   = $oUserTypeEntity->Add( $aUserFields ); 

				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_VOTE_SUMM'  => 0));
			}
			
			$propRatingID=0;
			$rsData = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION", "XML_ID"=>"UF_RATING"));
			while($arRes = $rsData->Fetch()){$propRatingID = $arRes["ID"];}
			if (!$propRatingID) 
			{
				$oUserTypeEntity    = new CUserTypeEntity();
				$aUserFields    = array('ENTITY_ID'         => 'IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION',
										'FIELD_NAME'        => 	'UF_RATING',
										'USER_TYPE_ID'      => 'double',
										'XML_ID'            => 'UF_RATING',
										'SORT'              => 500,
										'MULTIPLE'          => 'N',
										'MANDATORY'         => 'N',
										'SHOW_FILTER'       => 'N',
										'SHOW_IN_LIST'      => '',
										'EDIT_IN_LIST'      => '',
										'IS_SEARCHABLE'     => 'N',
										'EDIT_FORM_LABEL'   => array('ru' => GetMessage("CC_BIV_VOTE_RATING")),
										'LIST_COLUMN_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_RATING")),
										'LIST_FILTER_LABEL' => array('ru' => GetMessage("CC_BIV_VOTE_RATING")));						 
				$propRatingID   = $oUserTypeEntity->Add( $aUserFields ); 
				
				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_RATING'  => 0));
			}
						
			$arSelect = array(
				"ID",
				"IBLOCK_ID",
				"UF_RATING",
				"UF_VOTE_SUMM",
				"UF_VOTE_COUNT"
			);
			$arFilter = array(
				"ID" => $arParams["ELEMENT_ID"],
				"IBLOCK_ACTIVE" => "Y",
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ACTIVE" => "Y",
				"CHECK_PERMISSIONS" => "Y",
			);
			
			$rsElement = CIBlockSection::GetList(array(), $arFilter, false, $arSelect, false);
			while ($resElement = $rsElement->GetNext())
			{
				$arProperties["vote_count"]["VALUE"] = intval($resElement["UF_VOTE_COUNT"])+1;
				$arProperties["vote_sum"]["VALUE"] = intval($resElement["UF_VOTE_SUMM"])+$RATING;
				$arProperties["rating"]["VALUE"] = round(($arProperties["vote_sum"]["VALUE"]+31.25/5*$arParams["MAX_VOTE"])/($arProperties["vote_count"]["VALUE"]+10),2);
				break;
			}
			
			$DB->StartTransaction();
			
			
			$ob = new CUserTypeManager;
			$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_RATING'  => 0));
			
			if ($propVoteCountID) 
			{
				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_VOTE_COUNT'  => $arProperties["vote_count"]["VALUE"]));
			}
			if ($propVoteSummID) 
			{
				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_VOTE_SUMM'  => $arProperties["vote_sum"]["VALUE"]));
			}
			if ($propRatingID) 
			{
				$ob = new CUserTypeManager;
				$ob->Update('IBLOCK_'.$arParams["IBLOCK_ID"].'_SECTION', $ELEMENT_ID, array('UF_RATING'  => $arProperties["rating"]["VALUE"]));
				
			}
			
			
			$DB->Commit();
			$this->ClearResultCache(array($USER->GetGroups(), 1));
			$this->ClearResultCache(array($USER->GetGroups(), 0));
			if(defined("BX_COMP_MANAGED_CACHE"))
				$GLOBALS["CACHE_MANAGER"]->ClearByTag("iblock_id_".$arParams["IBLOCK_ID"]);
			
		}
	}
	//27*
	//Нам нет необходимости делать редирект для обновления данных
	//в аякс режиме
	//да и не приведет это ни к чему
	if($_REQUEST["AJAX_CALL"]!="Y")
		LocalRedirect(!empty($_REQUEST["back_page"])?$_REQUEST["back_page"]:$APPLICATION->GetCurPageParam());
}
//28*
//Начинаем исполнять "шаблон"

$bVoted = (is_array($_SESSION["IBLOCK_RATING"]) && array_key_exists($arParams["ELEMENT_ID"], $_SESSION["IBLOCK_RATING"]))? 1: 0;
if($this->StartResultCache(false, array($USER->GetGroups(), $bVoted)))
{
	if($arParams["ELEMENT_ID"]>0)
	{
		//SELECT
		$arSelect = array(
				"ID",
				"IBLOCK_ID",
				"UF_RATING",
				"UF_VOTE_SUMM",
				"UF_VOTE_COUNT"
			);
		//WHERE
		$arFilter = array(
			"ID" => $arParams["ELEMENT_ID"],
			"IBLOCK_ACTIVE" => "Y",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
		);
		//ORDER BY
		$arSort = array(
		);
		//EXECUTE
		
		//$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		
		$rsElement = CIBlockSection::GetList($arSort, $arFilter, false, $arSelect, false);
		
		
		$rsElement = CIBlockSection::GetList(array(), $arFilter, false, $arSelect, false);
		while ($resElement = $rsElement->GetNext())
		{
			$arResult = $resElement;
			$arResult["PROPERTIES"]["vote_count"]["VALUE"] = intval($resElement["UF_VOTE_COUNT"]);
			$arResult["PROPERTIES"]["vote_sum"]["VALUE"] = intval($resElement["UF_VOTE_SUMM"]);
			$arResult["PROPERTIES"]["rating"]["VALUE"] = intval($arProperties["vote_sum"]["VALUE"]);
			break;
		}
		
		
		$arResult["BACK_PAGE_URL"] = htmlspecialcharsbx($APPLICATION->GetCurPageParam());
		$arResult["VOTE_NAMES"] = array();
		foreach($arParams["VOTE_NAMES"] as $k=>$v)
		{
			if(strlen($v)>0)
				$arResult["VOTE_NAMES"][]=htmlspecialcharsbx($v);
			if(count($arResult["VOTE_NAMES"])>=$arParams["MAX_VOTE"])
				break;
		}
		for($i=0;$i<$arParams["MAX_VOTE"];$i++)
			if(!array_key_exists($i, $arResult["VOTE_NAMES"]))
				$arResult["VOTE_NAMES"][$i]=$i+1;

		$arResult["VOTED"] = $bVoted;
		//echo "<pre>",htmlspecialcharsbx(print_r($arResult,true)),"</pre>";
		$this->SetResultCacheKeys(array(
			"AJAX",
		));
		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
		ShowError(GetMessage("PHOTO_ELEMENT_NOT_FOUND"));
		@define("ERROR_404", "Y");
		if($arParams["SET_STATUS_404"]==="Y")
			CHTTP::SetStatus("404 Not Found");
	}
}

if(array_key_exists("AJAX", $arResult) && ($_REQUEST["AJAX_CALL"] != "Y"))
{
	//13*
	//Сохраняем в БД кеш
	if(!is_array($_SESSION["iblock.vote"]))
		$_SESSION["iblock.vote"] = array();
	if(!array_key_exists($arResult["AJAX"]["SESSION_KEY"], $_SESSION["iblock.vote"]))
	{
		$arCache = CIBlockRSS::GetCache($arResult["AJAX"]["SESSION_KEY"]);
		if(!$arCache || ($arCache["VALID"] != "Y"))
		{
			CIBlockRSS::UpdateCache($arResult["AJAX"]["SESSION_KEY"], serialize($arResult["AJAX"]["SESSION_PARAMS"]), 24*30, is_array($arCache));
		}
		$_SESSION["iblock.vote"][$arResult["AJAX"]["SESSION_KEY"]] = true;
	}

	if(!defined("ADMIN_SECTION") || (ADMIN_SECTION !== true))
	{
		//14*
		//Подключаем поддержку (библиотеку)
		IncludeAJAX();
	}
	//15*
	//Продолжение экскурсии в файле jscript.php
}
?>
