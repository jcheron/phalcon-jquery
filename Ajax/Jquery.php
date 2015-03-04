<?php
namespace Ajax;
/**
 * JQuery Phalcon library
 *
 * @author		jcheron
 * @version 	1.001
 * @license Apache 2 http://www.apache.org/licenses/
 */
function __autoload($myClass){
	if(file_exists("ui/components/".$myClass.".php")){
		require_once("ui/components/".$myClass.".php");
	}
	if(file_exists("bootstrap/html/".$myClass.".php")){
		require_once("bootstrap/html/".$myClass.".php");
	}
}
/**
 * Jquery Class
**/
class Jquery extends JsUtils{

	protected $libraryFile;
	protected $_javascript_folder = 'js';
	protected $jquery_code_for_load = array();
	protected $jquery_code_for_compile = array();
	protected $jquery_corner_active = FALSE;
	protected $jquery_table_sorter_active = FALSE;
	protected $jquery_table_sorter_pager_active = FALSE;
	protected $jquery_ajax_img = '';
	protected $jquery_events=array("bind","blur","change","click","dblclick","delegate","die","error",
			"focus","focusin","focusout","hover","keydown","keypress","keyup","live","load","mousedown",
			"mousseenter","mouseleave","mousemove","mouseout","mouseover","mouseup","off","on","one",
			"ready","resize","scroll","select","submit","toggle","trigger","triggerHandler","undind",
			"undelegate","unload"
	);

	public function __construct($params=array()){

	}

	public function getLibraryScript(){
		$assets=$this->_di->get('assets');
		$assets->addJs($this->libraryFile);
		return $assets->outputJs();
	}

	public function setLibraryFile($name){
		$this->libraryFile=$name;
	}
	// --------------------------------------------------------------------
	// Event Code
	// --------------------------------------------------------------------

	/**
	 * Blur
	 *
	 * Outputs a jQuery blur event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _blur($element = 'this', $js = ''){
		return $this->_add_event($element, $js, 'blur');
	}

	// --------------------------------------------------------------------

	/**
	 * Change
	 *
	 * Outputs a jQuery change event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _change($element = 'this', $js = ''){
		return $this->_add_event($element, $js, 'change');
	}

	// --------------------------------------------------------------------

	/**
	 * Click
	 *
	 * Outputs a jQuery click event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @param	boolean	whether or not to return false
	 * @return	string
	 */
	function _click($element = 'this', $js = '', $ret_false = TRUE){
		if ( ! is_array($js))
		{
			$js = array($js);
		}

		if ($ret_false)
		{
			$js[] = "return false;";
		}

		return $this->_add_event($element, $js, 'click');
	}

	// --------------------------------------------------------------------

	/**
	 * Double Click
	 *
	 * Outputs a jQuery dblclick event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _dblclick($element = 'this', $js = ''){
		return $this->_add_event($element, $js, 'dblclick');
	}

	// --------------------------------------------------------------------

	/**
	 * Error
	 *
	 * Outputs a jQuery error event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _error($element = 'this', $js = ''){
		return $this->_add_event($element, $js, 'error');
	}

	// --------------------------------------------------------------------

	/**
	 * Focus
	 *
	 * Outputs a jQuery focus event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _focus($element = 'this', $js = ''){
		return $this->_add_event($element, $js, 'focus');
	}

	// --------------------------------------------------------------------

	/**
	 * Hover
	 *
	 * Outputs a jQuery hover event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- Javascript code for mouse over
	 * @param	string	- Javascript code for mouse out
	 * @return	string
	 */
	function _hover($element = 'this', $over, $out){
		$event = "\n\t$(" . $this->_prep_element($element) . ").hover(\n\t\tfunction()\n\t\t{\n\t\t\t{$over}\n\t\t}, \n\t\tfunction()\n\t\t{\n\t\t\t{$out}\n\t\t});\n";

		$this->jquery_code_for_compile[] = $event;

		return $event;
	}

	// --------------------------------------------------------------------

	/**
	 * Keydown
	 *
	 * Outputs a jQuery keydown event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _keydown($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'keydown');
	}

	// --------------------------------------------------------------------

	/**
	 * Keyup
	 *
	 * Outputs a jQuery keydown event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _keyup($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'keyup');
	}

	// --------------------------------------------------------------------

	/**
	 * Load
	 *
	 * Outputs a jQuery load event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _load($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'load');
	}

	// --------------------------------------------------------------------

	/**
	 * Mousedown
	 *
	 * Outputs a jQuery mousedown event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _mousedown($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'mousedown');
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Out
	 *
	 * Outputs a jQuery mouseout event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _mouseout($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'mouseout');
	}

	// --------------------------------------------------------------------

	/**
	 * Mouse Over
	 *
	 * Outputs a jQuery mouseover event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _mouseover($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'mouseover');
	}

	// --------------------------------------------------------------------

	/**
	 * Mouseup
	 *
	 * Outputs a jQuery mouseup event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _mouseup($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'mouseup');
	}

	// --------------------------------------------------------------------

	/**
	 * Output
	 *
	 * Outputs script directly
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _output($array_js = '')
	{
		if ( ! is_array($array_js))
		{
			$array_js = array($array_js);
		}

		foreach ($array_js as $js)
		{
			$this->jquery_code_for_compile[] = "\t$js\n";
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Resize
	 *
	 * Outputs a jQuery resize event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _resize($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'resize');
	}

	// --------------------------------------------------------------------

	/**
	 * Scroll
	 *
	 * Outputs a jQuery scroll event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _scroll($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'scroll');
	}

	// --------------------------------------------------------------------

	/**
	 * Unload
	 *
	 * Outputs a jQuery unload event
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @return	string
	 */
	function _unload($element = 'this', $js = '')
	{
		return $this->_add_event($element, $js, 'unload');
	}

	// --------------------------------------------------------------------
	// Effects
	// --------------------------------------------------------------------

	/**
	 * Add Class
	 *
	 * Outputs a jQuery addClass event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param string $immediatly diffère l'exécution si false
	 * @return	string
	 */
	function _addClass($element = 'this', $class='',$immediatly=false){
		$element = $this->_prep_element($element);
		$class=$this->_prep_value($class);
		$str  = "$({$element}).addClass({$class});";
		if($immediatly)
			$this->jquery_code_for_compile[] = $str;
		return $str;
	}

	/**
	 * Get or set the value of an attribute for the first element in the set of matched elements or set one or more attributes for every matched element.
	 * @param string $element
	 * @param string $attributeName
	 * @param string $value
	 * @param string $immediatly diffère l'exécution si false
	 */
	function _attr($element = 'this' , $attributeName,$value="",$immediatly=false){
		$element = $this->_prep_element($element);
		if(isset($value)){
			$value=$this->_prep_value($value);
			$str  = "$({$element}).attr(\"$attributeName\",{$value});";
		}
		else
			$str  = "$({$element}).attr(\"$attributeName\");";
		if($immediatly)
			$this->jquery_code_for_compile[] = $str;
		return $str;
	}

	/**
	 * Get or set the html of an attribute for the first element in the set of matched elements.
	 * @param string $element
	 * @param string $value
	 * @param string $immediatly diffère l'exécution si false
	 */
	function _html($element = 'this' ,$value="",$immediatly=false){
		$element = $this->_prep_element($element);
		if(isset($value)){
			$value=$this->_prep_value($value);
			$str  = "$({$element}).html({$value});";
		}
		else
			$str  = "$({$element}).html();";
		if($immediatly)
			$this->jquery_code_for_compile[] = $str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Animate
	 *
	 * Outputs a jQuery animate event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _animate($element = 'this', $params = array(), $speed = '', $extra = ''){
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		$animations = "\t\t\t";

		foreach ($params as $param=>$value)
		{
			$animations .= $param.': \''.$value.'\', ';
		}

		$animations = substr($animations, 0, -2); // remove the last ", "

		if ($speed != '')
		{
			$speed = ', '.$speed;
		}

		if ($extra != '')
		{
			$extra = ', '.$extra;
		}

		$str  = "$({$element}).animate({\n$animations\n\t\t}".$speed.$extra.");";

		return $str;
	}

	/**
	 * Insert content, specified by the parameter $element, to the end of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @return string
	 */
	public function _append($to = 'this',$element){
		$to = $this->_prep_element($to);
		$element = $this->_prep_element($element);
		return "$({$to}).append({$element});";
	}

	/**
	 * Insert content, specified by the parameter $element, to the beginning of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @return string
	 */
	public function _prepend($to = 'this',$element){
		$to = $this->_prep_element($to);
		$element = $this->_prep_element($element);
		return "$({$to}).prepend({$element});";
	}

	// --------------------------------------------------------------------

	/**
	 * Fade In
	 *
	 * Outputs a jQuery hide event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _fadeIn($element = 'this', $speed = '', $callback = ''){
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).fadeIn({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Fade Out
	 *
	 * Outputs a jQuery hide event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _fadeOut($element = 'this', $speed = '', $callback = ''){
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).fadeOut({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Hide
	 *
	 * Outputs a jQuery hide action
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _hide($element = 'this', $speed = '', $callback = '')
	{
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).hide({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Remove Class
	 *
	 * Outputs a jQuery remove class event
	 *
	 * @access	private
	 * @param	string	- element
	 * @return	string
	 */
	function _removeClass($element = 'this', $class='')
	{
		$element = $this->_prep_element($element);
		$str  = "$({$element}).removeClass(\"$class\");";
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Up
	 *
	 * Outputs a jQuery slideUp event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _slideUp($element = 'this', $speed = '', $callback = '')
	{
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).slideUp({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Down
	 *
	 * Outputs a jQuery slideDown event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _slideDown($element = 'this', $speed = '', $callback = '')
	{
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).slideDown({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Slide Toggle
	 *
	 * Outputs a jQuery slideToggle event
	 *
	 * @access	public
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _slideToggle($element = 'this', $speed = '', $callback = '')
	{
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).slideToggle({$speed}{$callback});";

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Toggle
	 *
	 * Outputs a jQuery toggle event
	 *
	 * @access	private
	 * @param	string	- element
	 * @return	string
	 */
	function _toggle($element = 'this')
	{
		$element = $this->_prep_element($element);
		$str  = "$({$element}).toggle();";
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Toggle Class
	 *
	 * Outputs a jQuery toggle class event
	 *
	 * @access	private
	 * @param	string	- element
	 * @return	string
	 */
	function _toggleClass($element = 'this', $class='')
	{
		$element = $this->_prep_element($element);
		$str  = "$({$element}).toggleClass(\"$class\");";
		return $str;
	}

	/**
	 * Execute all handlers and behaviors attached to the matched elements for the given event.
	 * @param string $element
	 * @param string $event
	 */
	public function _trigger($element='this',$event='click'){
		$element = $this->_prep_element($element);
		$str  = "$({$element}).trigger(\"$event\");";
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Show
	 *
	 * Outputs a jQuery show event
	 *
	 * @access	private
	 * @param	string	- element
	 * @param	string	- One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param	string	- Javascript callback function
	 * @return	string
	 */
	function _show($element = 'this', $speed = '', $callback = '')
	{
		$element = $this->_prep_element($element);
		$speed = $this->_validate_speed($speed);

		if ($callback != '')
		{
			$callback = ", function(){\n{$callback}\n}";
		}

		$str  = "$({$element}).show({$speed}{$callback});";

		return $str;
	}

	function _condition($condition, $jsCodeIfTrue,$jsCodeIfFalse=null){
		$str="if(".$condition."){".$jsCodeIfTrue."}";
		if(isset($jsCodeIfFalse)){
			$str.="else{".$jsCodeIfFalse."}";
		}
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Updater
	 *
	 * An Ajax call that populates the designated DOM node with
	 * returned content
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	the controller to run the call against
	 * @param	string	optional parameters
	 * @return	string
	 */

	function _updater($container = 'this', $controller, $options = '')
	{
		$url=$this->_di->get("url");
		$container = $this->_prep_element($container);

		$controller = (strpos('://', $controller) === FALSE) ? $controller : $url->get($controller);

		// ajaxStart and ajaxStop are better choices here... but this is a stop gap
		if ($this->jquery_ajax_img == '')
		{
			$loading_notifier = "Loading...";
		}
		else
		{
			$loading_notifier = $this->_di->get("tag")->image($this->jquery_ajax_img);
		}

		$updater = "$($container).empty();\n"; // anything that was in... get it out
		$updater .= "\t\t$($container).prepend(\"$loading_notifier\");\n"; // to replace with an image

		$request_options = '';
		if ($options != '')
		{
			$request_options .= ", {";
			$request_options .= (is_array($options)) ? "'".implode("', '", $options)."'" : "'".str_replace(":", "':'", $options)."'";
			$request_options .= "}";
		}

		$updater .= "\t\t$($container).load('$controller'$request_options);";
		return $updater;
	}


	// --------------------------------------------------------------------
	// Pre-written handy stuff
	// --------------------------------------------------------------------

	/**
	 * Zebra tables
	 *
	 * @access	private
	 * @param	string	table name
	 * @param	string	plugin location
	 * @return	string
	 */
	function _zebraTables($class = '', $odd = 'odd', $hover = '')
	{
		$class = ($class != '') ? '.'.$class : '';

		$zebra  = "\t\$(\"table{$class} tbody tr:nth-child(even)\").addClass(\"{$odd}\");";

		$this->jquery_code_for_compile[] = $zebra;

		if ($hover != '')
		{
			$hover = $this->hover("table{$class} tbody tr", "$(this).addClass('hover');", "$(this).removeClass('hover');");
		}

		return $zebra;
	}



	// --------------------------------------------------------------------
	// Plugins
	// --------------------------------------------------------------------

	/**
	 * Corner Plugin
	 *
	 * http://www.malsup.com/jquery/corner/
	 *
	 * @access	public
	 * @param	string	target
	 * @return	string
	 */
	function corner($element = '', $corner_style = '')
	{
		// may want to make this configurable down the road
		$corner_location = '/plugins/jquery.corner.js';

		if ($corner_style != '')
		{
			$corner_style = '"'.$corner_style.'"';
		}

		return "$(" . $this->_prep_element($element) . ").corner(".$corner_style.");";
	}

	// --------------------------------------------------------------------

	/**
	 * modal window
	 *
	 * Load a thickbox modal window
	 *
	 * @access	public
	 * @return	void
	 */
	function modal($src, $relative = FALSE)
	{
		$this->jquery_code_for_load[] = $this->external($src, $relative);
	}

	// --------------------------------------------------------------------

	/**
	 * Effect
	 *
	 * Load an Effect library
	 *
	 * @access	public
	 * @return	void
	 */
	function effect($src, $relative = FALSE)
	{
		$this->jquery_code_for_load[] = $this->external($src, $relative);
	}

	// --------------------------------------------------------------------

	/**
	 * Plugin
	 *
	 * Load a plugin library
	 *
	 * @access	public
	 * @return	void
	 */
	function plugin($src, $relative = FALSE)
	{
		$this->jquery_code_for_load[] = $this->external($src, $relative);
	}

	// --------------------------------------------------------------------

	/**
	 * loadLibrary
	 *
	 * Load a user interface library
	 *
	 * @access	public
	 * @return	void
	 */
	function loadLibrary($src, $relative = FALSE)
	{
		$this->jquery_code_for_load[] = $this->external($src, $relative);
	}
	// --------------------------------------------------------------------

	/**
	 * Sortable
	 *
	 * Creates a jQuery sortable
	 *
	 * @access	public
	 * @return	void
	 */
	function sortable($element, $options = array())
	{

		if (count($options) > 0)
		{
			$sort_options = array();
			foreach ($options as $k=>$v)
			{
				$sort_options[] = "\n\t\t".$k.': '.$v."";
			}
			$sort_options = implode(",", $sort_options);
		}
		else
		{
			$sort_options = '';
		}

		return "$(" . $this->_prep_element($element) . ").sortable({".$sort_options."\n\t});";
	}

	// --------------------------------------------------------------------

	/**
	 * Table Sorter Plugin
	 *
	 * @access	public
	 * @param	string	table name
	 * @param	string	plugin location
	 * @return	string
	 */
	function tablesorter($table = '', $options = '')
	{
		$this->jquery_code_for_compile[] = "\t$(" . $this->_prep_element($table) . ").tablesorter($options);\n";
	}

	// --------------------------------------------------------------------
	// Class functions
	// --------------------------------------------------------------------

	/**
	 * Add Event
	 *
	 * Constructs the syntax for an event, and adds to into the array for compilation
	 *
	 * @access	private
	 * @param	string	The element to attach the event to
	 * @param	string	The code to execute
	 * @param	string	The event to pass
	 * @return	string
	 */
	function _add_event($element, $js, $event)
	{
		if (is_array($js))
		{
			$js = implode("\n\t\t", $js);

		}
		if(array_search($event, $this->jquery_events)===false)
			$event="\n\t$(" . $this->_prep_element($element) . ").bind('{$event}',function(event){\n\t\t{$js}\n\t});\n";
		else
			$event = "\n\t$(" . $this->_prep_element($element) . ").{$event}(function(event){\n\t\t{$js}\n\t});\n";
		$this->jquery_code_for_compile[] = $event;
		return $event;
	}

	// --------------------------------------------------------------------

	/**
	 * Compile
	 *
	 * As events are specified, they are stored in an array
	 * This function compiles them all for output on a page
	 *
	 * @access	private
	 * @return	string
	 */
	function _compile($view=NULL, $view_var = 'script_foot', $script_tags = TRUE)
	{
		//Components UI
		$ui=$this->ui();
		if($this->ui()!=NULL){
			if($ui->isAutoCompile()){
				$ui->compile(true);
			}
		}

		//Components UI
		$bootstrap=$this->bootstrap();
		if($this->bootstrap()!=NULL){
			if($bootstrap->isAutoCompile()){
				$bootstrap->compile(true);
			}
		}

		// External references
		$external_scripts = implode('', $this->jquery_code_for_load);
		extract(array('library_src' => $external_scripts));

		if (count($this->jquery_code_for_compile) == 0 )
		{
			// no inline references, let's just return
			return;
		}

		// Inline references
		$script = '$(document).ready(function() {' . "\n";
		$script .= implode('', $this->jquery_code_for_compile);
		$script .= '});';

		$output = ($script_tags === FALSE) ? $script : $this->inline($script);

		if($view!=NULL)
			$view->setVar($view_var,$output);
		return $output;
	}

	public function _addToCompile($jsScript){
		$this->jquery_code_for_compile[]=$jsScript;
	}

	// --------------------------------------------------------------------

	/**
	 * Clear Compile
	 *
	 * Clears the array of script events collected for output
	 *
	 * @access	public
	 * @return	void
	 */
	function _clear_compile()
	{
		$this->jquery_code_for_compile = array();
	}

	// --------------------------------------------------------------------

	/**
	 * Document Ready
	 *
	 * A wrapper for writing document.ready()
	 *
	 * @access	private
	 * @return	string
	 */
	function _document_ready($js)
	{
		if ( ! is_array($js))
		{
			$js = array ($js);

		}

		foreach ($js as $script)
		{
			$this->jquery_code_for_compile[] = $script;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Script Tag
	 *
	 * Outputs the script tag that loads the jquery.js file into an HTML document
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function script($library_src = '', $relative = FALSE)
	{
		$library_src = $this->external($library_src, $relative);
		$this->jquery_code_for_load[] = $library_src;
		return $library_src;
	}

	// --------------------------------------------------------------------

	/**
	 * Prep Element
	 *
	 * Puts HTML element in quotes for use in jQuery code
	 * unless the supplied element is the Javascript 'this'
	 * object, in which case no quotes are added
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function _prep_element($element){
		if (strrpos($element,'this')===false && strrpos($element,'event')===false){
			$element = '"'.$element.'"';
		}
		return $element;
	}

	/**
	 * Prep Value
	 *
	 * Puts HTML values in quotes for use in jQuery code
	 * unless the supplied value contains the Javascript 'this' or 'event'
	 * object, in which case no quotes are added
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function _prep_value($value){
		if (strrpos($value,'this')===false && strrpos($value,'event')===false){
			$value = '"'.$value.'"';
		}
		return $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate Speed
	 *
	 * Ensures the speed parameter is valid for jQuery
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function _validate_speed($speed)
	{
		if (in_array($speed, array('slow', 'normal', 'fast')))
		{
			$speed = '"'.$speed.'"';
		}
		elseif (preg_match("/[^0-9]/", $speed))
		{
			$speed = '';
		}

		return $speed;
	}
//------------------------------------------------------------------------
	protected function _get($url,$params="{}",$responseElement="",$function=NULL,$attr="id",$immediatly=false){
		$url=$this->_correctAjaxUrl($url);
		$function=isset($function)?$function:"";
		$retour="url='".$url."';\n";
		if($attr=="value")
			$retour.="url=url+'/'+$(this).val();\n";
		else
			$retour.="url=url+'/'+$(this).attr('".$attr."');\n";
		$retour.="$.get(url,".$params.").done(function( data ) {\n";
		if($responseElement!==""){
			$responseElement=$this->_prep_value($responseElement);
			$retour.="\t$({$responseElement}).html( data );\n";
		}
		$retour.="\t".$function."\n
		});\n";
		if($immediatly)
			$this->jquery_code_for_compile[] = $retour;
		return $retour;
	}

	/**
	 * Makes an ajax request and receives the JSON data types by assigning DOM elements with the same name
	 * @param string $url the request address
	 * @param string $params Paramètres passés au format JSON
	 * @param string $method Method use
	 * @param string $function callback
	 */
	public function _json($url,$method="get",$params="{}",$function=NULL,$attr="id",$immediatly=false){
		$url=$this->_correctAjaxUrl($url);
		$function=isset($function)?$function:"";
		$retour="url='".$url."';\n";
		if($attr=="value")
			$retour.="url=url+'/'+$(this).val();\n";
		else
			$retour.="url=url+'/'+$(this).attr('".$attr."');\n";
		$retour.="$.{$method}(url,".$params.").done(function( data ) {\n";
		$retour.="\tdata=$.parseJSON(data);for(var key in data){if($('#'+key).length){ if($('#'+key).is('[value]')) { $('#'+key).val(data[key]);} else { $('#'+key).html(data[key]); }}};\n";
		$retour.="\t".$function."\n
		});\n";
		if($immediatly)
			$this->jquery_code_for_compile[] = $retour;
		return $retour;
	}

	public function _post($url,$params="{}",$responseElement="",$function=NULL,$attr="id",$immediatly=false){
		$url=$this->_correctAjaxUrl($url);
		$function=isset($function)?$function:"";
		$retour="url='".$url."';\n";
		if($attr=="value")
			$retour.="url=url+'/'+$(this).val();\n";
		else
			$retour.="url=url+'/'+$(this).attr('".$attr."');\n";
		$retour.="$.post(url,".$params.").done(function( data ) {\n";
		if($responseElement!==""){
			$responseElement=$this->_prep_value($responseElement);
			$retour.="\t$({$responseElement}).html( data );\n";
		}
		$retour.="\t".$function."\n
		});\n";
		if($immediatly)
			$this->jquery_code_for_compile[] = $retour;
		return $retour;
	}
	public function _postForm($url,$form,$responseElement,$validation=false,$function=NULL,$attr="id",$immediatly=false){
		$url=$this->_correctAjaxUrl($url);
		$function=isset($function)?$function:"";
		$retour="url='".$url."';\n";
		if($attr=="value")
			$retour.="url=url+'/'+$(this).val();\n";
		else
			$retour.="url=url+'/'+$(this).attr('".$attr."');\n";
		$retour.="$.post(url,$(".$form.").serialize()).done(function( data ) {\n";
		if($responseElement!==""){
			$responseElement=$this->_prep_value($responseElement);
			$retour.="\t$({$responseElement}).html( data );\n";
		}
		$retour.="\t".$function."\n
		});\n";
		if($validation){
			$retour="$('#".$form."').validate({submitHandler: function(form) {
			".$retour."
			}});\n";
			$retour.="$('#".$form."').submit();\n";
		}
		if($immediatly)
			$this->jquery_code_for_compile[] = $retour;
		return $retour;
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
	public function _getAndBindTo($element,$event,$url,$params="{}",$responseElement="",$function=NULL,$attr="id"){
		$script= $this->_add_event($element,  $this->_get($url, $params,$responseElement,$function,$attr),$event);
		return $script;
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
	public function _postAndBindTo($element,$event,$url,$params="{}",$responseElement="",$function=NULL,$attr="id"){
		$script= $this->_add_event($element,  $this->_post($url, $params,$responseElement,$function,$attr),$event);
		return $script;
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
	public function _postFormAndBindTo($element,$event,$url,$form,$responseElement="",$validation=false,$function=NULL,$attr="id"){
		$script= $this->_add_event($element,  $this->_postForm($url,$form,$responseElement,$validation,$function,$attr));
		return $script;
	}

	/**
	 * Appelle la méthode JQuery $jqueryCall sur $element avec passage éventuel du/des paramètre/s $param
	 * @param string $element
	 * @param string $jqueryCall
	 * @param string/array $param
	 * @return mixed
	 */
	public function _doJQueryOn($element,$jqueryCall,$param="",$function="",$immediatly=false){
		if(is_array($param)){
			$param=implode(",", $param);
		}
		$callback="";
		if($function!="")
			$callback = ", function(event){\n{$function}\n}";
		$script= "$(".$this->_prep_element($element).").".$jqueryCall."(".$param.$callback.");\n";
		if($immediatly)
			$this->jquery_code_for_compile[] = $script;
		return $script;
	}

	/**
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $elementToModify
	 * @param string $jqueryCall
	 * @param string/array $param
	 */
	public function _doJQueryAndBindTo($element,$event,$elementToModify,$jqueryCall,$param="",$function=""){
		$script= $this->_add_event($element, $this->_doJQueryOn($elementToModify,$jqueryCall,$param,$function),$event);
		return $script;
	}

	/**
	 * Exécute le code $js
	 * @param string $js Code à exécuter
	 * @param string $immediatly diffère l'exécution si false
	 * @return String
	 */
	public function _exec($js,$immediatly=false){
		$script= $js."\n";
		if($immediatly)
			$this->jquery_code_for_compile[] = $script;
		return $script;
	}

	/**
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $js Code à exécuter
	 * @return String
	 */
	public function _execAndBindTo($element,$event,$js){
		$script= $this->_add_event($element, $this->_exec($js),$event);
		return $script;
	}
}

/* End of file Jquery.php */