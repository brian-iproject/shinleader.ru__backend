<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$ajax = (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest');
	if (!$USER->IsAuthorized() && !$ajax)
	{
		LocalRedirect(SITE_DIR."auth/?backurl=".SITE_DIR."order/");
	}
	else
	{
		?><input type="hidden" name="confirmorder" id="confirmorder" value="Y"><?
	}
?>