<?php

/**
 * 
 */
class App
{
	private $_url = null;
	private $_controller = null;

	function __construct()
	{
		
	}

	function init(){
		$this->checkURL();
		$this->checkController($this->_url[0]);
		$this->callModel();
		$this->checkMethods($this->_url);
	}

	function checkURL(){
		if(!empty($_GET['url'])){
			$this->getURL($_GET['url']);

		}else{
			$this->directHomePage();
				
		}
	}

	function callModel(){
		$this->_controller->checkModel($this->_url[0]);
	}

	function checkController($controller){
		if(file_exists("controller/".$controller.".php")){
			
			include_once("controller/".$controller.".php");
			$this->_controller = new $controller();

			$this->_controller->index();//////////////////////////////////



		}else{

			$this->directErrorPage();
			
		}
	}



	function checkMethods($urlInput){
		$length = count($this->_url);
		if($length>1){
			if(method_exists($this->_controller, $this->_url[1])){
				$this->setParameters($this->_url[1],$length);
			}else{
		
				exit();	
			}
		}else{
			exit();
		}
	}

	function setParameters($method,$length){

		switch ($length) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$method}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            
            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}($this->_url[2], $this->_url[3]);
                break;
            
            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}($this->_url[2]);
                break;
            
            case 2:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}();
                break;
            
            default:
                $this->directHomePage();
                break;
        }
	}


	function getURL($url){
		$this->_url = rtrim($url,'/');
		$this->_url = filter_var($this->_url,FILTER_SANITIZE_URL);
		$this->_url = explode('/', $this->_url);
	}

	function directHomePage(){
		include_once("controller/home.php");
		$this->_controller = new Home();
		$this->_controller->index();
		include_once("model/homeModel.php");
		
		$this->_controller->displayData();
		exit();
	}

	function directErrorPage(){

		include_once("controller/err.php");
		$this->_controller = new Err();
		$this->_controller->index();
		exit();
	} 

}