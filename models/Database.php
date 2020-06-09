<?php 
	class Database {
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $dbname = 'myblog';
		private $conn;
	

	//DB connect

	public function connect(){
		$this->conn = null;

		try{
		$dsn = "mysql:host=$this->host; dbname=$this->dbname";
		$this->conn = new PDO($dsn, $this->username, $this->password);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'connection error:'. $e->getMessage();
	 }
	 return $this->conn;
	}
}

?>