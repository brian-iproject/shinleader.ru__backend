<?
	$arMenu = array();
	$inx = 0;
	for( $i = 0; $i < count($arResult); $i++ ){
		if( $arResult[$i]["DEPTH_LEVEL"] == 1 ):
			$arMenu[$inx] = $arResult[$i];
			if( $arResult[$i]["IS_PARENT"] == 1 ):
				while(1){
					$i++;
					$arMenu[$inx]["ITEMS"][] = $arResult[$i];
					if( $i+1 >= count($arResult) || $arResult[$i+1]["DEPTH_LEVEL"] == 1 ):
						break;
					endif;
				}
			endif;
			$inx++;
		endif;
	}
	$arResult = $arMenu;
	
	foreach($arResult as $key => $arItem)
	{
		if ( (($arItem["LINK"]==SITE_DIR."search/tires/")||($arItem["LINK"]==SITE_DIR."search/tires")||($arItem["LINK"]==SITE_DIR."catalog/tires/")||($arItem["LINK"]==SITE_DIR."catalog/tires")) 
			&& (CSite::InDir(SITE_DIR.'catalog/tires') || CSite::InDir(SITE_DIR.'search/tires')) ) 				
		{$arResult[$key]["SELECTED"] = true;}
		elseif ( (($arItem["LINK"]==SITE_DIR."search/wheels/")||($arItem["LINK"]==SITE_DIR."search/wheels")||($arItem["LINK"]==SITE_DIR."catalog/wheels/")||($arItem["LINK"]==SITE_DIR."catalog/wheels")) 
			&& (CSite::InDir(SITE_DIR.'catalog/wheels')||CSite::InDir(SITE_DIR.'search/wheels'))
			&& !CSite::InDir(SITE_DIR.'catalog/wheels/sports')
		)
		{$arResult[$key]["SELECTED"] = true;}
		elseif ( (($arItem["LINK"]==SITE_DIR."search/accumulators/")||($arItem["LINK"]==SITE_DIR."search/accumulators")||($arItem["LINK"]==SITE_DIR."catalog/accumulators/")||($arItem["LINK"]==SITE_DIR."catalog/accumulators")) 
			&& (CSite::InDir(SITE_DIR.'catalog/accumulators')||CSite::InDir(SITE_DIR.'search/accumulators')) )
		{$arResult[$key]["SELECTED"] = true;}
	}
?>
