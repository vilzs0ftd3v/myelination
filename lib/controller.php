<?php

/**
 * 
 */
class Controller
{
	
	function __construct()
	{
		$this->_view = new View();
		include_once("model/homeModel.php");
		$this->_model = new homeModel();
	}

	function checkModel($file){
		$path = "model/".$file."Model.php";
		$modelName = $file."Model";
		if(file_exists($path)){
			include_once($path);
			$this->_model = new $modelName();
		}else{
			return false;
		}
	}
	
}