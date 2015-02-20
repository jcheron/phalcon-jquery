<?php
namespace Ajax\bootstrap\html;
use Ajax\JsUtils;
use Phalcon\Tag;
use Ajax\bootstrap\html\base\BaseHtml;
use Ajax\bootstrap\html\base\CssNavbar;
include_once 'content/HtmlNavzone.php';

/**
 * Twitter Bootstrap HTML Navbar component
 * @author jc
 * @version 1.001
 */
class HtmlNavbar extends BaseHtml {
	protected $navZones;
	protected $class="navbar-default";
	protected $brand="Brand";
	protected $brandHref="#";
	protected $brandImage="";

	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier,$brand="Brand",$brandHref="#") {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplNavbar.php';
		$this->navZones=array();
		$this->class="navbar-default";
		$this->brand=$brand;
		$this->brandHref=$brandHref;
	}

	public function setClass($class) {
		$this->class = $class;
		return $this;
	}

	public function setBrand($brand) {
		$this->brand = $brand;
		return $this;
	}

	public function setBrandHref($brandHref) {
		$this->brandHref = $brandHref;
		return $this;
	}

	public function setBrandImage($imageSrc) {
		$this->brandImage = Tag::image(array($imageSrc,"alt"=>$this->brand));
		$this->brand="";
		return $this;
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
		$zone=$this->getZoneToInsertIn($zone);
		if($element instanceof HtmlDropdown)
			$element->setMTagName("li");
		$zone->addElement($element);
	}

	public function addElements($elements,HtmlNavzone $zone=NULL){
		$zone=$this->getZoneToInsertIn($zone);
		$zone->addElements($elements);
	}


	/**
	/* (non-PHPdoc)
	 * @see BaseHtml::addProperties()
	 */
	public function fromArray($array) {
		return parent::fromArray($array);
	}

	public function setNavZones($navZones){
		if(is_array($navZones)){
			foreach ($navZones as $zoneType=>$zoneArray){
				if(is_string($zoneType)){
					$zone=$this->addZone($zoneType);
					$zone->fromArray($zoneArray);
				}else if(is_string($zoneArray))
					$this->addElement($zoneArray);
				else
					$this->addElements($zoneArray);
			}
		}
	}

	public function getZoneToInsertIn($zone=NULL){
		if(!isset($zone)){
			$nb=sizeof($this->navZones);
			if($nb<1)
				$zone=$this->addZone();
			else
				$zone=$this->navZones[$nb-1];
		}
		return $zone;
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
	public function cssInverse(){
		$this->addToMember($this->class, CssNavbar::NAVBAR_INVERSE);
	}
}