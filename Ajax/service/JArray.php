<?php

namespace Ajax\service;

class JArray {

	public static function isAssociative($array) {
		return (array_values($array) !== $array);
		//return (array_keys($array)!==range(0, count($array)-1));
	}

	public static function getValue($array, $key, $pos) {
		if (array_key_exists($key, $array)) {
			return $array [$key];
		}
		$values=array_values($array);
		if ($pos<sizeof($values))
			return $values [$pos];
	}

	public static function getDefaultValue($array, $key, $default) {
		if (array_key_exists($key, $array)) {
			return $array [$key];
		} else
			return $default;
	}

	public static function implode($glue,$pieces){
		$result="";
		if(\is_array($glue)){
			$size=\sizeof($pieces);
			if($size>0){
				for($i=0;$i<$size-1;$i++){
					$result.=$pieces[$i].@$glue[$i];
				}
				$result.=$pieces[$size-1];
			}
		}else{
			$result=\implode($glue, $pieces);
		}
		return $result;
	}
}