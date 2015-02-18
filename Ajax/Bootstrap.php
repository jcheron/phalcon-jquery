<?php
namespace Ajax;
use Ajax\common\BaseGui;
use Ajax\bootstrap\Components\Modal;
use Ajax\bootstrap\Components\Tooltip;
use Ajax\bootstrap\Components\Dropdown;
use Ajax\bootstrap\Components\Tab;
use Ajax\bootstrap\Components\Collapse;
use Ajax\bootstrap\Components\Carousel;
use Ajax\bootstrap\Components\GenericComponent;
use Ajax\bootstrap\html\HtmlButton;
use Ajax\bootstrap\html\HtmlButtongroups;
include_once 'bootstrap/js/Draggable.php';
include_once 'common/JsCode.php';

class Bootstrap extends BaseGui{

	public function __construct($autoCompile = true) {
		parent::__construct($autoCompile);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function generic($attachTo=NULL,$params=NULL){
		return $this->addComponent(new GenericComponent($this->js), $attachTo, $params);
	}
	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function modal($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Modal($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function tooltip($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tooltip($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function dropdown($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function tab($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tab($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function collapse($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Collapse($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string $params
	 * @return $this
	 */
	public function carousel($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Carousel($this->js), $attachTo, $params);
	}

	public function htmlButton($identifier, $value="",$cssStyle=null,$onClick=null){
		$button=new HtmlButton($identifier,$value,$cssStyle,$onClick);
		return $this->addHtmlComponent($button);
	}

	public function htmlButtongroups($identifier, $values=null,$cssStyle=null,$size=null){
		$buttongroup=new HtmlButtongroups($identifier);
		if (isset($values)){
			$buttongroup->fromArray($values);
		}
		if (isset($cssStyle)){
			$buttongroup->setStyle($cssStyle);
		}
		if (isset($size)){
			$buttongroup->setSize($size);
		}
		return $this->addHtmlComponent($buttongroup);
	}
}