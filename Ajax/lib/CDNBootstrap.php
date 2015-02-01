<?php
use Phalcon\Tag;
require_once 'CDN.php';
require_once 'CDNBase.php';
class CDNBootstrap extends CDNBase{

	public function __construct($version,$provider="MaxCDN") {
		parent::__construct($version,$provider);
		$this->data=$this->data["Bootstrap"];
	}

	public function getUrl() {
		if(isset($this->jsUrl))
			return $this->jsUrl;
		$version=$this->version;
		if(array_search($version, $this->getVersions())===false)
			$version=$this->getLastVersion();
		return $this->replaceVersion($this->data[$this->provider]["core"],$version);
	}

	public function __toString(){
		$url=$this->getUrl();
		return Tag::javascriptInclude($url,$this->local);
	}

}