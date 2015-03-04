<?php
namespace Ajax;
use Phalcon\Text;
use Ajax\config\DefaultConfig;
use Ajax\config\Config;
use Ajax\lib\CDNJQuery;
use Ajax\lib\CDNGuiGen;
use Ajax\lib\CDNBootstrap;
require_once 'lib/CDNJQuery.php';
require_once 'lib/CDNGuiGen.php';
require_once 'lib/CDNBootstrap.php';
require_once 'service/JArray.php';
require_once 'config/DefaultConfig.php';
/**
 * JQuery Phalcon library
 *
 * @author		jcheron
 * @version 	1.001
 * @license Apache 2 http://www.apache.org/licenses/
 */

/**
 * JsUtils Class : Phalcon service to be injected
 **/
class JsUtils implements \Phalcon\DI\InjectionAwareInterface{
	protected $_di;
	protected $js;
	protected $cdns;

	/**
	 * @var JqueryUI
	 */
	protected $_ui;

	/**
	 * @var Bootstrap
	 */
	protected $_bootstrap;

	/**
	 * @var Ajax\config\Config
	 */
	protected $config;

	public function ui($ui=NULL){
		if($ui!==NULL){
			$this->_ui=$ui;
			if($this->js!=null){
				$this->js->ui($ui);
				$ui->setJs($this);
				$bs=$this->bootstrap();
				if(isset($bs)){
					$this->conflict();
				}
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
				$ui=$this->ui();
				if(isset($ui)){
					$this->conflict();
				}
			}
		}
		return $this->_bootstrap;
	}

	protected function conflict(){
		$this->js->_addToCompile("var btn = $.fn.button.noConflict();$.fn.btn = btn;");
	}

	/**
	 * @param string $config
	 * @return \Ajax\config\Config
	 */
	public function config($config=NULL){
		if($config===NULL){
			if($this->config===NULL){
				$this->config=new DefaultConfig();
			}
		}elseif(is_array($config)){
			$this->config=new Config($config);
		}elseif($config instanceof Config){
			$this->config=$config;
		}
		return $this->config;
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
		$this->cdns=array();
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
	public function blur($element = 'this', $js = ''){
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
	public function change($element = 'this', $js = ''){
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
	public function click($element = 'this', $js = '', $ret_false = TRUE){
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
	public function dblclick($element = 'this', $js = ''){
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
	public function error($element = 'this', $js = ''){
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
	public function focus($element = 'this', $js = ''){
		return $this->js->__add_event($element, $js, "focus");
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
	public function hover($element = 'this', $over, $out){
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
	public function keydown($element = 'this', $js = ''){
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
	public function keyup($element = 'this', $js = ''){
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
	public function load($element = 'this', $js = ''){
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
	public function mousedown($element = 'this', $js = ''){
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
	public function mouseout($element = 'this', $js = ''){
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
	public function mouseover($element = 'this', $js = ''){
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
	public function mouseup($element = 'this', $js = ''){
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
	public function output($js){
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
	public function ready($js){
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
	public function resize($element = 'this', $js = ''){
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
	public function scroll($element = 'this', $js = ''){
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
	public function unload($element = 'this', $js = ''){
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
	public function addClass($element = 'this', $class = '',$immediatly=false){
		return $this->js->_addClass($element, $class,$immediatly);
	}

	/**
	 * Get or set the value of an attribute for the first element in the set of matched elements or set one or more attributes for every matched element.
	 * @param string $element
	 * @param string $attributeName
	 * @param string $value
	 * @param string $immediatly diffère l'exécution si false
	 */
	public function attr($element = 'this' , $attributeName,$value='',$immediatly=false){
		return $this->js->_attr($element, $attributeName,$value,$immediatly);
	}

	/**
	 * Get or set the html of an attribute for the first element in the set of matched elements.
	 * @param string $element
	 * @param string $value
	 * @param string $immediatly diffère l'exécution si false
	 */
	public function html($element = 'this',$value='',$immediatly=false){
		return $this->js->_html($element,$value,$immediatly);
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
	public function animate($element = 'this', $params = array(), $speed = '', $extra = ''){
		return $this->js->_animate($element, $params, $speed, $extra);
	}

	/**
	 * Insert content, specified by the parameter $element, to the end of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @return string
	 */
	public function append($to = 'this',$element){
		return $this->js->_append($to,$element);
	}

	/**
	 * Insert content, specified by the parameter $element, to the beginning of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @return string
	 */
	public function prepend($to = 'this',$element){
		return $this->js->_prepend($to,$element);
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
	public function fadeIn($element = 'this', $speed = '', $callback = ''){
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
	public function fadeOut($element = 'this', $speed = '', $callback = ''){
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
	public function slideUp($element = 'this', $speed = '', $callback = ''){
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
	public function removeClass($element = 'this', $class = ''){
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
	public function slideDown($element = 'this', $speed = '', $callback = ''){
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
	public function slideToggle($element = 'this', $speed = '', $callback = ''){
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
	public function hide($element = 'this', $speed = '', $callback = ''){
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
	public function toggle($element = 'this'){
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
	public function toggleClass($element = 'this', $class=''){
		return $this->js->_toggleClass($element, $class);
	}

	/**
	 * Execute all handlers and behaviors attached to the matched elements for the given event.
	 * @param string $element
	 * @param string $event
	 */
	public function trigger($element='this',$event='click'){
		return $this->js->_trigger($element, $event);
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
	public function show($element = 'this', $speed = '', $callback = ''){
		return $this->js->_show($element, $speed, $callback);
	}

	/**
	 * Allows to attach a condition
	 * @param string $condition
	 * @param string $jsCodeIfTrue
	 * @param string $jsCodeIfFalse
	 */
	function condition($condition,$jsCodeIfTrue,$jsCodeIfFalse=null){
		return $this->js->_condition($condition, $jsCodeIfTrue,$jsCodeIfFalse);
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
	function compile($view=NULL,$view_var = 'script_foot', $script_tags = TRUE){
		$bs=$this->_bootstrap;
		if(isset($bs) && isset($view)){
			$bs->compileHtml($this,$view);
		}
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
	function clear_compile(){
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
	public function generate_json($result = NULL, $match_array_type = FALSE){
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
	public function _is_associative_array($arr){
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
	function _prep_args($result, $is_key = FALSE){
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

	/**
	 * Makes a GET ajax request
	 * @param string $url Adresse de la requête
	 * @param string $params Paramètres passés au format JSON
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function get($url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_get($url,$params,$responseElement,$function,$attr,true);
	}

	/**
	 * Makes an ajax request and receives the JSON data types by assigning DOM elements with the same name
	 * @param string $url the request address
	 * @param string $params Paramètres passés au format JSON
	 * @param string $method Method use
	 * @param string $function callback
	 */
	public function json($url,$method="get",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_json($url,$method,$params,$function,$attr,true);
	}

	/**
	 * Makes an ajax request delayed and receives the JSON data types by assigning DOM elements with the same name
	 * @param string $url the request address
	 * @param string $params Paramètres passés au format JSON
	 * @param string $method Method use
	 * @param string $function callback
	 */
	public function jsonDeferred($url,$method="get",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_json($url,$method,$params,$function,$attr,false);
	}
	/**
	 * Prepare a Get ajax request
	 * To use on an event
	 * @param string $url Adresse de la requête
	 * @param string $params Paramètres passés au format JSON
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function getDeferred($url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_get($url,$params,$responseElement,$function,$attr,false);
	}

	/**
	 * Performs a get to $url on the event $event on $element
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
	 * Prépare un POST différé en ajax
	 * A utiliser sur un event
	 * @param string $url Adresse de la requête
	 * @param string $params Paramètres passés au format JSON
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function postDeferred($url,$responseElement="",$params="{}",$function=NULL,$attr="id"){
		return $this->js->_post($url,$params,$responseElement,$function,$attr,false);
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
	 * Performs a post form with ajax
	 * @param string $url Adresse de la requête
	 * @param string $form id du formulaire à poster
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function postForm($url,$form,$responseElement,$validation=false,$function=NULL,$attr="id"){
		return $this->js->_postForm($url, $form, $responseElement,$validation,$function,$attr,true);
	}

	/**
	 * Performs a delayed post form with ajax
	 * For use on an event
	 * @param string $url Adresse de la requête
	 * @param string $form id du formulaire à poster
	 * @param string $responseElement id de l'élément HTML affichant la réponse
	 * @param string $function fonction appelée éventuellement après réception
	 */
	public function postFormDeferred($url,$form,$responseElement,$validation=false,$function=NULL,$attr="id"){
		return $this->js->_postForm($url, $form, $responseElement,$validation,$function,$attr,false);
	}

	/**
	 * Performs a delayed post form with ajax in response to an event $event
	 * display the result in $responseElement
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
	 * Call the JQuery callback $someThing on $element with facultative parameter $param
	 * @param string $element
	 * @param string $someThing
	 * @param string $param
	 * @return mixed
	 */
	public function doJQueryOn($element,$jqueryCall,$param="",$function=""){
		return $this->js->_doJQueryOn($element, $jqueryCall,$param,$function,true);
	}

	/**
	 * Call the JQuery callback $someThing on $element with facultative parameter $param  in response to an event $event
	 * @param string $element
	 * @param string $event
	 * @param string $elementToModify
	 * @param string $jqueryCall
	 * @param string $param
	 * @param string $function
	 */
	public function doJQueryAndBindTo($element,$event,$elementToModify,$jqueryCall,$param="",$function=""){
		return $this->js->_doJQueryAndBindTo($element, $event,$elementToModify,$jqueryCall,$param,$function);
	}

	/**
	 * Exécute le code $js
	 * @param string $js Code to execute
	 * @param string $immediatly delayed if false
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
	public function getCDNs(){
		return $this->cdns;
	}

	public function setCDNs($cdns){
		if(is_array($cdns)===false){
			$cdns=array($cdns);
		}
		$this->cdns=$cdns;
	}
	public function genCDNs($template=NULL){
		$hasJQuery=false;
		$hasJQueryUI=false;
		$hasBootstrap=false;
		$result=array();
		foreach ($this->cdns as $cdn){
			switch (get_class($cdn)){
				case "Ajax\lib\CDNJQuery":
					$hasJQuery=true;
					$result[0]=$cdn;
					break;
				case "Ajax\lib\CDNJQuery":
						$hasJQueryUI=true;
						$result[1]=$cdn;
						break;
				case "Ajax\lib\CDNBootstrap":
						$hasBootstrap=true;
						$result[2]=$cdn;
						break;
			}
		}
		if($hasJQuery===false){
			$result[0]=new CDNJQuery("x");
		}
		if($hasJQueryUI===false && isset($this->_ui)){
			$result[1]=new CDNGuiGen("x",$template);
		}
		if($hasBootstrap===false && isset($this->_bootstrap)){
			$result[2]=new CDNBootstrap("x");
		}
		ksort($result);
		return implode("\n", $result);
	}
}
// END Javascript Class

/* End of file Javascript.php */
/* Location: ./library/ajax/jsUtils.php */