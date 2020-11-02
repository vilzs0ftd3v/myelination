<?php
include_once("data/home/base.php");
include_once("data/home/base.php");
$db = new database();


$db->displayMessage();


if($_POST['action']){
	//echo json_encode($_POST['action']);	
	$res = $db->select("select * from content;");
		
	echo json_encode("hello world!");
}

