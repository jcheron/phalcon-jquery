<?php

namespace Ajax\bootstrap\html\base;

use Ajax\service\JArray;
use Ajax\service\AjaxCall;

class PropertyWrapper {

	public static function wrap($input, $js=NULL, $separator=' ', $valueQuote='"') {
		$output="";
		if (is_string($input)) {
			$output=$input;
		}
		if (is_array($input)) {
			if (sizeof($input)>0) {
				$value1=reset($input);
				if (is_object($value1)) {
					$output=PropertyWrapper::wrapObjects($input, $js, $separator=' ');
				} else
					$output=PropertyWrapper::wrapStrings($input, $separator=' ', $valueQuote='"');
			}
		}
		return $output;
	}

	public static function wrapStrings($input, $separator=' ', $valueQuote='"') {
		if (JArray::isAssociative($input)===true) {
			$result=implode($separator, array_map(function ($v, $k) use($valueQuote) {
				return $k.'='.$valueQuote.$v.$valueQuote;
			}, $input, array_keys($input)));
		} else {
			$result=implode($separator, array_values($input));
		}
		return $result;
	}

	public static function wrapObjects($input, $js=NULL, $separator=' ') {
		return implode($separator, array_map(function ($v) use($js) {
			return $v->compile($js);
		}, $input));
	}
}