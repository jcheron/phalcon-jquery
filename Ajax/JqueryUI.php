<?php
namespace Ajax;
use Phalcon\Text;
use Ajax\Components\Dialog;
require_once 'components/Dialog.php';
require_once 'components/Accordion.php';
require_once 'components/Menu.php';
require_once 'components/Progressbar.php';
require_once 'components/Selectmenu.php';
require_once 'components/Slider.php';
require_once 'components/Spinner.php';
require_once 'components/Autocomplete.php';
require_once 'components/Tabs.php';
/**
 * JQuery Phalcon library
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

	protected function addComponent($component){
		if($this->autoCompile)
			$this->components[]=$component;
		return $component;
	}
	/**
	 * Retourne un composant Dialog
	 * @return \Ajax\Components\Dialog
	 */
	public function dialog(){
		return $this->addComponent(new Dialog($this->js));
	}

	/**
	 * Retourne un composant Accordion
	 * @return \Ajax\Components\Accordion
	 */
	public function accordion(){
		return $this->addComponent(new \Accordion($this->js));
	}

	/**
	 * Retourne un composant Menu
	 * @return \Ajax\Components\Menu
	 */
	public function menu(){
		return $this->addComponent(new \Menu($this->js));
	}

	/**
	 * Retourne un composant Progressbar
	 * @return \Ajax\Components\Progressbar
	 */
	public function progressbar(){
		return $this->addComponent(new \Progressbar($this->js));
	}

	/**
	 * Retourne un composant Selectmenu
	 * @return \Ajax\Components\Selectmenu
	 */
	public function selectmenu(){
		return $this->addComponent(new \Selectmenu($this->js));
	}

	/**
	 * Retourne un composant Slider
	 * @return \Ajax\Components\Slider
	 */
	public function slider(){
		return $this->addComponent(new \Slider($this->js));
	}

	/**
	 * Retourne un composant Spinner
	 * @return \Ajax\Components\Spinner
	 */
	public function spinner(){
		return $this->addComponent(new \Spinner($this->js));
	}

	/**
	 * Retourne un composant Autocomplete
	 * @return \Ajax\Components\Autocomplete
	 */
	public function autocomplete(){
		return $this->addComponent(new \Autocomplete($this->js));
	}

	/**
	 * Create and return a Tabs component
	 * @return \Ajax\Components\Tabs
	 */
	public function tabs(){
		return $this->addComponent(new \Tabs($this->js));
	}
}
