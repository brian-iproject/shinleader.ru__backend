<?
	if( $arResult["DATE_ACTIVE_FROM"] != "" ):
		$date = explode(".", $arResult["DATE_ACTIVE_FROM"]);
		$day = $date[0];
		$month = $date[1];
		$year = $date[2];
		switch( $month ){
			case "1":
				$month = "€нвар€";
				break;
			case "2":
				$month = "феврал€";
				break;
			case "3":
				$month = "марта";
				break;
			case "4":
				$month = "апрел€";
				break;
			case "5":
				$month = "ма€";
				break;
			case "6":
				$month = "июн€";
				break;
			case "7":
				$month = "июл€";
				break;
			case "8":
				$month = "августа";
				break;
			case "9":
				$month = "сент€бр€";
				break;
			case "10":
				$month = "окт€бр€";
				break;
			case "11":
				$month = "но€бр€";
				break;
			case "12":
				$month = "декабр€";
				break;
		}
	endif;
	$arResult["DATE_ACTIVE_FROM"] = $day." ".$month;
?>