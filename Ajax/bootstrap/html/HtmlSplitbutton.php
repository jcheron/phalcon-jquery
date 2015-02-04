<?php
namespace Ajax\bootstrap\html;
use Ajax\bootstrap\html\HtmlDropdown;
/**
 * Twitter Bootstrap HTML Splitbutton component
 * @author jc
 * @version 1.001
 */
class HtmlSplitbutton extends HtmlDropdown {
	public function __construct($identifier) {
		parent::__construct ( $identifier );
		$this->_template=include 'templates/tplSplitbutton.php';
		$this->mClass="btn-group";
	}
}