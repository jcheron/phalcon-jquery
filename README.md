# phalcon-jquery
JQuery and JQuery UI library for Phalcon MVC framework

##What's Phalcon-jquery ?
phalcon-jquery is a php library for the Phalcon framework.

The library can be injected as a service in **$di** object, and permit to generate JQuery scripts in Phalcon controllers

##I - Installation
###Manual

* Download project at https://github.com/jcheron/phalcon-jquery/archive/master.zip
* or just clone the repo and checkout the current branch

```bash
cd ~
git clone https://github.com/jcheron/phalcon-jquery.git
cd library
```

* Copy all contents of the library folder to your libraries folder project

```bash
app
	libraries
		  Jquery.php
		  JqueryUI.php
		  jsUtils.php
		  Components
					...
```

##Requirements

* PHP >= 5.3.9
* Phalcon >= 0.7.0
* JQuery >= 2.0.3
* JQuery UI >= 1.10 [optional]

##II - Project configuration
###Library directory
Define the library directory in phalcon bootstrap file(s) (index.php or loader.php)
```php
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
    	'../app/libraries/'
    ))->register();
```
Copy all files from the phalcon-jquery library folder to your project libraries folder

###Injection
Inject Jquery service in the **$di** project :
```php
$di->set("jquery",function(){
	$jquery= new JsUtils(array("driver"=>"Jquery"));
	$jquery->ui(new JqueryUI());//optional for JQuery UI
	return $jquery;
});
```

###JS files
####DCN
For DCN using (From Google Api or MaxCDN)
In Phalcon controller, implements the initialize method and pass a variable to the view
```php
use Phalcon\Mvc\Controller;
class ExController extends Controller{
	public function initialize(){
		$this->view->setVar("jquery", $this->jquery->genDCNs("humanity"));//humanity template file for JqueryUI
	}
```
In the corresponding view, insert the jquery variable for stylesheets and javascript CDN :
#####volt
```html
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		{{jquery}}
	</head>
```
#####phtml
```html
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?=jquery?>
	</head>
```

All JQuery files are inserted in the result, with Google CDN (default) and last JQuery versions
```
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/humanity/jquery-ui.css" />
```
####Local files
Copy all necessary JS and CSS files from the JQuery official web site and copy them to **public/assets** and **public/js** directories in your project

For JQuery (download at http://jquery.com/download/ or use the CDN)
* jquery.min.js

For JQuery UI (download at http://jqueryui.com/download/ or use the CDN)
* minified : jquery-ui.min.js
* theme : jquery-ui.css

##III - Usage

###1 - JQuery samples

####a - hiding an element on click
**a volt view (hideSample.view):** the **script_foot** variable contains JQuery scripts generated in controller
```html
<input id="btn" type="button" value="click to hide pannel">
<div class="panel">
  <div>
    panel to hide
  </div>
</div>
{{script_foot}}
```

**an action in controller (associated to the view) :** the click on the **#btn** element must hide the panel with css class **panel**
```php
	public function hideSampleAction(){
		$jquery=$this->jquery;
		$jquery->click("#btn",$jquery->hide(".panel",2000));
		$jquery->compile($this->view);
	}
```

####b - Ajax request on click

**a volt view (ajaxSample.view):** the **script_foot** variable contains JQuery scripts generated in controller
```html
<input id="btn" type="button" value="click to make ajax request">
<div id="response">
  <div>
    Response panel
  </div>
</div>
{{script_foot}}
```

**an action in controller (associated to the view) :** the click on the **#btn** element must realize the ajax request (**index/responseURL**) and display it in the **response** element
```php
	public function ajaxSampleAction(){
		$this->jquery->getAndBindTo("#btn", "click", "index/responseURL","#response");
		$this->jquery->compile($this->view);
	}
```

**The action for the response URL :**

* This is an ajax request, so the view is disabled.
* If the action is associated with an existing view, use **disableLevel(View::LEVEL_MAIN_LAYOUT)**

```php
	public function responseURLAction(){
		echo "Request terminated";
		$this->view->disable();
	}
```
###2 - JQuery UI samples

####Accordion