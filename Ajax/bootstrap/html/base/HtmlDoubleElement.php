<?php
namespace Ajax\bootstrap\html\base;

use Ajax\JsUtils;
use Ajax\bootstrap\html\HtmlBadge;
use Ajax\bootstrap\html\HtmlLabel;
include_once 'HtmlSingleElement.php';

class HtmlDoubleElement extends HtmlSingleElement {
	protected $content;
	public function __construct($identifier,$tagName="p") {
		parent::__construct($identifier,$tagName);
		$this->_template="<%tagName% id='%identifier%' %properties%>%content%</%tagName%>";
	}

	public function setContent($content){
		$this->content=$content;
		return $this;
	}

	public function getContent() {
		return $this->content;
	}

	public function addContent($content){
		if(is_array($this->content)===false){
			$newContent=array();
			$newContent[]=$this->content;
			$newContent[]=$content;
			$this->content=$newContent;
		}else{
			$this->content[]=$content;
		}
		return $this;
	}

	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\html\HtmlSingleElement::run()
	 */
	public function run(JsUtils $js) {
		parent::run($js);
		if($this->content instanceof HtmlDoubleElement){
			$this->content->run($js);
		}else if(is_array($this->content)){
			foreach ($this->content as $itemContent){
				if($itemContent instanceof HtmlDoubleElement){
					$itemContent->run($js);
				}
			}
		}
	}

	public function addBadge($caption,$leftSeparator="&nbsp;"){
		$badge=new HtmlBadge("badge-".$this->identifier,$caption);
		$this->content.=$leftSeparator.$badge->compile();
		return $this;
	}

	public function addLabel($caption,$style="label-default",$leftSeparator="&nbsp;"){
		$label=new HtmlLabel("label-".$this->identifier,$caption,$style);
		$this->content.=$leftSeparator.$label->compile();
		return $this;
	}

}