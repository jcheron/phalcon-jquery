<?php
use Phalcon\Tag;
require_once 'DCN.php';
require_once 'DCNGenerator.php';

class DCNJQueryUIGenerator extends DCNGenerator{
	protected $theme;

	public function __construct($version,$theme=NULL,$provider="Google") {
		parent::__construct($version,$provider);
		$this->data=$this->data["JQueryUI"];
		if(is_int($theme)){
			$themes=$this->getThemes();
			if(sizeof($themes)>$theme-1)
				$this->theme=$themes[$theme-1];
			else
				throw New Exception("DCNJQueryUIGenerator : Le numéro de thème demandé n'existe pas");
		}
		$this->theme=$theme;
	}

	public function getThemes($provider=NULL){
		if(isset($provider))
			return $this->data[$provider]["themes"];
		else
			return $this->data[$this->provider]["themes"];
	}

	public function getFirstTheme($provider=NULL){
		return $this->getThemes($provider)[0];
	}

	public function getUrl() {
		$version=$this->version;
		if(array_search($version, $this->getVersions())===false)
			$version=$this->getLastVersion();
		return $this->replaceVersion($this->data[$this->provider]["core"],$version);
	}

	public function getCss() {
		$version=$this->version;
		if(array_search($version, $this->getVersions())===false)
			$version=$this->getLastVersion();
		$theme=$this->theme;
		if(array_search($theme, $this->getThemes())===false)
			$theme=$this->getFirstTheme();
		return $this->replaceVersionAndTheme($this->data[$this->provider]["css"],$version,$theme);
	}

	public function __toString(){
		$url=$this->getUrl();
		$css=$this->getCss();
		return Tag::javascriptInclude($url,$this->local)."\n".Tag::stylesheetLink($css,$this->local);
	}

}