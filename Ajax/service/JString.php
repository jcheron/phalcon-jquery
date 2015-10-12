<?php
namespace Ajax\service;
class JString {
	public static function isNull($s){
		return (!isset($s) || NULL===$s || ""===$s);
	}
	public static function isNotNull($s){
		return (isset($s) && NULL!==$s && ""!==$s);
	}
}