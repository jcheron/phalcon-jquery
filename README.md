# phalcon-jquery
JQuery and JQuery UI library for Phalcon MVC framework

##What's Phalcon-jquery ?
phalcon-jquery is a php library for the Phalcon framework.

The library can be injected as a service in $di object, and permit to generate JQuery commands in Phalcon controllers

##Installation
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

##Project configuration
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
Inject Jquery service in the $di project :
```php
$di->set("jquery",function(){
	$jquery= new JsUtils(array("driver"=>"Jquery"));
	$jquery->setLibraryFile("public/js/jquery-2.0.3.js");
	$jquery->ui(new JqueryUI());//optional for JQuery UI
	return $jquery;
});
```

###JS files

Copy all necessary JS and CSS files from the JQuery official web site and copy them to public/assets and public/js directories of your project

For JQuery (download at http://jquery.com/download/ or use the CDN)
* jquery.min.js

For JQuery UI (download at http://jqueryui.com/download/ or use the CDN)
* minified : jquery-ui.min.js
* theme : jquery-ui.css
