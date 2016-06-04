<?php

namespace Ajax\php\laravel;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
class JsUtils extends \Ajax\JsUtils{
	public function getUrl($url){
		return \url($url);
	}
	public function addViewElement($identifier,$content,$view){
		$controls=$view->__get("q");
		if (isset($controls) === false) {
			$controls=array ();
		}
		$controls[$identifier]=$content;
		$view->__set("q", $controls);
	}

	public function createScriptVariable($view,$view_var, $output){
		$view->__set($view_var,$output);
	}

	public function forward($initialController,$controller,$action){
		//\request()->attributes->all()
		$url=\action($controller.'@'.$action, [],false);
		$request = Request::create($url, 'GET');
		// handle the response
		return Route::dispatch($request)->getContent();
		//return App::make($controller)->{$action}(\request()->attributes->all());
		//return "Accordion content";//
		//return \redirect()->action($controller.'@'.$action,\request()->attributes->all())->getContent();
	}

	public function renderContent($view, $controller, $action, $params=NULL) {
		$template=$view->getRender($controller, $action, $params, function ($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		return $template;
	}

	public function fromDispatcher($dispatcher){
		return $dispatcher->segments();
	}
}