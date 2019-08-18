<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<li class="box">
	<?if( $arResult["BANNER_PROPERTIES"]["URL"] != "" ):?>
		<a href="<?=$arResult["BANNER_PROPERTIES"]["URL"]?>" title="<?=$arResult["BANNER_PROPERTIES"]["NAME"]?>">
	<?endif;?>
		<?=$arResult["BANNER"]?>
	<?if( $arResult["BANNER_PROPERTIES"]["URL"] != "" ):?>
		</a>
	<?endif;?>
</li>