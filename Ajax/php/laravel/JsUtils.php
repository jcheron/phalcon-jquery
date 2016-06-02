<?php

namespace Ajax\php\laravel;


class JsUtils extends \Ajax\JsUtils{
	public function getUrl($url){
		return $url;
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
		$dispatcher = $initialController->dispatcher;
		$dispatcher->setControllerName($controller);
		$dispatcher->setActionName($action);
		$dispatcher->dispatch();
		$template=$initialController->view->getRender($dispatcher->getControllerName(), $dispatcher->getActionName(),$dispatcher->getParams(), function ($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		return $template;
	}

	public function renderContent($view, $controller, $action, $params=NULL) {
		$template=$view->getRender($controller, $action, $params, function ($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		return $template;
	}

	public function fromDispatcher($dispatcher){
		$params=$dispatcher->getParams();
		$action=$dispatcher->getActionName();
		$items=array($dispatcher->getControllerName());
		if(\sizeof($params)>0 || \strtolower($action)!="index" ){
			$items[]=$action;
			foreach ($params as $p){
				if(\is_object($p)===false)
					$items[]=$p;
			}
		}
		return $items;
	}
}