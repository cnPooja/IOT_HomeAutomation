<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['temperature']) and isset($_POST['fan']) and isset($_POST['mode'])){
		$db = new DbOperations();
		if($db->updateThermostat($_POST['temperature'], $_POST['fan'], $_POST['mode'])){
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
