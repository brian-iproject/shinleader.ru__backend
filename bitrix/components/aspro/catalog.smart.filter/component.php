<?
$bUseFacet = (defined("ASPROTIRES_USE_FACET_SMARTFILTER") ? ASPROTIRES_USE_FACET_SMARTFILTER : false);

if($bUseFacet){
	require("facet_component.php");
}
else{
	require("nofacet_component.php");
}
?>