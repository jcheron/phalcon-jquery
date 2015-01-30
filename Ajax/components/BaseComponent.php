<?php
namespace Ajax\Components;
use Ajax\JsUtils;
class BaseComponent{

	protected $jquery_code_for_compile = array();

	protected $params=array();

	/**
	 * @var JsUtils
	 */
	protected $js;

	public function __construct(JsUtils $js=NULL){
		$this->js=$js;
	}
	protected function getParamsAsJSON($params){
		$result= json_encode($params,JSON_UNESCAPED_SLASHES);
		$result=str_ireplace("%quote%", "\"", $result);
		return $result;
	}

	public function setParam($key,$value){
		$this->params[$key]=$value;
	}

	public function getParam($key){
		$value=null;
		if(array_key_exists($key, $this->params))
			$value=$this->params[$key];
		return $value;
	}
	public function getParams(){
		return $this->params;
	}
	public function compile(JsUtils $js=NULL){
		if($js==NULL)
			$js=$this->js;
		$js->addToCompile($this->__toString());
	}
}