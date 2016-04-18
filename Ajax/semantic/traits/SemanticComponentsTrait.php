<?php

namespace Ajax\semantic\traits;
use Ajax\common\components\GenericComponent;
use Ajax\semantic\components\Popup;
use Ajax\semantic\components\Dropdown;
use Ajax\semantic\components\Accordion;
trait SemanticComponentsTrait {
	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return GenericComponent
	 */
	public function generic($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new GenericComponent($this->js), $attachTo, $params);
	}
	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Popup
	 */
	public function popup($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Popup($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Dropdown
	 */
	public function dropdown($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	/**
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Accordion
	 */
	public function accordion($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Accordion($this->js), $attachTo, $params);
	}

}