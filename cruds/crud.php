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

  // Bind opgegeven values aan de query en execute
  private function prepareAndBind($sql, $params, $class=NULL){
    
    $stmt = $this->pdo->prepare($sql);
    if($stmt){
      foreach($params as $key=>$value){
        $stmt->bindValue($key, $value);
      }

      if(!empty($class)){ // Voor het ophalen van class objecten(User/Product)
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
      } else {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
      }

      $stmt->execute();
      return $stmt;
    }
  }
  
  public function createRow($sql, $params){
    //De methode createRow geeft de ID van de gecreëerde row terug
    $this->prepareAndBind($sql, $params);
    return $this->pdo->lastInsertId();
  }

  public function readOneRow($sql, $params, $class){
    // De methode readOneRow geeft een object of class terug.
    $stmt = $this->prepareAndBind($sql, $params, $class);
    $readObject = $stmt->fetch();
    return $readObject;
  }

  public function readMultipleRows($sql, $params, $class){
    //De methode readMultipleRows geeft een array van objecten of klassen terug.
    $stmt = $this->prepareAndBind($sql, $params, $class);
    $readArray = $stmt->fetchAll();
    return $readArray;
  }

  public function updateRow($sql, $params){
    $this->prepareAndBind($sql, $params);
  }

  public function deleteRow($sql, $params){
    $this->prepareAndBind($sql, $params);
  }
  

}

?>