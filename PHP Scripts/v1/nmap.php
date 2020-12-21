<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['map1']) and isset($_POST['map2'])){
		$db = new DbOperations();
		if($db->updateNmapCheck($_POST['map1'], $_POST['map2'])){
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
