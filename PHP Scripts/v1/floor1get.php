<?php
require_once '../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$db = new DbOperations();
	$res = $db->getlightsfirst();
	$res2 = $db->getlightsSecond();
	$res3 = $db->getthermostat();
	if($res && $res2 && $res3){
		$response['error']= false;
		$response['floor1'] = $res;
		$response['floor2'] = $res2;
		$response['thermo'] = $res3;
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
