<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['light1']) and isset($_POST['light2'])){
		$db = new DbOperations();
		if($db->updateSecondFloor($_POST['light1'], $_POST['light2'])){
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
