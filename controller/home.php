<?php

/**
 * 
 */
class Home extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->_view->js = array('home/js/default.js');
	}

	function index(){
		$this->_view->render("home");

	}

	function displayData(){
		$this->_model->displayData();
		//include_once("data/home_data.php");

	}
}