<?
function bug($var){
	$a=func_get_args();
	call_user_func_array(array(FirePHP::getInstance(true),"log"),$a);
	//fb($var, FirePHP::LOG);
}

function dump(){
	global $QS_DEBUG_CNT;
	//$useDiv = true,$hidden=false
	$useDiv = true;
	$hidden = false;
	
	$args = func_get_args();

	if (in_array($args[count($args)-1][0],array('h','t','f'))) {
		$type = $args[count($args)-1];
		unset ($args[count($args)-1]);
	} else {
		$type = 'n';
	}

	$file = substr($type,2);
	if (!$file) $file = 'dump.txt';
	$type = $type[0];
	
	$x = debug_backtrace();
	$x = $x[0];
	$x['file'] = substr($x['file'],strlen($_SERVER['DOCUMENT_ROOT']));	
	
	switch ($type) {
		case 'h':
			$hidden=true;
			break;
		case 't':
			$useDiv=false;
			break;
		case 'f':
			$res = '';
			foreach ($args as $value) 
				$res .= print_r($value,true)."\n\n=================================================================\n\n";
			$f = $_SERVER['DOCUMENT_ROOT'].'/'.$file;
			$fo = fopen($f, 'a');
			fwrite($fo, $x['file']." :".$x['line']."\n\n=================================================================\n\n".$res);
			fclose($fo);
			return;
	}
	
	if (!defined("QS_DUMP_STARTED"))
		$QS_DEBUG_CNT = 0;

	echo "<div ".($useDiv?"id='qs_dump_div_{$QS_DEBUG_CNT}'":"")." style='".($useDiv?"display:none":"border:1px solid #f00;float:left;")."'>";

	echo "<b style='text-decoration:underline'>{$x['file']} :{$x['line']}</b><br \><pre>";
	
	foreach ($args as $value) {
		print_r($value);
		echo "\n\n<hr>\n\n";
	}	
	
	// dump($x[1]['file']);
	// dump($x[1]['line']);
	//
	echo "</pre></div>";
	if (!$useDiv){
		echo "<div style='clear:both'></div>";
	} else {
		if (!defined("QS_DUMP_STARTED")){
			define("QS_DUMP_STARTED", true);
			if (!$hidden) echo "<div onclick='use_debug();' style='opacity:0.7;cursor:pointer;position:fixed;left:10px;bottom:0.1%;width:40px;height:20px;background:#0a0;color:#500;border:2px solid #500;-moz-border-radius:20px;text-align:center;padding-top:5px'><strong>D</strong></div>";
			$s = "\"<div id='qs_dump_div_over' style='padding-right:2%;display:none;-moz-border-radius-bottomLeft:12px;-moz-border-radius-bottomRight:12px;position:fixed;top:0px;left:1%;width:96%;height:50%;opacity:0.92;background:paleGoldenRod;font-size:14px;border:#222 1px solid;border-top:none;z-index:99999;'><div style='font-family:Arial;position:fixed;padding:5px;color:#222;bottom: 50%;right:1.2%;font-weight:bold;cursor:pointer;' onclick=\\\"document.getElementById('qs_dump_div').innerHTML = ''\\\" >Clear</div><div style='padding:0.1%;overflow:auto;height:90%' id='qs_dump_div' ></div></div>\"";
			echo "<script type=\"text/javascript\">";
			echo "function redraw(){";
			echo "	var n = document.createTextNode(' ');";
			echo "	document.body.appendChild(n);";
			echo "	document.body.removeChild(n);";
			echo "}";
			echo "function use_debug(){";
			echo "	var ob = document.getElementById('qs_dump_div_over');";
			echo "	if (ob.style.display == 'none') ob.style.display = 'block'; else ob.style.display = 'none';";
			echo "	redraw(document.body);";
			echo "}";
			echo "function qs_show_debug(evt){";		
			echo "	a = (evt.which) ? evt.which : evt.keyCode;";
			echo "	if (a != 96) return;";
			echo "	use_debug();";
			echo "}";
			echo "function alert(str){";
				echo "	var ob = document.getElementById('qs_dump_div');";
				echo "	if (ob.innerHTML !='') ob.innerHTML += '<div style=\'border:1px solid #DDD;height:1px;width:100%;background:#555;\'></div>';";
				echo "	ob.innerHTML +=  str;";
			echo "}";
			echo "document.write({$s});";
			echo "document.onkeypress = qs_show_debug;";
		} else  echo "<script>";
		
		
		
		
		echo "	var ob2 = document.getElementById('qs_dump_div_{$QS_DEBUG_CNT}');";
		echo " alert(ob2.innerHTML);";
		echo "</script>";
	}
	$QS_DEBUG_CNT++;
}




function debugtree($ar, $title=false){
	
	if($_REQUEST['ajax'] == 'Y') return;
	
	if($title){
		echo '<h3 class="debugtree">'.$title.'</h3>';
		echo '<ul class="debugtree" style="display:none">';
	}else{
		echo '<ul class="debugtree" style="">';
	}
	foreach($ar as $k=>$v){
			if(is_array($v)){
				echo '<li class="inc">';
				echo '['.$k.'] => array ( ';
				debugtree($v);
				echo ")";
			}else{
				echo '<li>';
				echo '['.$k.'] => ';
				echo '"'.htmlspecialchars($v).'"';
			}
		echo '</li>';
	}
	echo '</ul>';
	if(!defined('TREE_JQUERY_INCLUDE')){
		?><style>
				ul.debugtree ul.debugtree{
					position:relative;
				}
				ul.debugtree{
					background:white;
					position:absolute;
					border:3px pink solid;
					z-index:9999;
				}
				ul.debugtree li{
					white-space:nowrap;
					list-style:none;
				}
			</style>
			<script type="text/javascript">
				$(document).ready(function(){
					$('li.inc ul.debugtree').hide();
					$('ul.debugtree li.inc').css('border-left' , '2px red solid' ).click(function(e){
						$(this).children('ul.debugtree').toggle();
						e.stopPropagation();
						return false;
					});
					$('ul.debugtree li[class!=inc]').css('border-left','2px blue solid').click(function(e){
						e.stopPropagation();
						return false;
					})
					$('h3.debugtree').click(function(e){
						$(this).next().toggle();
						e.stopPropagation();
						return false;
					})
				})
			</script><?
		define('TREE_JQUERY_INCLUDE' , true);
	}
}

function DebugMessage($message, $title = false, $access = true, $color = '#008B8B') {
    
	if($_REQUEST['ajax'] == 'Y') return;
	
	?>
    <table border="0" cellpadding="5" cellspacing="0" style="border:1px solid <?=$color?>;margin:2px;"><tr><td>
    <?
    //debug_print_backtrace();

    if (strlen($title)>0){
        echo '<p style="color:'.$color.';font-size:11px;font-family:Verdana;">['.$title.']</p>';
    }

    if (is_array($message) || is_object($message)){
        echo '<pre style="color:'.$color.';font-size:11px;font-family:Verdana;">'; print_r($message); echo '</pre>';
    }
    else{
        echo '<p style="color:'.$color.';font-size:11px;font-family:Verdana;">'.var_dump($message).'</p>';
    }

    ?></td></tr></table><?
}
?>