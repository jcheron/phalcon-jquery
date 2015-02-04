<?php
namespace Ajax\bootstrap\html;

class PropertyWrapper {
	public static function wrap($input,$separator=' ',$valueQuote = '"'){
		$output="";
		if(is_string($input))
			$output=$input;
		if(is_array($input)){
			if(sizeof($input)>0){
				$value1=reset($input);
				if(is_object($value1))
					$output=PropertyWrapper::wrapObjects($input,$separator=' ');
				else
					$output=PropertyWrapper::wrapStrings($input,$separator=' ',$valueQuote = '"');
			}
		}
		return $output;
	}

	public static function wrapStrings($input,$separator=' ',$valueQuote = '"'){
		return implode($separator, array_map(function ($v, $k) use ($valueQuote) { return $k.'='.$valueQuote.$v.$valueQuote ; }, $input, array_keys($input)));
	}

	public static function wrapObjects($input,$separator=' '){
		return implode($separator, $input);
	}
}