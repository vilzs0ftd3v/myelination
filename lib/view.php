<?php

/**
 * 
 */
class View
{
	
	function __construct()
	{
		
	}

	function render($page){
		include("view/header.php");

		include("view/".$page."/index.php");

		include("view/footer.php");
	}
}