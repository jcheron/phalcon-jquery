<?php
namespace Ajax;
use Phalcon\Text;
require_once 'lib/CDNJQueryUI.php';
require_once 'lib/CDNGuiGen.php';
require_once 'lib/CDNBootstrap.php';
/**
 * JQuery Phalcon library
 *
 * @author		jcheron
 * @version 	1.001
 */

/**
 * JsUtils Class : Phalcon service to be injected
 **/
class JsUtils implements \Phalcon\DI\InjectionAwareInterface{
	protected $_di;
	protected $js;
	protected $dcns;

	/**
	 * @var JqueryUI
	 */
	protected $_ui;

	/**
	 * @var Bootstrap
	 */
	protected $_bootstrap;

	public function ui($ui=NULL){
		if($ui!==NULL){
			$this->_ui=$ui;
			if($this->js!=null){
				$this->js->ui($ui);
				$ui->setJs($this);
			}
		}
		return $this->_ui;
	}

	public function bootstrap($bootstrap=NULL){
		if($bootstrap!==NULL){
			$this->_bootstrap=$bootstrap;
			if($this->js!=null){
				$this->js->bootstrap($bootstrap);
				$bootstrap->setJs($this);
			}
		}
		return $this->_bootstrap;
	}

	public function setDi($di)
	{
		$this->_di = $di;
		if($this->js!=null && $di!=null)
			$this->js->setDi($di);
	}

	public function getDi()
	{
		return $this->_di;
	}

	public function getLibraryScript(){
		$assets=$this->_di->get('assets');
		$assets->addJs($this->libraryFile);
		return $assets->outputJs();
	}

	public function setLibraryFile($name){
		$this->libraryFile=$name;
	}
	public function __construct($params = array())
	{
		$defaults = array('driver' => 'Jquery');

		foreach ($defaults as $key => $val)
		{
			if (isset($params[$key]) && $params[$key] !== "")
			{
				$defaults[$key] = $params[$key];
			}
		}

		extract($defaults);
		$this->js=new Jquery();
		$this->dcns=array();
	}
	public function addToCompile($jsScript){
		$this->js->_addToCompile($jsScript);
	}
	// --------------------------------------------------------------------
	// Event Code
	// --------------------------------------------------------------------

	/**
	 * Blur
	 *
	 * Outputs a javascript library blur event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function blur($element = 'this', $js = '')
	{
		return $this->js->_blur($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Change
	 *
	 * Outputs a javascript library change event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function change($element = 'this', $js = '')
	{
		return $this->js->_change($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Click
	 *
	 * Outputs a javascript library click event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @param	boolean	whether or not to return false
	 * @return	string
	 */
	function click($element = 'this', $js = '', $ret_false = TRUE)
	{
		return $this->js->_click($element, $js, $ret_false);
	}

	// --------------------------------------------------------------------

	/**
	 * Double Click
	 *
	 * Outputs a javascript library dblclick event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function dblclick($element = 'this', $js = '')
	{
		return $this->js->_dblclick($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Error
	 *
	 * Outputs a javascript library error event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function error($element = 'this', $js = '')
	{
		return $this->js->_error($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Focus
	 *
	 * Outputs a javascript library focus event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function focus($element = 'this', $js = '')
	{
		return $this->js->__add_event($focus, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Hover
	 *
	 * Outputs a javascript library hover event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- Javascript code for mouse over
	 * @param	string	- Javascript code for mouse out
	 * @return	string
	 */
	function hover($element = 'this', $over, $out)
	{
		return $this->js->__hover($element, $over, $out);
	}

	// --------------------------------------------------------------------

	/**
	 * Keydown
	 *
	 * Outputs a javascript library keydown event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function keydown($element = 'this', $js = '')
	{
		return $this->js->_keydown($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Keyup
	 *
	 * Outputs a javascript library keydown event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function keyup($element = 'this', $js = '')
	{
		return $this->js->_keyup($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Load
	 *
	 * Outputs a javascript library load event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function load($element = 'this', $js = '')
	{
		return $this->js->_load($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mousedown
	 *
	 * Outputs a javascript library mousedown event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function mousedown($element = 'this', $js = '')
	{
		return $this->js->_mousedown($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Out
	 *
	 * Outputs a javascript library mouseout event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function mouseout($element = 'this', $js = '')
	{
		return $this->js->_mouseout($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Over
	 *
	 * Outputs a javascript library mouseover event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function mouseover($element = 'this', $js = '')
	{
		return $this->js->_mouseover($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Mouseup
	 *
	 * Outputs a javascript library mouseup event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function mouseup($element = 'this', $js = '')
	{
		return $this->js->_mouseup($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Output
	 *
	 * Outputs the called javascript to the screen
	 *
	 * @access	public
	 * @param	string	The code to output
	 * @return	string
	 */
	function output($js)
	{
		return $this->js->_output($js);
	}

	// --------------------------------------------------------------------

	/**
	 * Ready
	 *
	 * Outputs a javascript library mouseup event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function ready($js)
	{
		return $this->js->_document_ready($js);
	}

	// --------------------------------------------------------------------

	/**
	 * Resize
	 *
	 * Outputs a javascript library resize event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function resize($element = 'this', $js = '')
	{
		return $this->js->_resize($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Scroll
	 *
	 * Outputs a javascript library scroll event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function scroll($element = 'this', $js = '')
	{
		return $this->js->_scroll($element, $js);
	}

	// --------------------------------------------------------------------

	/**
	 * Unload
	 *
	 * Outputs a javascript library unload event
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function unload($element = 'this', $js = '')
	{
		return $this->js->_unload($element, $js);
	}

	// --------------------------------------------------------------------
	// Effects
	// --------------------------------------------------------------------


	/**
	 * Add Class
	 *
	 * Outputs a javascript library addClass event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- Class to add
	 * @param string $immediatly diffère l'exécution si false
	 * @return	string
	 */
	function addClass($element = 'this', $class = '',$immediatly=false){
		return $this->js->_addClass($element, $class,$immediatly);
	}

		/**
	 * Get or set the value of an attribute for the first element in the set of matched elements or set one or more attributes for every matched element.
	 * @param string $element
	 * @param string $attributeName
	 * @param string $value
	 * @param string $immediatly diffère l'exécution si false
	 */
	function attr($element = 'this' , $attributeName,$value='',$immediatly=false){
		return $this->js->_attr($element, $attributeName,$value,$immediatly);
	}

	// --------------------------------------------------------------------

	/**
	 * Animate
	 *
	 * Outputs a javascript library animate event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function animate($element = 'this', $params = array(), $speed = '', $extra = '')
	{
		return $this->js->_animate($element, $params, $speed, $extra);
	}

	// --------------------------------------------------------------------

	/**
	 * Fade In
	 *
	 * Outputs a javascript library hide event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function fadeIn($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_fadeIn($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Fade Out
	 *
	 * Outputs a javascript library hide event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function fadeOut($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_fadeOut($element, $speed, $callback);
	}
	// --------------------------------------------------------------------

	/**
	 * Slide Up
	 *
	 * Outputs a javascript library slideUp event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function slideUp($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_slideUp($element, $speed, $callback);

	}

	// --------------------------------------------------------------------

	/**
	 * Remove Class
	 *
	 * Outputs a javascript library removeClass event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- Class to add
	 * @return	string
	 */
	function removeClass($element = 'this', $class = '')
	{
		return $this->js->_removeClass($element, $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Down
	 *
	 * Outputs a javascript library slideDown event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function slideDown($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_slideDown($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Toggle
	 *
	 * Outputs a javascript library slideToggle event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function slideToggle($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_slideToggle($element, $speed, $callback);

	}

	// --------------------------------------------------------------------

	/**
	 * Hide
	 *
	 * Outputs a javascript library hide action
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function hide($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_hide($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Toggle
	 *
	 * Outputs a javascript library toggle event
	 *
	 * @access	public
	 * @param	string	- element
	 * @return	string
	 */
	function toggle($element = 'this')
	{
		return $this->js->_toggle($element);

	}

	// --------------------------------------------------------------------

	/**
	 * Toggle Class
	 *
	 * Outputs a javascript library toggle class event
	 *
	 * @access	public
	 * @param	string	- element
	 * @return	string
	 */
	function toggleClass($element = 'this', $class='')
	{
		return $this->js->_toggleClass($element, $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Show
	 *
	 * Outputs a javascript library show event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function show($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_show($element, $speed, $callback);
	}


	// --------------------------------------------------------------------

	/**
	 * Compile
	 *
	 * gather together all script needing to be output
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @return	string
	 */
	function compile($view=NULL,$view_var = 'script_foot', $script_tags = TRUE)
	{
		return $this->js->_compile($view,$view_var, $script_tags);
	}

	/**
	 * Clear Compile
	 *
	 * Clears any previous javascript collected for output
	 *
	 * @access	public
	 * @return	void
	 */
	function clear_compile()
	{
		$this->js->_clear_compile();
	}

	// --------------------------------------------------------------------

	/**
	 * External
	 *
	 * Outputs a <script> tag with the source as an external js file
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @return	string
	 */
	function external($external_file = '', $relative = FALSE){
		$assets=$this->_di->get('assets');
		$assets->addJs($external_file);
		return $assets->outputJs();
	}

	// --------------------------------------------------------------------

	/**
	 * Inline
	 *
	 * Outputs a <script> tag
	 *
	 * @access	public
	 * @param	string	The element to attach the event to
	 * @param	boolean	If a CDATA section should be added
	 * @return	string
	 */
	function inline($script, $cdata = TRUE)
	{
		$str = $this->_open_script();
		$str .= ($cdata) ? "\n// <![CDATA[\n{$script}\n// ]]>\n" : "\n{$script}\n";
		$str .= $this->_close_script();

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Open Script
	 *
	 * Outputs an opening <script>
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _open_script($src = '')
	{
		$str = '<script type="text/javascript" ';
		$str .= ($src == '') ? '>' : ' src="'.$src.'">';
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Close Script
	 *
	 * Outputs an closing </script>
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _close_script($extra = "\n")
	{
		return "</script>$extra";
	}


	// --------------------------------------------------------------------
	// --------------------------------------------------------------------
	// AJAX-Y STUFF - still a testbed
	// --------------------------------------------------------------------
	// --------------------------------------------------------------------

	/**
	 * Update
	 *
	 * Outputs a javascript library slideDown event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function update($element = 'this', $speed = '', $callback = '')
	{
		return $this->js->_updater($element, $speed, $callback);
	}

	// --------------------------------------------------------------------

	/**
	 * Generate JSON
	 *
	 * Can be passed a database result or associative array and returns a JSON formatted string
	 *
	 * @param	mixed	result set or array
	 * @param	bool	match array types (defaults to objects)
	 * @return	string	a json formatted string
	 */
	function generate_json($result = NULL, $match_array_type = FALSE)
	{
		// JSON data can optionally be passed to this function
		// either as a database result object or an array, or a user supplied array
		if ( ! is_null($result))
		{
			if (is_object($result))
			{
				$json_result = $result->result_array();
			}
			elseif (is_array($result))
			{
				$json_result = $result;
			}
			else
			{
				return $this->_prep_args($result);
			}
		}
		else
		{
			return 'null';
		}

		$json = array();
		$_is_assoc = TRUE;

		if ( ! is_array($json_result) AND empty($json_result))
		{
			show_error("Generate JSON Failed - Illegal key, value pair.");
		}
		elseif ($match_array_type)
		{
			$_is_assoc = $this->_is_associative_array($json_result);
		}

		foreach ($json_result as $k => $v)
		{
			if ($_is_assoc)
			{
				$json[] = $this->_prep_args($k, TRUE).':'.$this->generate_json($v, $match_array_type);
			}
			else
			{
				$json[] = $this->generate_json($v, $match_array_type);
			}
		}

		$json = implode(',', $json);

		return $_is_assoc ? "{".$json."}" : "[".$json."]";

	}

	// --------------------------------------------------------------------

	/**
	 * Is associative array
	 *
	 * Checks for an associative array
	 *
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _is_associative_array($arr)
	{
		foreach (array_keys($arr) as $key => $val)
		{
			if ($key !== $val)
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Prep Args
	 *
	 * Ensures a standard json value and escapes values
	 *
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _prep_args($result, $is_key = FALSE)
	{
		if (is_null($result))
		{
			return 'null';
		}
		elseif (is_bool($result))
		{
			return ($result === TRUE) ? 'true' : 'false';
		}
		elseif (is_string($result) OR $is_key)
		{
			return '"'.str_replace(array('\\', "\t", "\n", "\r", '"', '/'), array('\\\\', '\\t', '\\n', "\\r", '\"', '\/'), $result).'"';
		}
		elseif (is_scalar($result))
		{
			return $result;
		}
	}

	protected function _correctAjaxUrl($url){
		if(Text::endsWith($url,"/"))
			$url=substr($url, 0,strlen($url)-1);
		if(strncmp($url, 'http://', 7) != 0 AND strncmp($url, 'https://', 8) != 0){
			$url=$this->_di->get("url")->get($url);
		}
		return $url;
	}

	// --------------------------------------------------------------------
	// --------------------------------------------------------------------
	// AJAX STUFF - by jcheron
	// --------------------------------------------------------------------
	// --------------------------------------------------------------------
	/**
	 * Effectue un GET en ajax
	 * @param string $url Adresse de la requête
	 * @param string $params Paramètres passés au format JSON
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function get($url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_get($url,$params,$responseElement,$function,$attr,true);
	}

	/**
	 * Effectue un get vers $url sur l'évènement $event de $element en passant les paramètres $params
	 * puis affiche le résultat dans $responseElement
	 * @param string $element
	 * @param string $event
	 * @param string $url
	 * @param string $params
	 * @param string $responseElement
	 * @param string $function
	 */
	public function getAndBindTo($element,$event,$url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_getAndBindTo($element,$event,$url,$params,$responseElement,$function,$attr);
	}

	/**
	 * Effectue un POST en ajax
	 * @param string $url Adresse de la requête
	 * @param string $params Paramètres passés au format JSON
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function post($url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_post($url,$params,$responseElement,$function,$attr,true);
	}

	/**
	 * Effectue un post vers $url sur l'évènement $event de $element en passant les paramètres $params
	 * puis affiche le résultat dans $responseElement
	 * @param string $element
	 * @param string $event
	 * @param string $url
	 * @param string $params
	 * @param string $responseElement
	 * @param string $function
	 */
	public function postAndBindTo($element,$event,$url,$params="{}",$responseElement="",$function=NULL,$attr="id"){
		return $this->js->_postAndBindTo($element,$event,$url,$params,$responseElement,$function,$attr);
	}
	/**
	 * Effectue un POST d'un formulaire en ajax
	 * @param string $url Adresse de la requête
	 * @param string $form id du formulaire à poster
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function postForm($url,$form,$responseElement,$validation=false,$function=NULL,$attr="id"){
		return $this->js->_postForm($url, $form, $responseElement,$validation,$function,$attr);
	}

	/**
	 * Effectue un post vers $url sur l'évènement $event de $element en passant les paramètres du formulaire $form
	 * puis affiche le résultat dans $responseElement
	 * @param string $element
	 * @param string $event
	 * @param string $url
	 * @param string $form
	 * @param string $responseElement
	 * @param string $function
	 */
	public function postFormAndBindTo($element,$event,$url,$form,$responseElement="",$validation=false,$function=NULL,$attr="id"){
		return $this->js->_postFormAndBindTo($element, $event,$url,$form,$responseElement,$validation,$function,$attr);
	}

	/**
	 * Appelle la méthode JQuery $someThing sur $element avec passage éventuel du paramètre $param
	 * @param string $element
	 * @param string $someThing
	 * @param string $param
	 * @return mixed
	 */
	public function doJQueryOn($element,$jqueryCall,$param="",$function=""){
		return $this->js->_doJQueryOn($element, $jqueryCall,$param,$function,true);
	}

	/**
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $element
	 * @param string $someThing
	 * @param string $param
	 */
	public function doJQueryAndBindTo($element,$event,$elementToModify,$jqueryCall,$param="",$function=""){
		return $this->js->_doJQueryAndBindTo($element, $event,$elementToModify,$jqueryCall,$param,$function);
	}

	/**
	 * Exécute le code $js
	 * @param string $js Code à exécuter
	 * @param string $immediatly diffère l'exécution si false
	 * @return String
	 */
	public function exec($js,$immediatly=false){
		$script= $this->js->_exec($js,$immediatly);
		return $script;
	}

	/**
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $js Code à exécuter
	 * @return String
	 */
	public function execAndBindTo($element,$event,$js){
		$script= $this->js->_execAndBindTo($element,$event,$js);
		return $script;
	}
	public function getDCNs(){
		return $this->dcns;
	}

	public function setDCNs($dcns){
		$this->dcns=$dcns;
	}
	public function genDCNs($template=NULL){
		$hasJQuery=false;
		$hasJQueryUI=false;
		$hasBootstrap=false;
		$result="";
		foreach ($this->dcns as $dcn){
			if($dcn instanceof \CDNJQueryUI)
				$hasJQuery=true;
			if($dcn instanceof \CDNGuiGen)
				$hasJQueryUI=true;
			if($dcn instanceof \CDNBootsrap)
				$hasBootstrap=true;
			$result.="\n".$dcn;
		}
		if($hasJQuery===false)
			$result.="\n".new \CDNJQueryUI("x");
		if($hasJQueryUI===false && isset($this->_ui))
			$result.="\n".new \CDNGuiGen("x",$template);
		if($hasBootstrap===false && isset($this->_bootstrap))
			$result.="\n".new \CDNBootstrap("x");
		return $result;
	}
}
// END Javascript Class

/* End of file Javascript.php */
/* Location: ./system/libraries/Javascript.php */