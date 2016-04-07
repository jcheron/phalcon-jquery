<?php

namespace Ajax\semantic\html\elements;

use Ajax\service\JString;
use Ajax\semantic\html\base\HtmlSemDoubleElement;

class HtmlInput extends HtmlSemDoubleElement{

	public function __construct($identifier,$value="",$type="text",$placeholder=""){
		parent::__construct("div-".$identifier,"div","ui input");
		$this->content=new \Ajax\common\html\html5\HtmlInput($identifier,$type);
		$this->content->setProperty("value", $value);
		if(JString::isNotNull($placeholder))
			$this->content->setProperty("placeholder", $placeholder);
	}
}