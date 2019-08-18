<?
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
		echo "<script>jqmEd( 'order-button', arTiresOptions['PRODUCT_REQUEST_FORM_ID']);</script>";
	}
?>