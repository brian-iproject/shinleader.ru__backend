<?
$bUseFacet = (defined("ASPROTIRES_USE_FACET_SMARTFILTER") ? ASPROTIRES_USE_FACET_SMARTFILTER : false);

if($bUseFacet){
	require_once("facet_class.php");
}
else{
	require_once("nofacet_class.php");
}
?>