<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");?>


	<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && (($arResult["IBLOCK_SECTION_ID"] && $arResult["SECTION_FULL"]["DEPTH_LEVEL"]==2) || ($arResult["ID"] && $arResult["SECTION_FULL"]["DEPTH_LEVEL"]==1) || $arResult["SECTION_FULL"]["DEPTH_LEVEL"]>2)):?>
		<li>
		
			<?if ($arResult["SECTION_FULL"]["DEPTH_LEVEL"]==2){?>
				<?$APPLICATION->IncludeComponent(
					"aspro:forum.topic.reviews",
					"section_reviews",
					Array(
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
						"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
						"FORUM_ID" => $arParams["FORUM_ID"],
						"ELEMENT_ID" => $arResult["IBLOCK_SECTION_ID"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
						"SHOW_RATING" => "N",
						"SHOW_MINIMIZED" => "Y",
						"SECTION_REVIEW" => "Y",
						"POST_FIRST_MESSAGE" => "Y",
						"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
						"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
						"SHOW_AVATAR" => "N",
						"SHOW_LINK_TO_FORUM" => "N",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/"
					),	false
				);?>
			<?} elseif ($arResult["SECTION_FULL"]["DEPTH_LEVEL"]==1 || $arResult["SECTION_FULL"]["DEPTH_LEVEL"]>2){?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:forum.topic.reviews",
					"element_reviews",
					Array(
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
						"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
						"FORUM_ID" => $arParams["FORUM_ID"],
						"ELEMENT_ID" => $arResult["ID"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
						"SHOW_RATING" => "N",
						"SHOW_MINIMIZED" => "Y",
						"SECTION_REVIEW" => "Y",
						"POST_FIRST_MESSAGE" => "Y",
						"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
						"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
						"SHOW_AVATAR" => "N",
						"SHOW_LINK_TO_FORUM" => "N",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
					),	false
				);?>
			<?}?>
		</li>
	<?endif;?>
	</ul>
</div>
		
</div>
<script>
	$(".tabs-section .tabs > li").live("click", function()
	{
		if (!$(this).is(".cur"))
		{
			$(".tabs-section .tabs > li").removeClass("cur");
			$(this).addClass("cur");
			$(".tabs-section .tabs-content > ul > li").removeClass("cur");
			$(".tabs-section .tabs-content > ul > li:eq("+$(this).index()+")").addClass("cur");
		}
	});
	
	$(document).ready(function()
	{
		$(".tabs-section .tabs > li").first().addClass("cur");
		$(".tabs-section .tabs-content > ul > li").first().addClass("cur");
				if ($("#similar_products").length) { $(".tabs-section").after($("#similar_products").html()); $("#similar_products").remove();}
	});

	$(document).ready(function(){
		if($(".gifts").length){
			$(".gifts").insertAfter($(".tabs-section"));
		}			
	})
</script>