<?php
	include_once 'database.php';
	Class User extends Database{
		public function login($username, $password){
			$sql="select * from tbluser where username='$username' and password='$password'";
			$data = $this->conn->query($sql);
			return $data;
		}
	}
?>