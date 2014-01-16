<?php

class Format{

	static function format_vazioToZero($val){
		return (empty($val)) ? "0.00" : $val; 
	}

	static function format_decimal($val){ 
		return number_format($val,2,'.','.');
	}

}