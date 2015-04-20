<?php

namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\JsUtils;
use Phalcon\Mvc\View;
use Ajax\service\PhalconUtils;

class HtmlProgressbar extends HtmlDoubleElement {
	protected $value;
	protected $max;
	protected $min;
	protected $striped="";
	protected $active;
	protected $caption;
	protected $isStacked=false;
	protected $style="";

	public function __construct($identifier, $style="info", $value=0, $max=100, $min=0) {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplProgressbar.php';
		$this->value=$value;
		$this->min=$min;
		$this->max=$max;
		$this->setStyle($style);
	}

	public function setActive($value) {
		if ($value===true)
			$this->active="active";
		else
			$this->active="";
		return $this;
	}

	public function setStriped($value) {
		if ($value===true)
			$this->striped="progress-bar-striped";
		else
			$this->striped="";
		return $this;
	}

	public function showCaption($value) {
		if ($value===true)
			$this->caption="%value%%";
		else
			$this->caption='<span class="sr-only">%value%% Complete (%style%)</span>';
		return $this;
	}

	public function getValue() {
		return $this->value;
	}

	public function stack(HtmlProgressbar $progressBar) {
		$this->_template='%content%';
		$progressBar->setIsStacked(true);
		$progressBar->showCaption($this->caption=="%value%%");
		$progressBar->setStriped($this->striped!=="");
		$progressBar->setActive($this->active==="active");
		if (is_array($this->content)===false) {
			$this->content=array ();
		}
		$this->content []=$progressBar;
	}

	public function setValue($value) {
		$this->value=$value;
		return $this;
	}

	public function getMax() {
		return $this->max;
	}

	public function setMax($max) {
		$this->max=$max;
		return $this;
	}

	public function getMin() {
		return $this->min;
	}

	public function setMin($min) {
		$this->min=$min;
		return $this;
	}

	public function getIsStacked() {
		return $this->isStacked;
	}

	public function setIsStacked($isStacked) {
		$this->isStacked=$isStacked;
		return $this;
	}

	/**
	 * define the progressbar style
	 * avaible values : "success","info","warning","danger"
	 * @param string|int $cssStyle
	 * @return \Ajax\bootstrap\html\HtmlProgressbar default : ""
	 */
	public function setStyle($cssStyle) {
		if (PhalconUtils::startsWith($cssStyle, "progress-bar-")===true) {
			$cssStyle=str_ireplace("progress-bar-", "", $cssStyle);
		}
		return $this->setMemberCtrl($this->style, $cssStyle, array (
				"success",
				"info",
				"warning",
				"danger" 
		));
	}

	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::compile()
	 */
	public function compile(JsUtils $js=NULL, View $view=NULL) {
		$this->_template=str_replace("%caption%", $this->caption, $this->_template);
		if ($this->getIsStacked()===false) {
			$this->wrap('<div class="progress">', '</div>');
		}
		return parent::compile($js, $view);
	}
}