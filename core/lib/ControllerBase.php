<?php

abstract class ControllerBase {
 
    protected $view;
	public $urlHelper;
	public $config;
	public $model;
	public $params;
	
    function __construct()
    {
		$classname = str_replace("Controller","Model",get_class($this));
		$this->params = gett();
		if (class_exists('View'))
        $this->view = new View();
        $this->config = Config::singleton();
       //	$this->urlHelper = new urlHelper();
		
		
		// if (file_exists(dirname(__FILE__)."/../application/models/".$classname.".php")){
		// 	require_once dirname(__FILE__)."/../application/models/".$classname.".php";
		// 	$this->model = new $classname();
		// }
    }

  
}
?>