<?php
class HtmlButton extends BaseHtml {
	protected $value;

	public function __construct($identifier) {
		$this->template="<button id='%identifier%' %properties%>%value%</button>";
	}

	public function setValue($value){
		$this->value=$value;
	}
}