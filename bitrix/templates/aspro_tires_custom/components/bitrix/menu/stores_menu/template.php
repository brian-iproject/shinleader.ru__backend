<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
function printMenus($result, $level=0) {
   foreach($result as $item) {
?>
	  <?if(!empty($item["ADDITIONAL_LINKS"]["IS_PARENT"])):?>
	  <div class="section-title"> 
	  <?=$item["TEXT"]?>
	  </div>
	  <?else:?>
      <a href="<?=$item["LINK"]?>" <?=!empty($item["SELECTED"]) ? 'class="cur"' : ''?>>
	  <span><?=$item["TEXT"]?></span>	  
	  <?endif;?>
	  </a>
      <?if(!empty($item["CHILD"])) printMenus($item["CHILD"], $level+1);?>   
<?
   }
}
?>
<?if (!empty($arResult)):?>
<div class="module-side-nav-contacts">
	<div class="module-title"><?=GetMessage("FILLIALS");?>:</div>
	<div class="section">
	<?printMenus($arResult);?>
	</div>
</div>
<?endif?>