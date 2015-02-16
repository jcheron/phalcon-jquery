<?php
namespace Ajax\config;
require_once 'config.php';
use Ajax\config\Config;

class DefaultConfig extends Config {
	public function __construct() {
		parent::__construct (array(
				"formElementsPrefix"=>array("txt"=>"input_text","btn"=>"button","ck"=>"checkbox","cmb"=>"select_1","list"=>"select_n",
						"_"=>"input_hidden","f"=>"input_file","radio"=>"radio","mail"=>"input_email"
				)
		));
	}
}