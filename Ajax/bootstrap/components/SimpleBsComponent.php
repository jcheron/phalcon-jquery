<?php
namespace Ajax\bootstrap\Components;
use Ajax\common\SimpleComponent;
class SimpleBsComponent extends SimpleComponent{
	protected $events=array();
	protected $jsCodes=array();

	public function addEvent($event,$jsCode){
		$this->events[$event]=$jsCode;
	}
	protected function compileEvents(){
		foreach ($this->events as $event=>$jsCode){
			$this->jquery_code_for_compile[]="$( \"".$this->attachTo."\" ).on(\"".$event."\" , function (e) {".$jsCode."});";
		}
	}

	public function getScript(){
		parent::getScript();
		$this->compileEvents();
		foreach ($this->jsCodes as $jsCode){
			$this->jquery_code_for_compile[]=$jsCode->compile(array("identifier"=>$this->attachTo));
		}
		return $this->compileJQueryCode();
	}
}