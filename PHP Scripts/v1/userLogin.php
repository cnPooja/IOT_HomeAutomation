<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['username']) and isset($_POST['password'])){
		$db = new DbOperations();
		if($db->userLogin($_POST['username'], $_POST['password'])){
				$user=$db->getUserByUsername($_POST['username']);
				$response['error']= false;
				$response['username']=$user['username'];
				$response['message'] = "Login Success";

		}
		else{
				$response['error']= true;
				$response['message']="Invalid User Name or Password ";
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
