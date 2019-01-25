<?php
	class config{
	    public function db(){
	        
	        $host="localhost";
	        $user="root";
	        $pass="";
	        $db="liveorder";

	        if($conn = mysqli_connect($host, $user, $pass, $db)){
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