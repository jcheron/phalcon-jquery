<?php
namespace Ajax\bootstrap\Components;

class GenericComponent extends SimpleBsComponent {


	/* (non-PHPdoc)
	 * @see \Ajax\bootstrap\Components\SimpleBsComponent::getScript()
	 */
	public function getScript() {
		$this->jquery_code_for_compile=array();
		foreach ($this->jsCodes as $jsCode){
			$this->jquery_code_for_compile[]=$jsCode->compile(array("identifier"=>$this->attachTo));
		}
		$this->compileEvents();
		return $this->compileJQueryCode();
	}

}