<?php

class Crud{
  
    private $servername = "localhost";
    private $username = "webshop_user";
    private $password = "lrV5Y*ABOoXF)N*a";
    private $dbname = "webshop_daan";
    private $pdo;
    
  public function __construct()
  {
    if(!$this->pdo){
      $connectieString = "mysql:host=$this->servername;dbname=$this->dbname";
      $this->pdo = new PDO($connectieString, $this->username, $this->password);
      // set the PDO error mode to exception
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }
    
  public function createRow($sql, $params){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $this->pdo->lastInsertId();
  }

  public function readOneRow($sql, $params){

  }

  public function readAllRows($sql, $params, $keycolumn){

  }

  public function updateRow($sql, $params){

  }

  public function deleteRow($sql, $params){

  }
  

}

?>