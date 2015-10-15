<?php

namespace Ajax;

use Ajax\service\PhalconUtils;
use Ajax\service\JString;

/**
 * JQuery Phalcon library
 *
 * @author jcheron
 * @version 1.002
 * @license Apache 2 http://www.apache.org/licenses/
 */
/**
 * jQuery Class
 */
class Jquery {
	protected $_di;
	protected $_ui;
	protected $_bootstrap;
	protected $libraryFile;
	protected $_javascript_folder='js';
	protected $jquery_code_for_load=array ();
	protected $jquery_code_for_compile=array ();
	protected $jquery_corner_active=FALSE;
	protected $jquery_table_sorter_active=FALSE;
	protected $jquery_table_sorter_pager_active=FALSE;
	protected $ajaxLoader='<span></span><span></span><span></span><span></span><span></span>';
	protected $jquery_events=array (
			"bind","blur","change","click","dblclick","delegate","die","error","focus","focusin","focusout","hover","keydown","keypress","keyup","live","load","mousedown","mousseenter","mouseleave","mousemove","mouseout","mouseover","mouseup","off","on","one","ready","resize","scroll","select","submit","toggle","trigger","triggerHandler","undind","undelegate","unload"
	);

	public function setDi($di) {
		$this->_di=$di;
	}

	public function ui($ui=NULL) {
		if ($ui!==NULL) {
			$this->_ui=$ui;
		}
		return $this->_ui;
	}

	public function bootstrap($bootstrap=NULL) {
		if ($bootstrap!==NULL) {
			$this->_bootstrap=$bootstrap;
		}
		return $this->_bootstrap;
	}

	public function __construct() {
	}

	// --------------------------------------------------------------------

	/**
	 * Inline
	 *
	 * Outputs a <script> tag
	 *
	 * @access public
	 * @param string $script
	 * @param boolean $cdata a CDATA section should be added
	 * @return string
	 */
	public function inline($script, $cdata=TRUE) {
		$str=$this->_open_script();
		$str.=($cdata) ? "\n// <![CDATA[\n{$script}\n// ]]>\n" : "\n{$script}\n";
		$str.=$this->_close_script();

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Open Script
	 *
	 * Outputs an opening <script>
	 *
	 * @access private
	 * @param string $src
	 * @return string
	 */
	private function _open_script($src='') {
		$str='<script type="text/javascript" ';
		$str.=($src=='') ? '>' : ' src="'.$src.'">';
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Close Script
	 *
	 * Outputs an closing </script>
	 *
	 * @param string
	 * @return string
	 */
	private function _close_script($extra="\n") {
		return "</script>{$extra}";
	}

	public function getLibraryScript() {
		$assets=$this->_di->get('assets');
		$assets->addJs($this->libraryFile);
		return $assets->outputJs();
	}

	public function setLibraryFile($name) {
		$this->libraryFile=$name;
	}

	public function _setAjaxLoader($loader) {
		$this->ajaxLoader=$loader;
	}

	// --------------------------------------------------------------------
	// Event Code
	// --------------------------------------------------------------------

	/**
	 * Blur
	 *
	 * Outputs a jQuery blur event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _blur($element='this', $js='') {
		return $this->_add_event($element, $js, 'blur');
	}

	// --------------------------------------------------------------------

	/**
	 * Change
	 *
	 * Outputs a jQuery change event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _change($element='this', $js='') {
		return $this->_add_event($element, $js, 'change');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery click event
	 *
	 * @param string $element The element to attach the event to
	 * @param mixed $js The code to execute
	 * @param boolean $ret_false whether or not to return false
	 * @return string
	 */
	public function _click($element='this', $js=array(), $ret_false=TRUE) {
		if (!is_array($js)) {
			$js=array (
					$js
			);
		}

		if ($ret_false) {
			$js[]="return false;";
		}

		return $this->_add_event($element, $js, 'click');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery dblclick event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _dblclick($element='this', $js='') {
		return $this->_add_event($element, $js, 'dblclick');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery error event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _error($element='this', $js='') {
		return $this->_add_event($element, $js, 'error');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery focus event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _focus($element='this', $js='') {
		return $this->_add_event($element, $js, 'focus');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery hover event
	 *
	 * @param string - element
	 * @param string - Javascript code for mouse over
	 * @param string - Javascript code for mouse out
	 * @return string
	 */
	public function _hover($element='this', $over, $out) {
		$event="\n\t$(".$this->_prep_element($element).").hover(\n\t\tfunction()\n\t\t{\n\t\t\t{$over}\n\t\t}, \n\t\tfunction()\n\t\t{\n\t\t\t{$out}\n\t\t});\n";

		$this->jquery_code_for_compile[]=$event;

		return $event;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery keydown event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _keydown($element='this', $js='') {
		return $this->_add_event($element, $js, 'keydown');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery keypress event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _keypress($element='this', $js='') {
		return $this->_add_event($element, $js, 'keypress');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery keydown event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _keyup($element='this', $js='') {
		return $this->_add_event($element, $js, 'keyup');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery load event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _load($element='this', $js='') {
		return $this->_add_event($element, $js, 'load');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery mousedown event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _mousedown($element='this', $js='') {
		return $this->_add_event($element, $js, 'mousedown');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery mouseout event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _mouseout($element='this', $js='') {
		return $this->_add_event($element, $js, 'mouseout');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery mouseover event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _mouseover($element='this', $js='') {
		return $this->_add_event($element, $js, 'mouseover');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery mouseup event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _mouseup($element='this', $js='') {
		return $this->_add_event($element, $js, 'mouseup');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs script directly
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _output($array_js='') {
		if (!is_array($array_js)) {
			$array_js=array (
					$array_js
			);
		}

		foreach ( $array_js as $js ) {
			$this->jquery_code_for_compile[]="\t$js\n";
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery resize event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _resize($element='this', $js='') {
		return $this->_add_event($element, $js, 'resize');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery scroll event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _scroll($element='this', $js='') {
		return $this->_add_event($element, $js, 'scroll');
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery unload event
	 *
	 * @param string The element to attach the event to
	 * @param string The code to execute
	 * @return string
	 */
	public function _unload($element='this', $js='') {
		return $this->_add_event($element, $js, 'unload');
	}

	// --------------------------------------------------------------------
	// Effects
	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery addClass event
	 *
	 * @param string - element
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _addClass($element='this', $class='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$class=$this->_prep_value($class);
		$str="$({$element}).addClass({$class});";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Get or set the value of an attribute for the first element in the set of matched elements or set one or more attributes for every matched element.
	 * @param string $element
	 * @param string $attributeName
	 * @param string $value
	 * @param boolean $immediatly delayed if false
	 */
	public function _attr($element='this', $attributeName, $value="", $immediatly=false) {
		$element=$this->_prep_element($element);
		if (isset($value)) {
			$value=$this->_prep_value($value);
			$str="$({$element}).attr(\"$attributeName\",{$value});";
		} else
			$str="$({$element}).attr(\"$attributeName\");";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Get or set the html of an attribute for the first element in the set of matched elements.
	 * @param string $element
	 * @param string $value
	 * @param boolean $immediatly delayed if false
	 */
	public function _html($element='this', $value="", $immediatly=false) {
		$element=$this->_prep_element($element);
		if (isset($value)) {
			$value=$this->_prep_value($value);
			$str="$({$element}).html({$value});";
		} else
			$str="$({$element}).html();";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery animate event
	 *
	 * @param string $element element
	 * @param string|array $params One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $speed
	 * @param string $extra
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _animate($element='this', $params=array(), $speed='', $extra='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		$animations="\t\t\t";
		if (is_array($params)) {
			foreach ( $params as $param => $value ) {
				$animations.=$param.': \''.$value.'\', ';
			}
		}
		$animations=substr($animations, 0, -2); // remove the last ", "

		if ($speed!='') {
			$speed=', '.$speed;
		}

		if ($extra!='') {
			$extra=', '.$extra;
		}

		$str="$({$element}).animate({\n$animations\n\t\t}".$speed.$extra.");";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Insert content, specified by the parameter $element, to the end of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _append($to='this', $element, $immediatly=false) {
		$to=$this->_prep_element($to);
		$element=$this->_prep_element($element);
		$str="$({$to}).append({$element});";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Insert content, specified by the parameter $element, to the beginning of each element in the set of matched elements $to.
	 * @param string $to
	 * @param string $element
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _prepend($to='this', $element, $immediatly=false) {
		$to=$this->_prep_element($to);
		$element=$this->_prep_element($element);
		$str="$({$to}).prepend({$element});";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery hide event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _fadeIn($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).fadeIn({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery hide event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _fadeOut($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).fadeOut({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery hide action
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _hide($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).hide({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery remove class event
	 *
	 * @param string $element element
	 * @param string $class
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _removeClass($element='this', $class='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$str="$({$element}).removeClass(\"$class\");";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery slideUp event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _slideUp($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).slideUp({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery slideDown event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _slideDown($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).slideDown({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery slideToggle event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _slideToggle($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).slideToggle({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery toggle event
	 *
	 * @param string $element element
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _toggle($element='this', $immediatly=false) {
		$element=$this->_prep_element($element);
		$str="$({$element}).toggle();";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery toggle class event
	 *
	 * @param string $element element
	 * @param string $class
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _toggleClass($element='this', $class='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$str="$({$element}).toggleClass(\"$class\");";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Execute all handlers and behaviors attached to the matched elements for the given event.
	 * @param string $element
	 * @param string $event
	 * @param boolean $immediatly delayed if false
	 */
	public function _trigger($element='this', $event='click', $immediatly=false) {
		$element=$this->_prep_element($element);
		$str="$({$element}).trigger(\"$event\");";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Outputs a jQuery show event
	 *
	 * @param string $element element
	 * @param string $speed One of 'slow', 'normal', 'fast', or time in milliseconds
	 * @param string $callback Javascript callback function
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _show($element='this', $speed='', $callback='', $immediatly=false) {
		$element=$this->_prep_element($element);
		$speed=$this->_validate_speed($speed);

		if ($callback!='') {
			$callback=", function(){\n{$callback}\n}";
		}

		$str="$({$element}).show({$speed}{$callback});";

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	/**
	 * Places a condition
	 * @param string $condition
	 * @param string $jsCodeIfTrue
	 * @param string $jsCodeIfFalse
	 * @param boolean $immediatly delayed if false
	 * @return string
	 */
	public function _condition($condition, $jsCodeIfTrue, $jsCodeIfFalse=null, $immediatly=false) {
		$str="if(".$condition."){".$jsCodeIfTrue."}";
		if (isset($jsCodeIfFalse)) {
			$str.="else{".$jsCodeIfFalse."}";
		}

		if ($immediatly)
			$this->jquery_code_for_compile[]=$str;
		return $str;
	}

	// --------------------------------------------------------------------
	// Plugins
	// --------------------------------------------------------------------

	/**
	 * Creates a jQuery sortable
	 *
	 * @param string $element
	 * @param array $options
	 * @return void
	 */
	public function sortable($element, $options=array()) {
		if (count($options)>0) {
			$sort_options=array ();
			foreach ( $options as $k => $v ) {
				$sort_options[]="\n\t\t".$k.': '.$v."";
			}
			$sort_options=implode(",", $sort_options);
		} else {
			$sort_options='';
		}

		return "$(".$this->_prep_element($element).").sortable({".$sort_options."\n\t});";
	}

	// --------------------------------------------------------------------

	/**
	 * Table Sorter Plugin
	 *
	 * @param string $table table name
	 * @param string $options plugin location
	 * @return string
	 */
	public function tablesorter($table='', $options='') {
		$this->jquery_code_for_compile[]="\t$(".$this->_prep_element($table).").tablesorter($options);\n";
	}

	// --------------------------------------------------------------------
	// Class functions
	// --------------------------------------------------------------------

	/**
	 * Constructs the syntax for an event, and adds to into the array for compilation
	 *
	 * @param string $element The element to attach the event to
	 * @param string $js The code to execute
	 * @param string $event The event to pass
	 * @param boolean $preventDefault If set to true, the default action of the event will not be triggered.
	 * @param boolean $stopPropagation Prevents the event from bubbling up the DOM tree, preventing any parent handlers from being notified of the event.
	 * @return string
	 */
	public function _add_event($element, $js, $event, $preventDefault=false, $stopPropagation=false) {
		if (is_array($js)) {
			$js=implode("\n\t\t", $js);
		}
		if ($preventDefault===true) {
			$js="event.preventDefault();\n".$js;
		}
		if ($stopPropagation===true) {
			$js="event.stopPropagation();\n".$js;
		}
		if (array_search($event, $this->jquery_events)===false)
			$event="\n\t$(".$this->_prep_element($element).").bind('{$event}',function(event){\n\t\t{$js}\n\t});\n";
		else
			$event="\n\t$(".$this->_prep_element($element).").{$event}(function(event){\n\t\t{$js}\n\t});\n";
		$this->jquery_code_for_compile[]=$event;
		return $event;
	}

	// --------------------------------------------------------------------

	/**
	 * As events are specified, they are stored in an array
	 * This function compiles them all for output on a page
	 * @param view $view
	 * @param string $view_var
	 * @param boolean $script_tags
	 * @return string
	 */
	public function _compile($view=NULL, $view_var='script_foot', $script_tags=TRUE) {
		// Components UI
		$ui=$this->ui();
		if ($this->ui()!=NULL) {
			if ($ui->isAutoCompile()) {
				$ui->compile(true);
			}
		}

		// Components UI
		$bootstrap=$this->bootstrap();
		if ($this->bootstrap()!=NULL) {
			if ($bootstrap->isAutoCompile()) {
				$bootstrap->compile(true);
			}
		}

		// External references
		$external_scripts=implode('', $this->jquery_code_for_load);
		extract(array (
				'library_src' => $external_scripts
		));

		if (count($this->jquery_code_for_compile)==0) {
			// no inline references, let's just return
			return;
		}

		// Inline references
		$script='$(document).ready(function() {'."\n";
		$script.=implode('', $this->jquery_code_for_compile);
		$script.='});';

		$output=($script_tags===FALSE) ? $script : $this->inline($script);

		if ($view!=NULL)
			$view->setVar($view_var, $output);
		return $output;
	}

	public function _addToCompile($jsScript) {
		$this->jquery_code_for_compile[]=$jsScript;
	}

	// --------------------------------------------------------------------

	/**
	 * Clears the array of script events collected for output
	 *
	 * @return void
	 */
	public function _clear_compile() {
		$this->jquery_code_for_compile=array ();
	}

	// --------------------------------------------------------------------

	/**
	 * A wrapper for writing document.ready()
	 *
	 * @return string
	 */
	public function _document_ready($js) {
		if (!is_array($js)) {
			$js=array (
					$js
			);
		}

		foreach ( $js as $script ) {
			$this->jquery_code_for_compile[]=$script;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Puts HTML element in quotes for use in jQuery code
	 * unless the supplied element is the Javascript 'this'
	 * object, in which case no quotes are added
	 *
	 * @param string $element
	 * @return string
	 */
	public function _prep_element($element) {
		if (strrpos($element, 'this')===false&&strrpos($element, 'event')===false) {
			$element='"'.$element.'"';
		}
		return $element;
	}

	/**
	 * Puts HTML values in quotes for use in jQuery code
	 * unless the supplied value contains the Javascript 'this' or 'event'
	 * object, in which case no quotes are added
	 *
	 * @param string $value
	 * @return string
	 */
	public function _prep_value($value) {
		if (is_array($value)) {
			$value=implode(",", $value);
		}
		if (strrpos($value, 'this')===false&&strrpos($value, 'event')===false) {
			$value='"'.$value.'"';
		}
		return $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Ensures the speed parameter is valid for jQuery
	 *
	 * @param string|int $speed
	 * @return string
	 */
	private function _validate_speed($speed) {
		if (in_array($speed, array (
				'slow','normal','fast'
		))) {
			$speed='"'.$speed.'"';
		} elseif (preg_match("/[^0-9]/", $speed)) {
			$speed='';
		}

		return $speed;
	}
	// ------------------------------------------------------------------------
	protected function addLoading(&$retour, $responseElement) {
		$loading_notifier='<div class="ajax-loader">';
		if ($this->ajaxLoader=='') {
			$loading_notifier.="Loading...";
		} else {
			$loading_notifier.=$this->ajaxLoader;
		}
		$loading_notifier.='</div>';
		$retour.="$(\"{$responseElement}\").empty();\n";
		$retour.="\t\t$(\"{$responseElement}\").prepend('{$loading_notifier}');\n";
	}

	public function _get($url, $params="{}", $responseElement="", $jsCallback=NULL, $attr="id", $immediatly=false) {
		return $this->_ajax("get", $url,$params,$responseElement,$jsCallback,$attr,$immediatly);
	}
	public function _post($url, $params="{}", $responseElement="", $jsCallback=NULL, $attr="id", $immediatly=false) {
		return $this->_ajax("post", $url,$params,$responseElement,$jsCallback,$attr,$immediatly);
	}

	protected function _ajax($method,$url, $params="{}", $responseElement="", $jsCallback=NULL, $attr="id", $immediatly=false) {
		if(JString::isNull($params)){$params="{}";}
		$jsCallback=isset($jsCallback) ? $jsCallback : "";
		$retour=$this->_getAjaxUrl($url, $attr);
		$this->addLoading($retour, $responseElement);
		$retour.="$.".$method."(url,".$params.").done(function( data ) {\n";
		$retour.=$this->_getOnAjaxDone($responseElement, $jsCallback)."});\n";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$retour;
		return $retour;
	}

	protected function _getAjaxUrl($url,$attr){
		$url=$this->_correctAjaxUrl($url);
		$retour="url='".$url."';\n";
		if(JString::isNotNull($attr)){
			if ($attr=="value")
				$retour.="url=url+'/'+$(this).val();\n";
			else
				$retour.="url=url+'/'+$(this).attr('".$attr."');\n";
		}
		return $retour;
	}

	protected function _getOnAjaxDone($responseElement,$jsCallback){
		$retour="";
		if ($responseElement!=="") {
			$responseElement=$this->_prep_value($responseElement);
			$retour="\t$({$responseElement}).html( data );\n";
		}
		$retour.="\t".$jsCallback."\n";
		return $retour;
	}

	protected function _correctAjaxUrl($url) {
		if (PhalconUtils::endsWith($url, "/"))
			$url=substr($url, 0, strlen($url)-1);
		if (strncmp($url, 'http://', 7)!=0&&strncmp($url, 'https://', 8)!=0) {
			$url=$this->_di->get("url")->get($url);
		}
		return $url;
	}

	/**
	 * Makes an ajax request and receives the JSON data types by assigning DOM elements with the same name
	 * @param string $url the request address
	 * @param string $params Paramètres passés au format JSON
	 * @param string $method Method use
	 * @param string $jsCallback javascript code to execute after the request
	 */
	public function _json($url, $method="get", $params="{}", $jsCallback=NULL, $attr="id", $immediatly=false) {
		$jsCallback=isset($jsCallback) ? $jsCallback : "";
		$retour=$this->_getAjaxUrl($url, $attr);
		$retour.="$.{$method}(url,".$params.").done(function( data ) {\n";
		$retour.="\tdata=$.parseJSON(data);for(var key in data){if($('#'+key).length){ if($('#'+key).is('[value]')) { $('#'+key).val(data[key]);} else { $('#'+key).html(data[key]); }}};\n";
		$retour.="\t".$jsCallback."\n
		});\n";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$retour;
		return $retour;
	}

	/**
	 * Makes an ajax request and receives a JSON array data types by copying and assigning them to the DOM elements with the same name
	 * @param string $url the request address
	 * @param string $params Paramètres passés au format JSON
	 * @param string $method Method use
	 * @param string $jsCallback javascript code to execute after the request
	 */
	public function _jsonArray($maskSelector, $url, $method="get", $params="{}", $jsCallback=NULL, $attr="id", $immediatly=false) {
		$jsCallback=isset($jsCallback) ? $jsCallback : "";
		$retour=$this->_getAjaxUrl($url, $attr);
		$retour.="$.{$method}(url,".$params.").done(function( data ) {\n";
		$retour.="\tdata=$.parseJSON(data);$.each(data, function(index, value) {\n"."\tvar created=false;var maskElm=$('".$maskSelector."').first();maskElm.hide();"."\tvar newId=(maskElm.attr('id') || 'mask')+'-'+index;"."\tvar newElm=$('#'+newId);\n"."\tif(!newElm.length){\n"."\t\tnewElm=maskElm.clone();newElm.attr('id',newId);\n"."\t\tnewElm.appendTo($('".$maskSelector."').parent());\n"."\t}\n"."\tfor(var key in value){\n"."\t\t\tvar html = $('<div />').append($(newElm).clone()).html();\n"."\t\t\tif(html.indexOf('[['+key+']]')>-1){\n"."\t\t\t\tcontent=$(html.split('[['+key+']]').join(value[key]));\n"."\t\t\t\t$(newElm).replaceWith(content);newElm=content;\n"."\t\t\t}\n"."\t\tvar sel='[data-id=\"'+key+'\"]';if($(sel,newElm).length){\n"."\t\t\tvar selElm=$(sel,newElm);\n"."\t\t\t if(selElm.is('[value]')) { selElm.attr('value',value[key]);selElm.val(value[key]);} else { selElm.html(value[key]); }\n"."\t\t}\n"."}\n"."\t$(newElm).show(true);"."});\n";

		$retour.="\t".$jsCallback."\n"."});\n";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$retour;
		return $retour;
	}

	public function _postForm($url, $form, $responseElement, $validation=false, $jsCallback=NULL, $attr="id", $immediatly=false) {
		$jsCallback=isset($jsCallback) ? $jsCallback : "";
		$retour=$this->_getAjaxUrl($url, $attr);
		$this->addLoading($retour, $responseElement);
		$retour.="$.post(url,$('#".$form."').serialize()).done(function( data ) {\n";
		$retour.=$this->_getOnAjaxDone($responseElement, $jsCallback)."});\n";

		if ($validation) {
			$retour="$('#".$form."').validate({submitHandler: function(form) {
			".$retour."
			}});\n";
			$retour.="$('#".$form."').submit();\n";
		}
		if ($immediatly)
			$this->jquery_code_for_compile[]=$retour;
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
	 * @param boolean $preventDefault
	 * @param string $jsCallback javascript code to execute after the request
	 * @param string $attr the attribute value to pass to the url (default : id attribute value)
	 */
	public function _getOn($event,$element, $url, $params="{}", $responseElement="", $preventDefault=true, $stopPropagation=true, $jsCallback=NULL, $attr="id") {
		return $this->_add_event($element, $this->_get($url, $params, $responseElement, $jsCallback, $attr), $event, $preventDefault, $stopPropagation);
	}

	/**
	 * Effectue un post vers $url sur l'évènement $event de $element en passant les paramètres $params
	 * puis affiche le résultat dans $responseElement
	 * @param string $element
	 * @param string $event
	 * @param string $url
	 * @param string $params
	 * @param string $responseElement
	 * @param boolean $preventDefault
	 * @param string $jsCallback javascript code to execute after the request
	 * @param string $attr the attribute value to pass to the url (default : id attribute value)
	 */
	public function _postOn($event,$element, $url, $params="{}", $responseElement="", $preventDefault=true, $stopPropagation=true, $jsCallback=NULL, $attr="id") {
		return $this->_add_event($element, $this->_post($url, $params, $responseElement, $jsCallback, $attr), $event, $preventDefault, $stopPropagation);
	}

	/**
	 * Effectue un post vers $url sur l'évènement $event de $element en passant les paramètres du formulaire $form
	 * puis affiche le résultat dans $responseElement
	 * @param string $element
	 * @param string $event
	 * @param string $url
	 * @param string $form
	 * @param string $responseElement
	 * @param boolean $preventDefault
	 * @param string $jsCallback javascript code to execute after the request
	 * @param string $attr the attribute value to pass to the url (default : id attribute value)
	 */
	public function _postFormOn($event,$element, $url, $form, $responseElement="", $preventDefault=true, $stopPropagation=true, $validation=false, $jsCallback=NULL, $attr="id") {
		return $this->_add_event($element, $this->_postForm($url, $form, $responseElement, $validation, $jsCallback, $attr), $event, $preventDefault, $stopPropagation);
	}

	/**
	 * Call the JQuery method $jqueryCall on $element with parameters $param
	 * @param string $element
	 * @param string $jqueryCall
	 * @param mixed $param
	 * @param string $jsCallback javascript code to execute after the jquery call
	 * @return string
	 */
	public function _doJQuery($element, $jqueryCall, $param="", $jsCallback="", $immediatly=false) {
		$param=$this->_prep_value($param);
		$callback="";
		if ($jsCallback!="")
			$callback=", function(event){\n{$jsCallback}\n}";
		$script="$(".$this->_prep_element($element).").".$jqueryCall."(".$param.$callback.");\n";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$script;
		return $script;
	}

	/**
	 *
	 * @param string $event
	 * @param string $element
	 * @param string $elementToModify
	 * @param string $jqueryCall
	 * @param string|array $param
	 * @param boolean $preventDefault
	 * @param boolean $stopPropagation
	 * @param string $jsCallback javascript code to execute after the jquery call
	 * @return string
	 */
	public function _doJQueryOn($event, $element, $elementToModify, $jqueryCall, $param="", $preventDefault=false, $stopPropagation=false, $jsCallback="") {
		return $this->_add_event($element, $this->_doJQuery($elementToModify, $jqueryCall, $param, $jsCallback), $event, $preventDefault, $stopPropagation);
	}

	/**
	 * Execute the code $js
	 * @param string $js Code to execute
	 * @param boolean $immediatly diffère l'exécution si false
	 * @return String
	 */
	public function _exec($js, $immediatly=false) {
		$script=$js."\n";
		if ($immediatly)
			$this->jquery_code_for_compile[]=$script;
		return $script;
	}

	/**
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $js Code to execute
	 * @param boolean $preventDefault
	 * @param boolean $stopPropagation
	 * @return String
	 */
	public function _execOn($element, $event, $js, $preventDefault=false, $stopPropagation=false) {
		return $this->_add_event($element, $this->_exec($js), $event, $preventDefault, $stopPropagation);
	}
}
/* End of file Jquery.php */