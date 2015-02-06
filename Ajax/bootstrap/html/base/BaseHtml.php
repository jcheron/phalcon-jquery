<?php
namespace Ajax\bootstrap\html\base;
use Phalcon\Text;
use Ajax\JsUtils;
include_once 'BaseWidget.php';
include_once 'CssRef.php';
include_once 'PropertyWrapper.php';
/**
 * BaseHtml for Twitter Bootstrap HTML components
 * @author jc
 * @version 1.001
 */
abstract class BaseHtml extends BaseWidget {
	protected $_template;
	protected $tagName;
	protected $properties=array();
	protected $wrapBefore="";
	protected $wrapAfter="";
	protected $_bsComponent;

	public function getBsComponent() {
		return $this->_bsComponent;
	}
	public function setBsComponent($bsComponent) {
		$this->_bsComponent = $bsComponent;
		return $this;
	}
	protected function getTemplate(){
		return $this->wrapBefore.$this->_template.$this->wrapAfter;
	}

	public function getProperties() {
		return $this->properties;
	}
	public function setProperties($properties) {
		$this->properties = $properties;
		return $this;
	}

	public function setProperty($name,$value){
		$this->properties[$name]=$value;
		return $this;
	}

	public function getProperty($name){
		if(array_key_exists($name, $this->properties))
			return $this->properties[$name];
	}

	public function addToProperty($name,$value,$separator=" "){
		$v=$this->properties[$name];
		if(isset($v) && $v!=="")
			$v=$v.$separator.$value;
		else
			$v=$value;

		return $this->setProperty($name, $v);
	}

	public function addProperties($properties){
		$this->properties=array_merge($this->properties,$properties);
		return $this;
	}

	function compile() {
		$result=$this->getTemplate();
		foreach($this as $key => $value) {
			if(!Text::startsWith($key, "_")){
				if(is_array($value))
					$v=PropertyWrapper::wrap($value);
				else
					$v=$value;
				$result=str_ireplace("%".$key."%", $v, $result);
			}
		}
		return $result;
	}
	protected function ctrl($name,$value,$typeCtrl){
		if(is_array($typeCtrl)){
			if(array_search($value, $typeCtrl)===false){
				throw new \Exception("La valeur passée a propriété `".$name. "` ne fait pas partie des valeurs possibles : {".implode(",", $typeCtrl)."}");
				return false;
			}
		}else{
			if(!$typeCtrl($value)){
				throw new \Exception("La fonction ".$typeCtrl." a retourné faux pour l'affectation de la propriété ".$name);
				return false;
			}
		}
		return true;
	}

	protected function setPropertyCtrl($name,$value,$typeCtrl){
		if($this->ctrl($name, $value, $typeCtrl)===true)
			return $this->setProperty($name, $value);
		return $this;
	}

	protected function setMemberCtrl(&$name,$value,$typeCtrl){
		if($this->ctrl($name, $value, $typeCtrl)===true)
			return $name=$value;
		return $this;
	}

	protected function addToMemberCtrl(&$name,$value,$typeCtrl,$separator=" "){
		if($this->ctrl($name, $value, $typeCtrl)===true){
			if(is_array($typeCtrl)){
				$this->removeOldValues($name, $typeCtrl);
			}
			$name.=$separator.$value;
		}
		return $this;
	}

	protected function addToMember(&$name,$value,$separator=" "){
		$name=str_ireplace($value, "", $name).$separator.$value;
		return $this;
	}

	protected function addToPropertyCtrl($name,$value,$typeCtrl){
		//if($this->ctrl($name, $value, $typeCtrl)===true){
			if(@class_exists($typeCtrl,true))
				$typeCtrl=$typeCtrl::getConstants();
			if(is_array($typeCtrl)){
				$this->removeOldValues($this->properties[$name], $typeCtrl);
			}
			return $this->addToProperty($name, $value);
		//}
		return $this;
	}

	protected function removeOldValues(&$oldValue,$allValues){
		$oldValue=str_ireplace($allValues, "", $oldValue);
	}

	public abstract function run(JsUtils $js);
	public function getTagName() {
		return $this->tagName;
	}
	public function setTagName($tagName) {
		$this->tagName = $tagName;
		return $this;
	}

	public function fromArray($array){
		foreach($this as $key=>$value){
			if(array_key_exists($key, $array)){
				if(!Text::startsWith($key, "_")){
					$setter="set".ucfirst($key);
					$this->$setter($array[$key]);
				}
				unset($array[$key]);
			}
		}
		return $array;
	}
	public function wrap($before,$after=""){
		$this->wrapBefore=$before;
		$this->wrapAfter=$after;
	}
}