<?php
namespace Ajax;
use Ajax\common\BaseGui;
use Ajax\bootstrap\Components\Modal;
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

}