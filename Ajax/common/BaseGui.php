<?php

namespace Ajax\common;

use Ajax\JsUtils;
use Phalcon\Mvc\View;

/**
 * BaseGui Phalcon library
 * @author jcheron
 * @version 1.001
 */

/**
 * BaseGui
 */
class BaseGui {
	protected $_di;
	protected $autoCompile;
	protected $components;
	protected $htmlComponents;
	/**
	 *
	 * @var Ajax\JsUtils
	 */
	protected $js;

	public function __construct($autoCompile=true) {
		$this->autoCompile=$autoCompile;
		$this->components=array ();
		$this->htmlComponents=array ();
	}

	public function isAutoCompile() {
		return $this->autoCompile;
	}

	public function setAutoCompile($autoCompile) {
		$this->autoCompile=$autoCompile;
		return $this;
	}

	public function compile($internal=false) {
		if ($internal===false&&$this->autoCompile===true)
			throw new \Exception("Impossible to compile if autoCompile is set to 'true'");
		foreach ( $this->components as $component ) {
			$component->compile();
		}
	}

	public function setJs(JsUtils $js) {
		$this->js=$js;
		$this->_di=$js->getDi();
	}

	public function addComponent(SimpleComponent $component, $attachTo, $params) {
		if ($this->autoCompile)
			$this->components []=$component;
		if (isset($attachTo))
			$component->attach($attachTo);
		if (isset($params))
			if (is_array($params))
				$component->setParams($params);
		return $component;
	}

	public function addHtmlComponent($htmlComponent) {
		$this->htmlComponents []=$htmlComponent;
		return $htmlComponent;
	}

	public function compileHtml(JsUtils $js=NULL, View $view=NULL) {
		foreach ( $this->htmlComponents as $htmlComponent ) {
			$htmlComponent->compile($js, $view);
		}
	}
}
