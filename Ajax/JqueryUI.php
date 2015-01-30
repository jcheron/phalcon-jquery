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
	/**
	 * @var JsUtils
	 */
	protected $js;

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

	/**
	 * Retourne un composant Dialog
	 * @return \Ajax\Components\Dialog
	 */
	public function dialog(){
		$result=new Dialog($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Accordion
	 * @return \Ajax\Components\Accordion
	 */
	public function accordion(){
		$result=new \Accordion($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Menu
	 * @return \Ajax\Components\Menu
	 */
	public function menu(){
		$result=new \Menu($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Progressbar
	 * @return \Ajax\Components\Progressbar
	 */
	public function progressbar(){
		$result=new \Progressbar($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Selectmenu
	 * @return \Ajax\Components\Selectmenu
	 */
	public function selectmenu(){
		$result=new \Selectmenu($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Slider
	 * @return \Ajax\Components\Slider
	 */
	public function slider(){
		$result=new \Slider($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Spinner
	 * @return \Ajax\Components\Spinner
	 */
	public function spinner(){
		$result=new \Spinner($this->js);
		return $result;
	}

	/**
	 * Retourne un composant Autocomplete
	 * @return \Ajax\Components\Autocomplete
	 */
	public function autocomplete(){
		$result=new \Autocomplete($this->js);
		return $result;
	}
}
