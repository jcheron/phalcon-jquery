<?php
namespace Ajax;
use Ajax\common\BaseGui;
use Ajax\bootstrap\Components\Modal;
use Ajax\bootstrap\Components\Tooltip;
use Ajax\bootstrap\Components\Dropdown;
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
}