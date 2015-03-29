<?php
namespace Ajax\bootstrap\html;
use Phalcon\Mvc\View;
use Ajax\JsUtils;
use Ajax\bootstrap\html\base\BaseHtml;
/**
 * Twitter Bootstrap HTML Modal component
 * @author jc
 * @version 1.001
 */
class HtmlModal extends BaseHtml {
	protected $title="Titre de ma boîte";
	protected $content="";
	protected $buttons=array();
	protected $showOnStartup=false;


	/**
	 * @param string $identifier the id
	 */
	public function __construct($identifier,$title="",$content="",$buttonCaptions=array()) {
		parent::__construct($identifier);
		$this->_template=include 'templates/tplModal.php';
		$this->buttons=array();
		$this->title=$title;
		$this->content=$content;
		foreach ($buttonCaptions as $button){
			$this->addButton($button);
		}
	}

	/**
	 * Add a button
	 * @param string $value the button caption
	 * @param string $style one of "btn-default","btn-primary","btn-success","btn-info","btn-warning","btn-danger"
	 * @return HtmlButton
	 */
	public function addButton($value="Okay",$style="btn-primary"){
		$btn=new HtmlButton($value);
		$btn->setStyle($style);
		$btn->setValue($value);
		$this->buttons[]=$btn;
		return $btn;
	}

	/**
	 * Add a cancel button
	 * @param string $value
	 * @return HtmlButton
	 */
	public function addCancelButton($value="Annuler"){
		$btn=$this->addButton($value,"btn-default");
		$btn->setProperty("data-dismiss", "modal");
		return $btn;
	}

	/**
	 * Add an Okay button
	 * @param string $value
	 * @return HtmlButton
	 */
	public function addOkayButton($value="Okay"){
		$btn=$this->addButton($value,"btn-primary");
		return $btn;
	}
	/**
	 * set the content of the modal
	 * @param string $content
	 */
	public function setContent($content){
		$this->content=$content;
	}

	/**
	 * set the title of the modal
	 * @param string $content
	 */
	public function setTitle($title){
		$this->title=$title;
	}

	/**
	 * render the content of $controller::$action and set the response to the modal content
	 * @param View $view
	 * @param string $controller a Phalcon controller
	 * @param string $action a Phalcon action
	 */
	public function renderContent($view,$controller,$action){
		 $template = $view->getRender($controller, $action, null, function($view) {
			$view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		});
		$this->content= $template;
	}

	/* (non-PHPdoc)
	 * @see BaseHtml::run()
	 */
	public function run(JsUtils $js) {
		$this->_bsComponent=$js->bootstrap()->modal("#".$this->identifier,array("show"=>$this->showOnStartup));
		$this->addEventsOnRun($js);
		return $this->_bsComponent;
	}

	public function getButton($index){
		return $this->buttons[$index];
	}

	public function showOnCreate(){
		$this->showOnStartup=true;
		return $this;
	}

	public function show(){
		return "$('#{$this->identifier}').modal('show');";
	}

	public function hide(){
		return "$('#{$this->identifier}').modal('hide');";
	}

	public function get(JsUtils $js,$url){
		return $js->getDeferred($url,"#".$this->identifier." .modal-body");
	}

}