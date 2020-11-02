<?php

include_once("../../data/home/base.php");
$db = new database();

/*

if(isset($_POST['question'])){
	$question = $_POST['question'];
}
if(isset($_POST['answer'])){
	$answer = $_POST['answer'];
}
*/

if(isset($_POST['id'])){
	$id = $_POST['id'];
}

if(isset($_POST['action'])){
	$action = $_POST['action'];
}

if(isset($_POST['task'])){
	$task = $_POST['task'];
}

if(isset($_POST['remarks'])){
	$remarks = $_POST['remarks'];
}

if(isset($_POST['sessions'])){
	$sessions = $_POST['sessions'];
}


if($action == "insert"){

	$sql = "INSERT INTO `myelination_tbl`(`myelination_task`, `myelination_remarks`,`myelination_session`,
	`myelination_created`) VALUES (:task,:remarks,:taskSession,now())";
	$param = array(':task' =>$task,':remarks' =>$remarks,':taskSession'=>$sessions);
	$db->insert($sql,$param);
	
	//echo $task.":".$sessions.":".$remarks;
}

if($action == "getData"){
	$sql = "select * from myelination_tbl;";
	$data = $db->getValue($sql);
	echo json_encode($data);
}

if($action == "delete"){
	echo $db->deleteData($id);
}

if($action == "edit"){
	$sql = "select * from myelination_tbl WHERE myelination_id=".$id.";";
	$data = $db->getValue($sql);
	echo json_encode($data);
}

if($action=="update"){
	
	$sql = "update myelination_tbl set `myelination_task`=:task, `myelination_remarks` =:remarks,`myelination_session` =:taskSession
	where `myelination_id` = :id";
	$param = array(':task' =>$task,':remarks' =>$remarks,':taskSession'=>$sessions,':id'=>$id);
	$db->insert($sql,$param);
	
	//echo $task.":".$remarks.":".$sessions.":".$sql;
}
/*



if($action == "display"){
	$db->display("select * from review_tbl"); 
}





*/
