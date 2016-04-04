<?php

namespace Ajax\semantic\html\elements;

use Ajax\common\html\HtmlSingleElement;
use Ajax\semantic\html\base\Size;
use Ajax\semantic\html\base\Color;
/**
 * Semantic Icon component
 * @see http://semantic-ui.com/elements/icon.html
 * @author jc
 * @version 1.001
 */
class HtmlIcon extends HtmlSingleElement {
	protected $icon;
	protected $size;
	protected $attributes;
	protected $color;

	public function __construct($identifier,$icon) {
		parent::__construct($identifier, "i");
		$this->icon=$icon;
		$this->_template='<i class="%icon% icon %size% %attributes% %color%"></i>';
	}

	public function getIcon() {
		return $this->icon;
	}

	/**
	 * sets the icon
	 * @param string $icon
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setIcon($icon) {
		$this->icon=$icon;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 * @see \Ajax\common\html\HtmlSingleElement::setSize()
	 */
	public function setSize($size) {
		$this->setMemberCtrl($this->size, $size,Size::getConstants());
		return $this;
	}

	public function setDisabled(){
		return $this->addToMember($this->attributes, "disabled");
	}

	/**
	 *  Icon used as a simple loader
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function asLoader(){
		return $this->addToMember($this->attributes, "loading");
	}

	/**
	 * An icon can be fitted, without any space to the left or right of it.
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setFitted(){
		return $this->addToMember($this->attributes, "fitted");
	}

	/**
	 * @param string $sens horizontally or vertically
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setFlipped($sens="horizontally"){
		return $this->addToMember($this->attributes, "flipped ".$sens);
	}

	/**
	 * @param string $sens clockwise or counterclockwise
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setRotated($sens="clockwise"){
		return $this->addToMember($this->attributes, "rotated ".$sens);
	}

	/**
	 * icon formatted as a link
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function asLink(){
		return $this->addToMember($this->attributes, "link");
	}

	public function setCircular($inverted=false){
		$invertedStr="";
		if($inverted!==false)
			$invertedStr=" inverted";
		return $this->addToMember($this->attributes, "circular".$invertedStr);
	}

	/**
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setInverted(){
		return $this->addToMember($this->attributes, "inverted");
	}

	/**
	 * @param string $inverted
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setBordered($inverted=false){
		$invertedStr="";
		if($inverted!==false)
			$invertedStr=" inverted";
			return $this->addToMember($this->attributes, "bordered".$invertedStr);
	}

	/**
	 * @param string $color
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function setColor($color){
		return $this->setMemberCtrl($this->color, $color, Color::getConstants());
	}

	/**
	 * @return \Ajax\semantic\html\HtmlIcon
	 */
	public function toCorner(){
		return $this->addToMember($this->attributes, "corner");
	}
}