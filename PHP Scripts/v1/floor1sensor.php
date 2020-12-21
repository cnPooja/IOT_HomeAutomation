<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['sensor1']) and isset($_POST['sensor2'])){
		$db = new DbOperations();
		if($db->updateFirstFloorsensor($_POST['sensor1'], $_POST['sensor2'])){
			$response['error']= false;
			$response['message'] = "Update Success";
		}
		else{
				$response['error']= true;
				$response['message']="Update Failed ";
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
?>
