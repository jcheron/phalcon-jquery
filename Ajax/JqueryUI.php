<?php
namespace Ajax;
use Phalcon\Text;
use Ajax\ui\Components\SimpleComponent;
use Ajax\ui\Components\Dialog;
use Ajax\ui\Components\Accordion;
use Ajax\ui\Components\Menu;
use Ajax\ui\Components\Progressbar;
use Ajax\ui\Components\Selectmenu;
use Ajax\ui\Components\Slider;
use Ajax\ui\Components\Spinner;
use Ajax\ui\Components\Autocomplete;
use Ajax\ui\Components\Tabs;
use Ajax\ui\Components\Button;
use Ajax\ui\Components\Buttonset;
use Ajax\ui\Components\Tooltip;
require_once 'ui/components/Dialog.php';
require_once 'ui/components/Accordion.php';
require_once 'ui/components/Menu.php';
require_once 'ui/components/Progressbar.php';
require_once 'ui/components/Selectmenu.php';
require_once 'ui/components/Slider.php';
require_once 'ui/components/Spinner.php';
require_once 'ui/components/Autocomplete.php';
require_once 'ui/components/Tabs.php';
require_once 'ui/components/Button.php';
require_once 'ui/components/Buttonset.php';
require_once 'ui/components/Tooltip.php';

/**
 * JQuery UI Phalcon library
 *
 * @author		jcheron
 * @version 	1.001
 */

/**
 * Jquery JqueryUI
 **/
class JqueryUI{
	protected $libraryFiles;
	protected $_di;
	protected $autoCompile;
	protected $components;
	/**
	 * @var JsUtils
	 */
	protected $js;
	public function __construct($autoCompile=true){
		$this->autoCompile=$autoCompile;
		$this->components=array();
	}

	public function isAutoCompile() {
		return $this->autoCompile;
	}

	public function setAutoCompile($autoCompile) {
		$this->autoCompile = $autoCompile;
		return $this;
	}

	public function compile($internal=false){
		if($internal===false && $this->autoCompile===true)
			throw new \Exception("Impossible to compile if autoCompile is set to 'true'");
		foreach ($this->components as $component)
			$component->compile();
	}

	public function getLibraryScripts(){

		$assets=$this->_di->get('assets');
		foreach ($this->libraryFiles as $lib){
			if(Text::endsWith($lib, "js",true))
				$assets->addJs($lib);
			else if(Text::endsWith($lib, "css",true))
				$assets->addCss($lib);
		}
		return $assets->outputJs().$assets->outputCss();
	}

	public function setLibraryFiles($names){
		$this->libraryFiles=$names;
	}

	public function setJs(JsUtils $js){
		$this->js=$js;
		$this->_di=$js->getDi();
	}

	public function addComponent(SimpleComponent $component,$attachTo,$params){
		if($this->autoCompile)
			$this->components[]=$component;
		if(isset($attachTo))
			$component->attach($attachTo);
		if(isset($params))
			if(is_array($params))
				$component->setParams($params);
		return $component;
	}
	/**
	 * Retourne un composant Dialog
	 * @return \Ajax\Components\Dialog
	 */
	public function dialog($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Dialog($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Accordion
	 * @return \Ajax\Components\Accordion
	 */
	public function accordion($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Accordion($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Menu
	 * @return \Ajax\Components\Menu
	 */
	public function menu($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Menu($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Progressbar
	 * @return \Ajax\Components\Progressbar
	 */
	public function progressbar($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Progressbar($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Selectmenu
	 * @return \Ajax\Components\Selectmenu
	 */
	public function selectmenu($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Selectmenu($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Slider
	 * @return \Ajax\Components\Slider
	 */
	public function slider($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Slider($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Spinner
	 * @return \Ajax\Components\Spinner
	 */
	public function spinner($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Spinner($this->js),$attachTo,$params);
	}

	/**
	 * Retourne un composant Autocomplete
	 * @return \Ajax\Components\Autocomplete
	 */
	public function autocomplete($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Autocomplete($this->js),$attachTo,$params);
	}

	/**
	 * Create and return a Tabs component
	 * @return \Ajax\Components\Tabs
	 */
	public function tabs($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tabs($this->js),$attachTo,$params);
	}

	/**
	 * Create and return a Button component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\Button
	 */
	public function button($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Button($this->js),$attachTo,$params);
	}

	/**
	 * Create and return a ButtonSet component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\ButtonSet
	 */
	public function buttonSet($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Buttonset($this->js),$attachTo,$params);
	}

	/**
	 * Create and return a Tooltip component
	 * @param $attachTo css/jquery selector attached to the component
	 * @param $params php array of parameters
	 * @return \Ajax\Components\Tooltip
	 */
	public function tooltip($attachTo=NULL,$params=NULL){
		return $this->addComponent(new Tooltip($this->js),$attachTo,$params);
	}
}
