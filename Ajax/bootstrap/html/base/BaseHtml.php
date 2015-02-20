<?php
namespace Ajax\bootstrap\html\base;
use Phalcon\Text;
use Ajax\JsUtils;
use Phalcon\Mvc\View;
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
	protected $events=array();
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

	function compile(JsUtils $js=NULL,View $view=NULL) {
		$result=$this->getTemplate();
		foreach($this as $key => $value) {
			if(Text::startsWith($key, "_")===false){
				if(is_array($value)){
					$v=PropertyWrapper::wrap($value,$js);
				}
				else{
					$v=$value;
				}
				$result=str_ireplace("%".$key."%", $v, $result);
			}
		}
		if(isset($js)){
			$this->run($js);
		}
		if(isset($view)===true){
			$controls=$view->getVar("q");
			if(isset($controls)===false){
				$controls=array();
			}
			$controls[$this->identifier]=$result;
			$view->setVar("q",$controls);
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

	protected function addToMemberUnique(&$name,$value,$typeCtrl,$separator=" "){
			if(is_array($typeCtrl)){
				$this->removeOldValues($name, $typeCtrl);
			$name.=$separator.$value;
		}
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

	protected function addToPropertyUnique($name,$value,$typeCtrl){
		if(@class_exists($typeCtrl,true))
			$typeCtrl=$typeCtrl::getConstants();
		if(is_array($typeCtrl)){
			$this->removeOldValues($this->properties[$name], $typeCtrl);
		}
		return $this->addToProperty($name, $value);
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
		foreach ($array as $key=>$value){
			if(method_exists($this, $key)){
				try {
					$this->$key($value);
					unset($array[$key]);
				} catch (Exception $e) {}
			}else{
				$setter="set".ucfirst($key);
				if(method_exists($this, $setter)){
					try {
						$this->$setter($value);
						unset($array[$key]);
					} catch (Exception $e) {}
				}
			}
		}
		return $array;
	}

	public function wrap($before,$after=""){
		$this->wrapBefore.=$before;
		$this->wrapAfter=$after.$this->wrapAfter;
		return $this;
	}

	public function addEvent($event,$jsCode,$stopPropagation=false,$preventDefault=false){
		if($stopPropagation===true){
			$jsCode="event.stopPropagation();".$jsCode;
		}
		if($preventDefault===true){
			$jsCode="event.preventDefault();".$jsCode;
		}
		$this->events[$event]=$jsCode;
		return $this;
	}

	public function on($event,$jsCode,$stopPropagation=false,$preventDefault=false){
		return $this->addEvent($event, $jsCode,$stopPropagation,$preventDefault);
	}

	public function addEventsOnRun(){
		if(isset($this->_bsComponent)){
			foreach ($this->events as $event=>$jsCode){
				$this->_bsComponent->addEvent($event,$jsCode);
			}
		}
	}
}