<?php

namespace Ajax\semantic\html\base;

use Ajax\common\html\HtmlCollection;
use Ajax\semantic\html\base\traits\BaseTrait;
/**
 * Base class for Semantic Html collections
 * @author jc
 * @version 1.001
 */
abstract class HtmlSemCollection extends HtmlCollection{
	use BaseTrait;
	public function __construct( $identifier, $tagName="div",$baseClass="ui"){
		parent::__construct( $identifier, $tagName="div");
		$this->_baseClass=$baseClass;
		$this->setClass($baseClass);
	}
}