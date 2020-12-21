<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$db = new DbOperations();
	$res = $db->getsensorsfirst();
	if($res){
		$response['error']= false;
		$response['message'] = $res;
	}
	else{
			$response['error']= true;
			$response['message']="Update Failed ";
		}
}
else{
	$response['error']= true;
	$response['message']="Invalid Request";
}
echo json_encode($response);
?>
