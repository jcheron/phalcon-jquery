<?php
use Ajax\JsUtils;
include_once 'content/HtmlNavzone.php';

/**
 * Twitter Bootstrap HTML Navbar component
 * @author jc
 * @version 1.001
 */
class HtmlNavbar extends \BaseHtml {
	protected $navZones;
	protected $class="navbar-default";
	protected $brand="Brand";
	protected $brandHref="#";

	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier) {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplNavbar.php';
		$this->navZones=array();
		$this->class="navbar-default";
		$this->brand="Brand";
		$this->brandHref="#";
	}

	public function addZone($type="nav",$identifier=NULL){
		if(!isset($identifier)){
			$nb=sizeof($this->navZones)+1;
			$identifier=$this->identifier."-navzone-".$nb;
		}
		$zone=HtmlNavzone::$type($identifier);
		$this->navZones[]=$zone;
		return $zone;
	}
	public function addElement($element,HtmlNavzone $zone=NULL){
		if(!isset($zone)){
			$nb=sizeof($this->navZones);
			if($nb<1)
				$zone=$this->addZone();
			else
				$zone=$this->navZones[$nb-1];
		}
		if($element instanceof HtmlDropdown)
			$element->setMTagName("li");
		$zone->addElement($element);
	}
	public function getZone($index){
		$zone=null;
		$nb=sizeof($this->navZones);
		if(is_int($index)){
			if($index<$nb)
				$zone=$this->navZones[$index];
		}else{
			for($i=0;$i<$nb;$i++){
				if($zone->getIdentifier()===$index){
					$zone=$this->navZones[$i];
					break;
				}
			}
		}
		return $zone;
	}
	public function run(JsUtils $js) {
		foreach ($this->navZones as $zone)
			$zone->run($js);
	}
}