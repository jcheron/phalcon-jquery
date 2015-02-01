<?php
abstract class DCNGenerator {
	protected $version;
	protected $provider;
	protected $data;
	protected $local;
	protected $jsUrl;

	public function __construct($version,$provider){
		$this->data=include 'DCN.php';
		$this->version=$version;
		$this->provider=$provider;
		$this->local=false;
		$this->jsUrl=null;
	}

	public function getJsUrl() {
		return $this->jsUrl;
	}

	public function setJsUrl($jsUrl) {
		$this->jsUrl = $jsUrl;
		return $this;
	}	

	public function isLocal() {
		return $this->local;
	}

	public function setLocal($local) {
		$this->local = $local;
		return $this;
	}


	protected function replaceVersion($url,$version){
		return str_ireplace("%version%", $version, $url);
	}
	protected function replaceTheme($url,$theme){
		return str_ireplace("%theme%", $theme, $url);
	}
	protected function replaceVersionAndTheme($url,$version,$theme){
		return str_ireplace(array("%theme%","%version%"), array($theme,$version), $url);
	}

	public function getProviders(){
		return array_keys($this->data);
	}

	public function getVersions($provider=NULL){
		if(isset($provider))
			return $this->data[$provider]["versions"];
		else
			return $this->data[$this->provider]["versions"];
	}

	public function getLastVersion($provider=NULL){
		return $this->getVersions($provider)[0];
	}

	public abstract function getUrl();
}