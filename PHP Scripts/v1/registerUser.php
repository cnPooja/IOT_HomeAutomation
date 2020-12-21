<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['username']) and isset($_POST['password'])){
		$db = new DbOperations();
		if($db->createUser($_POST['username'],$_POST['password'])){
				$response['error']= false;
				$response['message']="Success";

		}
		else{
				$response['error']= true;
				$response['message']="Failed";
			}
		}
		else {
				$response['error']= true;
				$response['message']="Required Fields missing";
		}
}
else{
	$response['error']= true;
	$response['message']="Invalid Request";
}
echo json_encode($response);
