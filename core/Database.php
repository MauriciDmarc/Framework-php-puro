<?php 

class Database {

private $host     = "localhost";
private $db_name  = "table";
private $user     = "root";
private $pass     = "";

private $conn;

public function getConn(): PDO {
   $this->conn = null;
   
   try{
      $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->user, $this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $exception){
   acho "Erro na Conexão: ".$exception->getMessage();
}
   return $this->conn
   }
  }
}