<?php
namespace Ajax\service;

use Ajax\JsUtils;
class AjaxCall {
	private $method;
	private $parameters;

	public function __construct($method,$parameters){
		$this->method=$method;
		$this->parameters=$parameters;
	}
	public function compile(JsUtils $js=null){
		if($js==null)
			return;
		$result="";
		$params="{}";
		$callback=NULL;
		$attr="id";
		extract($this->parameters);
		switch ($this->method){
			case "get":
				$result=$js->getDeferred($url,$responseElement,$params,$callback,$attr);
				break;
		}
		return $result;
	}

	public function getMethod() {
		return $this->method;
	}
	public function setMethod($method) {
		$this->method = $method;
		return $this;
	}
	public function getParameters() {
		return $this->parameters;
	}
	public function setParameters($parameters) {
		$this->parameters = $parameters;
		return $this;
	}

}