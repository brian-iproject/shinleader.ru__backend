<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	if (!function_exists('sort_sections'))
	{
		function sort_sections( $arr )
		{
			$count = count( $arr );
			for( $i = 0; $i < $count; $i++ ){
				for( $j = 0; $j < $count; $j++ ){
					if( strtoupper($arr[$i]["NAME"]) < strtoupper($arr[$j]["NAME"]) ){
						$tmp = $arr[$i];
						$arr[$i] = $arr[$j];
						$arr[$j] = $tmp;
					}
				}
			}
			return $arr;
		}
	}
?>
<?$arResult["SECTIONS"]=sort_sections($arResult["SECTIONS"]);?>
<ul class="manufacturers-names">
	<?foreach( $arResult["SECTIONS"] as $arSection ){
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<li id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="<?=$arParams["CURRENT"] == $arSection["CODE"] ? 'cur' : ''?>">
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
				<?=$arSection["NAME"]?><i></i>
			</a>
		</li>
	<?}?>
</ul>
<script>
	$(document).ready(function()
	{
		$(".manufacturers-names li a").live("click", function()
		{
			if (!$(this).parent("li").is(".cur"))
			{
				$(".manufacturers-names li").removeClass("cur"); 
				$(this).parent("li").addClass("cur");
			}
		});
	});
</script>