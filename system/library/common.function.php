<?php 

function str_to_arr_item($str,$arr){
	$res=preg_replace("/\./", "][", $str);
	return $arr{"[".$res."]"};
}

 ?>