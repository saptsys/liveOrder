<?php
	class config{
			public $host="localhost";
	        public $user="root";
	        public $pass="";
			public $db="liveorder";
			
			public function db(){
				if(@$conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die("Can not connect to the database.<br><a href='Database/initialize.php'>Database Management</a>")){
					return $conn;
				}else{
					die("Connect failed: %s\n". $conn -> error);
				}
			}
			public function dbOnlyCon(){
				if(@$conn = mysqli_connect($this->host, $this->user, $this->pass) or die("Can not connect to the database.<br><a href='Database/initialize.php'>Database Management</a>")){
					return $conn;
				}else{
					die("Connect failed: %s\n". $conn -> error);
				}
			}
			public function closeCon($conn){
				$conn -> close();
			}
	}
?>