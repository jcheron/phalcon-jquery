<?php
use Phalcon\Tag;
require_once 'DCN.php';
require_once 'DCNGenerator.php';
class DCNJQueryGenerator extends DCNGenerator{

	public function __construct($version,$provider="Google") {
		parent::__construct($version,$provider);
		$this->data=$this->data["JQuery"];
	}

	public function getUrl() {
		$version=$this->version;
		if(array_search($version, $this->getVersions())===false)
			$version=$this->getLastVersion();
		return $this->replaceVersion($this->data[$this->provider]["url"],$version);

	}

	public function __toString(){
		$url=$this->getUrl();
		return Tag::javascriptInclude($url,$this->local);
	}

}