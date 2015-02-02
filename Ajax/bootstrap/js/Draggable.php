<?php
namespace Ajax\bootstrap\Components\js;

use Ajax\common\JsCode;
class Draggable extends JsCode {

	public function __construct() {
		$this->mask="$('%identifier%').draggable({ handle: '.modal-header' });";
	}
}