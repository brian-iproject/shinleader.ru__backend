<?
	if( $arResult["DATE_ACTIVE_FROM"] != "" ):
		$date = explode(".", $arResult["DATE_ACTIVE_FROM"]);
		$day = $date[0];
		$month = $date[1];
		$year = $date[2];
		switch( $month ){
			case "1":
				$month = "������";
				break;
			case "2":
				$month = "�������";
				break;
			case "3":
				$month = "�����";
				break;
			case "4":
				$month = "������";
				break;
			case "5":
				$month = "���";
				break;
			case "6":
				$month = "����";
				break;
			case "7":
				$month = "����";
				break;
			case "8":
				$month = "�������";
				break;
			case "9":
				$month = "��������";
				break;
			case "10":
				$month = "�������";
				break;
			case "11":
				$month = "������";
				break;
			case "12":
				$month = "�������";
				break;
		}
	endif;
	$arResult["DATE_ACTIVE_FROM"] = $day." ".$month;
?>