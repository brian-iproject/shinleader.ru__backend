<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");?>

			<?if ($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $arResult["ID"]):?>
				<li>
					<?$APPLICATION->IncludeComponent(
						"aspro:forum.topic.reviews",
						"section_reviews",
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
							"SHOW_LINK_TO_FORUM" => "N"
						),
						false
					);?>
				</li>
			<?endif;?>
		</ul>
	</div>
</div>

<script>
	$(document).ready(function(){
		if($("#module_sizes").length){
			$(".tabs-section").after($("#module_sizes").html());
			$("#module_sizes").detach();
			jqmEd('order-button', arTiresOptions['PRODUCT_REQUEST_FORM_ID']);
		};

		$(".tabs-section .tabs > li").first().addClass("cur");
		$(".tabs-section .tabs-content > ul > li").first().addClass("cur");

		$(".tabs-section .tabs > li").live("click", function(){
			if(!$(this).is(".cur")){
				$(".tabs-section .tabs > li").removeClass("cur");
				$(this).addClass("cur");
				$(".tabs-section .tabs-content > ul > li").removeClass("cur");
				$(".tabs-section .tabs-content > ul > li:eq(" + $(this).index() + ")").addClass("cur");
			}
		});
	});
</script>