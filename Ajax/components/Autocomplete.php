<?php
use Ajax\Components\BaseComponent;
use Ajax\JsUtils;
use Phalcon\Text;
use Phalcon\Mvc\Url;
require_once 'SimpleComponent.php';
/**
 * JQuery UI Autocomplete component
 * @author jc
 * @version 1.001
 */
class Autocomplete extends SimpleComponent {

	public function __construct(JsUtils $js){
		parent::__construct($js);
		$this->uiName="autocomplete";
		$this->setParam("minLength", 3);
	}

	/**
	 * Define source property with an ajax request based on $url
	 * $url must return a JSON array of values
	 * @param String $url
	 */
	public function setAjaxSource($url){
		if(Text::startsWith($url, "/")){
			$u=$this->js->getDi()->get("url");
			$url=$u->getBaseUri().$url;
		}
		$ajax="%function (request, response) {
			$.ajax({
				url: '{$url}',
				dataType: 'jsonp',
				data: {q : request.term},
				success: function(data) {response(data);}
			});
		}%";
		$this->setParam("source", $ajax);
	}

	/**
	 * Define the source property
	 * with a JSON Array of values
	 * @param String $source
	 */
	public function setSource($source){
		$source=str_ireplace(array("\"","'"), "%quote%", $source);
		$this->setParam("source", "%".$source."%");
	}
}