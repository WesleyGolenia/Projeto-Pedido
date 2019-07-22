<?php
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR);
function loadClass($class_name){
	$arquivo= __DIR__ ."/model/".$class_name.".php";
		if(!empty($arquivo)){
			require_once($arquivo);
		}
	}
function mask($val, $mask)
{
	 $maskared = '';
	 $k = 0;
	 for($i = 0; $i<=strlen($mask)-1; $i++)
	 {
	 if($mask[$i] == '#')
	 {
	 if(isset($val[$k]))
	 $maskared .= $val[$k++];
	 }
	 else
	 {
	 if(isset($mask[$i]))
		$maskared .= $mask[$i];
	 }
	 }
	 return $maskared;
}
?>