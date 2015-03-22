<?php
namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\JsUtils;
use Ajax\bootstrap\html\base\CssRef;
		/**
 * Twitter Bootstrap Alert component
 * @see http://getbootstrap.com/javascript/#alert
 * @author jc
 * @version 1.001
 */
class HtmlAlert extends HtmlDoubleElement {
	protected $button="";
	public function __construct($identifier,$message=NULL,$cssStyle="alert-warning") {
		parent::__construct ( $identifier, "div" );
		$this->_template='<div id="%identifier%" %properties%>%button%%content%</div>';
		$this->setClass("alert");
		$this->setRole("alert");
		$this->setStyle($cssStyle);
		if($message!=NULL){
			$this->content=$message;
		}
	}

	/**
	 * define the alert style
	 * avaible values : "alert-success","alert-info","alert-warning","alert-danger"
	 * @param string/int $cssStyle
	 * @return \Ajax\bootstrap\html\HtmlAlert
	 * default : "alert-succes"
	 */
	public function setStyle($cssStyle){
		return $this->addToPropertyCtrl("class", CssRef::getStyle($cssStyle, "alert"),CssRef::Styles("alert"));
	}

	public function addCloseButton(){
		$button=new HtmlButton("close-".$this->identifier);
		$button->setProperties(array("class"=>"close","data-dismiss"=>"alert","aria-label"=>"close"));
		$button->setValue('<span aria-hidden="true">&times;</span>');
		$this->addToPropertyCtrl("class", "alert-dismissible",array("alert-dismissible"));
		$this->button=$button;
	}

	public function onClose($jsCode){
		return $this->addEvent("close.bs.alert", $jsCode);
	}


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\HtmlDoubleElement::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->generic("#".$this->identifier);
		$this->addEventsOnRun();
		return $this->_bsComponent;
	}

}