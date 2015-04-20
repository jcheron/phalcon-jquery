<?php

namespace Ajax\lib;

use Ajax\service\PhalconUtils;

class CDNJQuery extends CDNBase {
	public function __construct($version, $provider="Google") {
		parent::__construct($version,$provider);
		$this->data=$this->data ["JQuery"];
	}
	public function getUrl() {
		if (isset($this->jsUrl))
			return $this->jsUrl;
		$version=$this->version;
		if (array_search($version,$this->getVersions()) === false)
			$version=$this->getLastVersion();
		return $this->replaceVersion($this->data [$this->provider] ["url"],$version);
	}
	public function __toString() {
		$url=$this->getUrl();
		return PhalconUtils::javascriptInclude($url,$this->local);
	}
}