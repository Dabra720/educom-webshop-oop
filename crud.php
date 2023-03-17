<?php

class Crud{
  
  private $servername = "localhost";
  private $username = "webshop_user";
  private $password = "lrV5Y*ABOoXF)N*a";
  private $dbname = "webshop_daan";
  private $pdo;
    
  // De CRUD maakt gebruik van prepared statement, die je samen met een array van values meegeeft aan deze functies.
  public function __construct()
  {
    if(!$this->pdo){
      $connectieString = "mysql:host=$this->servername;dbname=$this->dbname";
      $this->pdo = new PDO($connectieString, $this->username, $this->password);
      // set the PDO error mode to exception
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }

  private function prepareAndBind($sql, $params){
    $stmt = $this->pdo->prepare($sql);
    foreach($params as $key=>$value){
      $stmt->bindValue($key, $value);
    }
    // $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    return $stmt;
  }
  
  public function createRow($sql, $params){
    $this->prepareAndBind($sql, $params);
    return $this->pdo->lastInsertId();
  }

  public function readOneRow($sql, $params){
    // De methode readOneRow geeft een object of class terug.
    $stmt = $this->prepareAndBind($sql, $params);
    $readObject = $stmt->fetch(PDO::FETCH_OBJ);
    return $readObject;
  }

  public function readAllRows($sql, $params){
    //De methode readMultipleRows geeft een array van objecten of klassen terug.
    $stmt = $this->prepareAndBind($sql, $params);
    $readArray = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $readArray;
  }

  public function updateRow($sql, $params){
    $stmt = $this->prepareAndBind($sql, $params);
  }

  public function deleteRow($sql, $params){
    $stmt = $this->prepareAndBind($sql, $params);
  }
  

}

?>