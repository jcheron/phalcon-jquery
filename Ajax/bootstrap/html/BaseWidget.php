<?php
/**
 * BaseWidget for Twitter Bootstrap components
 * @author jc
 * @version 1.001
 */
abstract class BaseWidget {
	protected $identifier;

	public function __construct($identifier){
		$this->identifier=$identifier;
	}

	public function getIdentifier() {
		return $this->identifier;
	}

	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
		return $this;
	}

}