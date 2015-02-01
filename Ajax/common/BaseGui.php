<?php
namespace Ajax\common;
use Phalcon\Text;
use Ajax\JsUtils;
require_once 'BaseComponent.php';
require_once 'SimpleComponent.php';

/**
 * BaseGui Phalcon library
 *
 * @author		jcheron
 * @version 	1.001
 */

/**
 * BaseGui
 **/
class BaseGui{
	protected $_di;
	protected $autoCompile;
	protected $components;
	/**
	 * @var Ajax\JsUtils
	 */
	protected $js;
	public function __construct($autoCompile=true){
		$this->autoCompile=$autoCompile;
		$this->components=array();
	}

	public function isAutoCompile() {
		return $this->autoCompile;
	}

	public function setAutoCompile($autoCompile) {
		$this->autoCompile = $autoCompile;
		return $this;
	}

	public function compile($internal=false){
		if($internal===false && $this->autoCompile===true)
			throw new \Exception("Impossible to compile if autoCompile is set to 'true'");
		foreach ($this->components as $component)
			$component->compile();
	}

	public function setJs(JsUtils $js){
		$this->js=$js;
		$this->_di=$js->getDi();
	}

	public function addComponent(SimpleComponent $component,$attachTo,$params){
		if($this->autoCompile)
			$this->components[]=$component;
		if(isset($attachTo))
			$component->attach($attachTo);
		if(isset($params))
			if(is_array($params))
				$component->setParams($params);
		return $component;
	}
}
