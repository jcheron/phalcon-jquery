<?php

namespace Ajax\bootstrap\html;

use Ajax\bootstrap\html\base\HtmlBsDoubleElement;
use Ajax\JsUtils;
use Phalcon\Mvc\View;

/**
 * Composant Twitter Bootstrap Accordion
 * @see http://getbootstrap.com/javascript/#collapse-example-accordion
 * @author jc
 * @version 1.001
 */
class HtmlAccordion extends HtmlBsDoubleElement {

	public function __construct($identifier, $tagName="div") {
		parent::__construct($identifier, $tagName);
		$this->setClass("panel-group");
		$this->setRole("tablist");
		$this->setProperty("aria-multiselectable", "true");
		$this->content=array ();
	}

	public function addPanel($title, $content) {
		$nb=sizeof($this->content)+1;
		$panel=new HtmlPanel("panel-".$this->identifier."-".$nb);
		$link=new HtmlLink("lnk-panel-".$this->identifier."-".$nb);
		$link->setProperty("data-toggle", "collapse");
		$link->setProperty("data-parent", "#".$this->identifier);
		$link->setHref("#collapse-panel-".$this->identifier."-".$nb);
		$link->setContent($title);
		$panel->addHeader($link);
		$panel->setContent($content);
		$panel->setCollapsable(true);
		$this->content []=$panel;
		return $panel;
	}

	/**
	 * render the content of an existing view : $controller/$action and set the response to a new panel
	 * @param string $title The panel title
	 * @param View $view
	 * @param string $controller a Phalcon controller
	 * @param string $action a Phalcon action
	 * @param $params The parameters to pass to the view
	 */
	public function renderContentPanel($title,$view, $controller, $action, $params=NULL) {
		$template=$view->getRender($controller, $action, $params, function ($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		return $this->addPanel($title, $template);
	}

	/**
	 * render the content of $controller::$action and set the response to a new panel
	 * @param string $title The panel title
	 * @param Controller $initialController
	 * @param string $controller a Phalcon controller
	 * @param string $action a Phalcon action
	 */
	public function forwardPanel($title,$initialController,$controller,$action){
		$dispatcher = $initialController->dispatcher;
		$dispatcher->setControllerName($controller);
		$dispatcher->setActionName($action);
		$dispatcher->dispatch();
		$template=$initialController->view->getRender($dispatcher->getControllerName(), $dispatcher->getActionName(),$dispatcher->getParams(), function ($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		return $this->addPanel($title, $template);
	}

	public function run(JsUtils $js) {
		foreach ( $this->content as $content ) {
			$content->run($js);
		}
	}

	public function getPanel($index) {
		if ($index<sizeof($this->content))
			return $this->content [$index];
	}
}