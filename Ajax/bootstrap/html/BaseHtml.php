<?php
class BaseHtml extends \BaseWidget {
	protected $tagName;
	protected $template;
	protected $properties=array();

	public function getProperties() {
		return $this->properties;
	}
	public function setProperties($properties) {
		$this->properties = $properties;
		return $this;
	}

	public function setProperty($name,$value){
		$this->properties[$name]=$value;
		return $this;
	}

	public function addProperties($properties){
		$this->properties=array_merge($this->properties,$properties);
		return $this;
	}
}