<?php
namespace Ajax\bootstrap\Components;

use Ajax\bootstrap\Components\Tooltip;
use Ajax\JsUtils;
/**
 * Composant Twitter Bootstrap Popover
 * @author jc
 * @version 1.001
 */
class Popover extends Tooltip {
	public function __construct(JsUtils $js) {
		parent::__construct ( $js );
		$this->uiName="popover";
	}
}