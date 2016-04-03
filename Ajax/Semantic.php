<?php

namespace Ajax;

use Ajax\common\BaseGui;
use Ajax\semantic\html\HtmlButton;
use Ajax\semantic\html\HtmlIcon;
use Ajax\semantic\html\HtmlGroupIcons;
use Ajax\service\JArray;

class Semantic extends BaseGui {

	public function __construct($autoCompile=true) {
		parent::__construct($autoCompile=true);
	}

	/**
	 * Return a new Semantic Html Button
	 * @param string $identifier
	 * @param string $value
	 * @param string $cssStyle
	 * @param string $onClick
	 * @return HtmlButton
	 */
	public function htmlButton($identifier, $value="", $cssStyle=null, $onClick=null) {
		return $this->addHtmlComponent(new HtmlButton($identifier, $value, $cssStyle, $onClick));
	}

	public function htmlIcon($identifier,$icon){
		return $this->addHtmlComponent(new HtmlIcon($identifier, $icon));
	}

	public function htmlGroupIcons($identifier,$size="",$icons=array()){
		$group=new HtmlGroupIcons($identifier,$size);
		if(JArray::isAssociative($icons)){
			foreach ($icons as $icon=>$size){
				$group->addIcon($icon,$size);
			}
		}else{
			foreach ($icons as $icon){
				$group->addIcon($icon);
			}
		}
		return $this->addHtmlComponent($group);
	}
}