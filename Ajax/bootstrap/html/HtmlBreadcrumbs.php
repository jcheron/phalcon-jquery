<?php
namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlDoubleElement;
use Ajax\bootstrap\html\HtmlLink;
use Ajax\JsUtils;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
/**
 * Twitter Bootstrap Breadcrumbs component
 * @author jc
 * @version 1.001
 */
class HtmlBreadcrumbs extends HtmlDoubleElement {
	/**
	 * @var boolean $autoActive sets the last element's class to <b>active</b> if true
	 */
	protected $autoActive;
	/**
	 * @var string the root site
	 */
	protected $root;
	
	/**
	 * @var String the html attribute which contains the elements url. default : data-ajax
	 */
	protected $attr;
	
	/**
	 * @var boolean if set to true, the path of the elements is absolute
	 */
	protected $absolutePaths;
	
	/**
	 * @var function the function who generates the href elements. default : function($e){return $e->getContent()}
	 */
	protected $_hrefFunction;
		
	/**
	 * @param string $identifier
	 * @param array $elements
	 * @param boolean $autoActive sets the last element's class to <b>active</b> if true
	 * @param function $hrefFunction the function who generates the href elements. default : function($e){return $e->getContent()}
	 */
	public function __construct($identifier,$elements=array(),$autoActive=true,$hrefFunction=NULL){
		parent::__construct($identifier,"ol");
		$this->setProperty("class", "breadcrumb");
		$this->content=array();
		$this->autoActive=$autoActive;
		$this->root="";
		$this->attr="data-ajax";
		$this->absolutePaths;
		$this->_hrefFunction=function ($e){return $e->getContent();};
		if(isset($hrefFunction)){
			$this->_hrefFunction=$hrefFunction;
		}
		$this->addElements($elements);
	}
	
	/**
	 * @param mixed $element
	 * @param string $href
	 * @return \Ajax\bootstrap\html\HtmlLink
	 */
	public function addElement($element,$href="",$glyph=NULL){
		$size=sizeof($this->content);
		if(is_array($element)){
			$elm=new HtmlLink("lnk-".$this->identifier."-".$size);
			$elm->fromArray($element);
		}else if($element instanceof HtmlLink){
			$elm=$element;
		}else{
			$elm=new HtmlLink("lnk-".$this->identifier."-".$size,$href,$element);
			if(isset($glyph)){
				$elm->wrapContentWithGlyph($glyph);
			}
		}
		$elm->wrap("<li>","</li>");
		$this->content[]=$elm;
		$elm->setProperty($this->attr, $this->getHref($size));
		return $elm;
	}
	
	public function setActive($index=null){
		if(!isset($index)){
			$index=sizeof($this->content)-1;
		}
		$li=new HtmlDoubleElement("","li");
		$li->setClass("active");
		$li->setContent($this->content[$index]->getContent());
		$this->content[$index]=$li;
	}
	
	public function addElements($elements){
		foreach ( $elements as $element ) {
			$this->addElement($element);
		}
		return $this;
	}
	
	public function fromArray($array){
		$array=parent::fromArray($array);
		$this->addElements($array);
		return $array;
	}
	
	/**
	 * Return the url of the element at $index or the breadcrumbs url if $index is ommited
	 * @param int $index
	 * @param string $separator
	 * @return string
	 */
	public function getHref($index=null,$separator="/"){
		if(!isset($index)){
			$index=sizeof($this->content);
		}
		if($this->absolutePaths===true){
			return $this->_hrefFunction($this->content[$index]);
		}else{
			return $this->root.implode($separator, array_slice(array_map(function($e){return $this->_hrefFunction($e);}, $this->content),0,$index+1));
		}
	}
	
	/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\BaseHtml::compile()
	 */
	public function compile(JsUtils $js=NULL, View $view=NULL) {
		if($this->autoActive){
			$this->setActive();
		}
		return parent::compile($js, $view);
	}
	
	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::fromDatabaseObject()
	 */
	public function fromDatabaseObject($object, $function) {
		return $this->addElement($function($object));
	}
	
		/*
	 * (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\base\BaseHtml::on()
	 */
	public function on($event, $jsCode, $stopPropagation=false, $preventDefault=false) {
		foreach ($this->content as $element){
			$element->on($event,$jsCode,$stopPropagation,$preventDefault);
		}
		return $this;
	}
	
	public function setAutoActive($autoActive) {
		$this->autoActive = $autoActive;
		return $this;
	}
	
	public function getRoot() {
		return $this->root;
	}
	
	public function setRoot($root) {
		$this->root = $root;
		return $this;
	}
	
	public function _ajaxOn($operation, $event, $url, $responseElement="", $parameters=array()) {
		foreach ($this->content as $element){
			$element->_ajaxOn($operation, $event, $url, $responseElement, $parameters);
		}
		return $this;
	}
	
	/**
	 * Associate an ajax get to the breadcrumbs elements, displayed in $targetSelector
	 * $attr member is used to build each element url
	 * @param string $targetSelector the target of the get
	 * @param string $attr the html attribute used to build the elements url 
	 * @return HtmlBreadcrumbs
	 */
	public function autoGetOnClick($targetSelector){
		return $this->getOnClick($this->root, $targetSelector,array("attr"=>$this->attr));
	}
	
	public function contentAsString(){
		if($this->autoActive){
			$this->setActive();
		}	
		return implode("", $this->content);
	}
	
	/**
	 * Generate the jquery script to set the elements to the breadcrumbs
	 * @param JsUtils $jsUtils
	 */
	public function jsSetContent(JsUtils $jsUtils){
		$jsUtils->html("#".$this->identifier,str_replace("\"","'", $this->contentAsString()),true);
	}
	
	public function getElement($index){
		return $this->content[$index];
	}
	
	/**
	 * Add a glyphicon to the element at index $index
	 * @param mixed $glyph
	 * @param int $index
	 */
	public function addGlyph($glyph,$index){
		$elm=$this->getElement($index);
		return $elm->wrapContentWithGlyph($glyph);
	}
	
	/**
	 * Add new elements in breadcrumbs corresponding to request dispatcher : controllerName, actionName, parameters
	 * @param Dispatcher $dispatcher the request dispatcher
	 * @return \Ajax\bootstrap\html\HtmlBreadcrumbs
	 */
	public function setDispatcher($dispatcher){
		$items=array($dispatcher->getControllerName(),$dispatcher->getActionName());
		$items=array_merge($items,$dispatcher->getParams());
		return $this->addElements($items);
	}
	
	public function __call($method, $args) {
		if(isset($this->$method) && is_callable($this->$method)) {
			return call_user_func_array(
					$this->$method,
					$args
					);
		}
	}
	
	/**
	 * sets the function who generates the href elements. default : function($element){return $element->getContent()}
	 * @param function $_hrefFunction
	 * @return \Ajax\bootstrap\html\HtmlBreadcrumbs
	 */
	public function setHrefFunction($_hrefFunction) {
		$this->_hrefFunction = $_hrefFunction;
		return $this;
	}
	
	/**
	 * Define the html attribute for each element url in ajax
	 * @param string $attr html attribute
	 * @return \Ajax\bootstrap\html\HtmlBreadcrumbs
	 */
	public function setAttr($attr) {
		$this->attr = $attr;
		return $this;
	}
	
	
}