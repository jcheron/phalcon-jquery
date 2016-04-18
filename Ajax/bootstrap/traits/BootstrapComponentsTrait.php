<?php

namespace Ajax\bootstrap\traits;

use Ajax\common\components\GenericComponent;
use Ajax\bootstrap\components\Modal;
use Ajax\bootstrap\components\Tooltip;
use Ajax\bootstrap\components\Popover;
use Ajax\bootstrap\components\Dropdown;
use Ajax\bootstrap\components\Splitbutton;
use Ajax\bootstrap\components\Tab;
use Ajax\bootstrap\components\Carousel;
use Ajax\bootstrap\components\Collapse;
use Ajax\Bootstrap;

trait BootstrapComponentsTrait {

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function generic($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new GenericComponent($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function modal($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Modal($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function tooltip($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tooltip($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function popover($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Popover($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function dropdown($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Dropdown($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return $this
	 */
	public function splitbutton($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Splitbutton($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function tab($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Tab($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function collapse($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Collapse($this->js), $attachTo, $params);
	}

	/**
	 *
	 * @param string $attachTo
	 * @param string|array $params
	 * @return Bootstrap
	 */
	public function carousel($attachTo=NULL, $params=NULL) {
		return $this->addComponent(new Carousel($this->js), $attachTo, $params);
	}
}