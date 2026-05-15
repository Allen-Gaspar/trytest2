<?php
	class Database{
    public $conn;

    public function __construct(){
        $this->conn = new mysqli('localhost','root','','sis_database'); // ✅ FIXED: new mysqli + added missing ''
    }
}

?>