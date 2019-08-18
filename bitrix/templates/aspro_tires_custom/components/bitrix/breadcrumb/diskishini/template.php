<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult))
	return "";
?>

<?
$strReturn = '<div class="module-breadcrumbs">';
?>

<?
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '<span class="sep">/</span>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $arResult[$index]['LINK'] != GetPagePath() )
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	else {
		$strReturn .= '<span class="breadcrumbs-text">' . $title . '</span>';
		break;
	}
}

$strReturn .= '</div>';
return $strReturn;
?>
