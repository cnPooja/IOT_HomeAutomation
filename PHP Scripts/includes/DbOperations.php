<?php 

	class DbOperations{

		private $con; 

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();

		}

		/*CRUD -> C -> CREATE */

		public function createUser($username, $pass){
			if($this->isUserExist($username)){
			
				return 0; 
			}else{
				$password = md5($pass);
				//$password = $pass;
				$stmt = $this->con->prepare("INSERT INTO user (`id`,`username`,`password`) VALUES (NULL, ?, ?);");
				$stmt->bind_param("ss",$username,$password);
				if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
			}
		}

		public function userLogin($username, $pass){
			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id FROM user WHERE username = ? AND password = ?");
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}
		
		public function getlightsfirst(){
			$stmt = $this->con->prepare("select * FROM firstfloor;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		public function getlightssecond(){
			$stmt = $this->con->prepare("select * FROM secondfloor;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		public function getthermostat(){
			$stmt = $this->con->prepare("select fan FROM firstfloorThermostat;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		public function getsensorsfirst(){
			$stmt = $this->con->prepare("select * FROM firstsensorfloor;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		public function getsensorssecond(){
			$stmt = $this->con->prepare("select * FROM secondsensorfloor;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}	

		public function getUserByUsername($username){
			$stmt = $this->con->prepare("SELECT * FROM user WHERE username = ?");
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		
		public function getnmap(){
			$stmt = $this->con->prepare("select * FROM nmap;");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		
		public function updateFirstFloorsensor($sensor1,$sensor2){
			$stmt = $this->con->prepare("DELETE FROM firstsensorfloor;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO firstsensorfloor (`sensor1`,`sensor2`) VALUES (?, ?);");
			$stmt->bind_param("ss",$sensor1,$sensor2);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}
		
		public function getImage(){
			$stmt = $this->con->prepare("select url FROM images WHERE id = (SELECT MAX(id) FROM images)");
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		
		public function updateSecondFloorsensor($sensor1,$sensor2){
			$stmt = $this->con->prepare("DELETE FROM secondsensorfloor;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO secondsensorfloor (`sensor1`,`sensor2`) VALUES (?, ?);");
			$stmt->bind_param("ss",$sensor1,$sensor2);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}
		
		public function updateThermostat($temperature,$fan,$mode){
			$stmt = $this->con->prepare("DELETE FROM firstfloorThermostat;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO firstfloorThermostat (`temperature`,`fan`,`mode`) VALUES (?, ?, ?);");
			$stmt->bind_param("sss",$temperature,$fan,$mode);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}

		private function isUserExist($username){
			$stmt = $this->con->prepare("SELECT id FROM user WHERE username = ?");
			$stmt->bind_param("s", $username);
			$stmt->execute(); 
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}
		public function updateFirstFloor($light1, $light2){
			$stmt = $this->con->prepare("DELETE FROM firstfloor;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO firstfloor (`light1`,`light2`) VALUES (?, ?);");
			$stmt->bind_param("ss",$light1,$light2);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}
 		
		public function updateSecondFloor($light1, $light2){
			$stmt = $this->con->prepare("DELETE FROM secondfloor;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO secondfloor (`light1`,`light2`) VALUES (?, ?);");
			$stmt->bind_param("ss",$light1,$light2);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}
 		public function updateNmapCheck($map1, $map2){
			$stmt = $this->con->prepare("DELETE FROM nmap;");
			$stmt->execute();
			$stmt = $this->con->prepare("INSERT INTO nmap (`map1`,`map2`) VALUES (?, ?);");
			$stmt->bind_param("ss",$map1,$map2);
			if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}
		

	}
?>
