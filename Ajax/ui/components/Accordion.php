<?php
namespace Ajax\ui\Components;

use Ajax\JsUtils;
use Phalcon\Text;
use Ajax\ui\Properties\Animation;
require_once 'SimpleComponent.php';
/**
 * Composant JQuery UI Accordion
 * @author jc
 * @version 1.001
 */
class Accordion extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->params=array("active"=>0);
		$this->uiName="accordion";
	}

	/**
	 * Which panel is currently open.
	 * Multiple types supported:
	 * Boolean: Setting active to false will collapse all panels.
	 * This requires the collapsible option to be true.
	 * Integer: The zero-based index of the panel that is active (open).
	 * A negative value selects panels going backward from the last panel.
	 * @param Boolean $value
	 * default : 0
	 */
	public function setActive($value){
		$this->setParam("active", $value);
		return $this;
	}

	/**
	 * If and how to animate changing panels.
	 * Multiple types supported:
	 * Boolean: A value of false will disable animations.
	 * Number: Duration in milliseconds with default easing.
	 * String: Name of easing to use with default duration.
	 * Object: Animation settings with easing and duration properties.
	 * Can also contain a down property with any of the above options.
	 * "Down" animations occur when the panel being activated has a lower index than the currently active panel.
	 * @param mixed $value
	 * default : {}
	 */
	public function setAnimate($value){
		if($value instanceof Animation)
			$value=$value->getParams();
		else
		if(is_string($value)){
			$animation=new Animation();
			$animation->setEasing($value);
		}
		$this->setParam("animate", $value);
		return $this;
	}

	/**
	 * Whether all the sections can be closed at once.
	 * Allows collapsing the active section.
	 * @param Boolean $value
	 * default : false
	 */
	public function setCollapsible($value){
		$this->setParamCtrl("collapsible", $value, "is_bool");
	}

	/**
	 * Disables the accordion if set to true.
	 * @param Boolean $value
	 * default : false
	 */
	public function setDisabled($value){
		$this->setParamCtrl("disabled", $value, "is_bool");
	}

	/**
	 * The event that accordion headers will react to in order to activate the associated panel.
	 * Multiple events can be specified, separated by a space.
	 * @param string $value
	 * default : click
	 */
	public function setEvent($value){
		$this->setParam("event", $value);
	}

	/**
	 * Selector for the header element, applied via .find() on the main accordion element.
	 * Content panels must be the sibling immediately after their associated headers.
	 * @param string $value css/JQuery Selector
	 * default : "> li > :first-child,> :not(li):even"
	 */
	public function setHeader($value){
		$this->setParam("header", $value);
	}

	/**
	 * Controls the height of the accordion and each panel. Possible values:
	 * "auto": All panels will be set to the height of the tallest panel.
	 * "fill": Expand to the available height based on the accordion's parent height.
	 * "content": Each panel will be only as tall as its content.
	 * @param String $value
	 * default : content
	 */
	public function setHeightStyle($value){
		$this->setParamCtrl("heightStyle", $value, array("auto","fill","content"));
	}

	/**
	 * Icons to use for headers, matching an icon provided by the jQuery UI CSS Framework. Set to false to have no icons displayed.
	 * header (string, default: "ui-icon-triangle-1-e")
	 * activeHeader (string, default: "ui-icon-triangle-1-s")
	 * @param String $value
	 * default : { "header": "ui-icon-triangle-1-e", "activeHeader": "ui-icon-triangle-1-s" }
	 */
	public function setIcons($value){
		if(is_string($value)){
			if(Text::startsWith($value,"{"));
				$value="%".$value."%";
		}
		$this->setParam("icons", $value);
	}

	/**
	 * Triggered after a panel has been activated (after animation completes).
	 * If the accordion was previously collapsed, ui.oldHeader and ui.oldPanel will be empty jQuery objects.
	 * If the accordion is collapsing, ui.newHeader and ui.newPanel will be empty jQuery objects.
	 * @param string $jsCode
	 */
	public function onActivate($jsCode){
		$this->addEvent("activate", $jsCode);
	}

	/**
	 * Triggered directly before a panel is activated. Can be canceled to prevent the panel from activating.
	 * If the accordion is currently collapsed, ui.oldHeader and ui.oldPanel will be empty jQuery objects.
	 * If the accordion is collapsing, ui.newHeader and ui.newPanel will be empty jQuery objects.
	 * @param string $jsCode
	 */
	public function onBeforeActivate($jsCode){
		$this->addEvent("beforeActivate", $jsCode);
	}

	/**
	 * Triggered when the accordion is created.
	 * If the accordion is collapsed, ui.header and ui.panel will be empty jQuery objects.
	 * @param string $jsCode
	 */
	public function onCreate($jsCode){
		$this->addEvent("create", $jsCode);
	}

}