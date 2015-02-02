<?php
namespace Ajax\bootstrap\Components;
use Ajax\common\SimpleComponent;
class SimpleBsComponent extends SimpleComponent{
	protected $events=array();
	protected $jsCodes=array();

	public function addEvent($event,$jsCode){
		$this->events[$event]=$jsCode;
	}

	public function getScript(){
		parent::getScript();
		foreach ($this->events as $event=>$jsCode){
			$this->jquery_code_for_compile[]="$( \"".$this->attachTo."\" ).on(\"".$event."\" , function (e) {".$jsCode."});";
		}
		foreach ($this->jsCodes as $jsCode){
			$this->jquery_code_for_compile[]=$jsCode->compile(array("identifier"=>$this->attachTo));
		}
		$result= implode("", $this->jquery_code_for_compile);
		$result=str_ireplace("\"%", "", $result);
		$result=str_ireplace("%\"", "", $result);
		$result = str_replace(array("\\n", "\\r","\\t"), '', $result);
		return $result;
	}
}