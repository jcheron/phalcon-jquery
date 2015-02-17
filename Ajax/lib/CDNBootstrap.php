<?php
namespace Ajax\lib;
use Phalcon\Tag;
use Phalcon\Text;
require_once 'CDN.php';
require_once 'CDNBase.php';
class CDNBootstrap extends CDNBase{
	protected $cssUrl;
	protected $localCss;

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

	public function getCss() {
		if(isset($this->cssUrl))
			return $this->cssUrl;
		$version=$this->version;
		if(array_search($version, $this->getVersions())===false)
			$version=$this->getLastVersion();
		return $this->replaceVersion($this->data[$this->provider]["css"],$version);
	}

	public function __toString(){
		$url=$this->getUrl();
		$css=$this->getCss();
		return Tag::javascriptInclude($url,$this->local)."\n".Tag::stylesheetLink($css,$this->localCss);;
	}

	public function setCssUrl($cssUrl,$local=null) {
		$this->cssUrl = $cssUrl;
		if(isset($local)===false){
			$local=Text::startsWith($cssUrl,"http")===false;
		}
		$this->setLocalCss($local);
		return $this;
	}

	public function getLocalCss() {
		return $this->localCss;
	}

	public function setLocalCss($localCss) {
		$this->localCss = $localCss;
		return $this;
	}



}