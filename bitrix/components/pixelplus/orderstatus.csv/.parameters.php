<?
$arComponentParameters = array(
   "GROUPS" => array(
	  "ADDITIONAL" => array(
         "NAME" => getMessage('ADDITIONAL')
      )
   ),
   "PARAMETERS" => array(
		"FILE_URL" => array( 
			 "PARENT" => "ADDITIONAL",
			 "NAME" => getMessage("FILE_URL"),
			 "TYPE" => "STRING",
			 "DEFAULT"=>"/upload/orderstatus/out.csv"
		)
   )
);
?>