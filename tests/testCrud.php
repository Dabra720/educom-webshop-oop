<?php

class testCrud{
  private $servername = "localhost";
  private $username = "webshop_user";
  private $password = "lrV5Y*ABOoXF)N*a";
  private $dbname = "webshop_daan";
  private $pdo;
    
  // De CRUD maakt gebruik van prepared statement, die je samen met een array van values meegeeft aan deze functies.
  public function __construct()
  {
    if(!$this->pdo){
      try{
        $connectieString = "mysql:host=$this->servername;dbname=$this->dbname";
        $this->pdo = new PDO($connectieString, $this->username, $this->password);
        // set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $e){
        Util::logDebug("Connection with database failed. " . $e->getMessage());
      }
      
    }
  }

  // Bind opgegeven values aan de query en execute
  private function prepareAndBind($sql, $params, $class=NULL){
    // try{
      $stmt = $this->pdo->prepare($sql);
      if($stmt){
        foreach($params as $key=>$value){
          $stmt->bindValue($key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        $stmt->execute();
        return $stmt;
      }
      
    // }catch(PDOException $e){
    //   Util::logDebug("Prepare PDO Statement failed. " . $e->getMessage());
    // }

    
  }
  
  public function createRow($sql, $params){
    //De methode createRow geeft de ID van de gecreëerde row terug
    // $this->prepareAndBind($sql, $params, $class);
    return 22;
  }

  // public function readOneRow($sql, $params, $class){
  //   // De methode readOneRow geeft een object of class terug.
  //   $stmt = $this->prepareAndBind($sql, $params, $class);
  //   // $readObject = $stmt->fetch(PDO::FETCH_CLASS, $class);
  //   $readObject = $stmt->fetch();
  //   return $readObject;
  // }
  public function readOneRow($sql, $params, $class){
    // De methode readOneRow geeft een object of class terug.
    $stmt = $this->prepareAndBind($sql, $params, $class);
    $readObject = $stmt->fetch();
    // var_dump(get_class_vars('User'));
    return $readObject;
  }

  public function readAllRows($sql, $params, $class){
    //De methode readMultipleRows geeft een array van objecten of klassen terug.
    $stmt = $this->prepareAndBind($sql, $params, $class);
    $readArray = $stmt->fetchAll();
    return $readArray;
  }

  public function updateRow($sql, $params){
    // $stmt = $this->prepareAndBind($sql, $params);
  }

  public function deleteRow($sql, $params){
    $stmt = $this->prepareAndBind($sql, $params);
  }
  

}



// session_start();
// // require_once "controllers/page_controller.php";
// require_once "../crud.php";
// require_once "../user.php";
// require_once "../userCrud.php";

// $crud = new Crud();
// // $modelFactory = new ModelFactory($crud);
// // $controller = new PageController();
// $userCrud = new UserCrud($crud);

// ======================================= || DELETE ROW || ==========================================
// $allUsers = $userCrud->readAllUsers();

// foreach($allUsers as $user){
//   echo "ID: " . $user->id . "<br>";
//   echo "NAME: " . $user->name . "<br>";
//   echo "EMAIL: " . $user->email . "<br>";
//   echo "ADMIN: " . $user->admin . "<br>";
//   echo "--------------------------------<br>";
// }
// echo "<br>====================================================================<br>";
// $userCrud->deleteUser(10);
// $i = 20;
// while($i>10){
//   $userCrud->deleteUser($i);
//   $i -= 1;
// }

// $allUsers = $userCrud->readAllUsers();

// foreach($allUsers as $user){
//   echo "ID: " . $user->id . "<br>";
//   echo "NAME: " . $user->name . "<br>";
//   echo "EMAIL: " . $user->email . "<br>";
//   echo "ADMIN: " . $user->admin . "<br>";
//   echo "--------------------------------<br>";
// }




// ======================================= || UPDATE ROW || ==========================================

// $user = $userCrud->readUserById(1);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br><br>";

// $user2 = new User($user->name, $user->email, $user->password, $user->admin, $user->id);
// $user2->setName('Daan');
// $user2->setEmail('dbraas@gmail.com');
// // var_dump(get_object_vars($newUser));
// echo "ID: " . $user2->getId() . "<br>";
// echo "NAME: " . $user2->getName() . "<br>";
// echo "EMAIL: " . $user2->getEmail() . "<br>";
// echo "ADMIN: " . $user2->getAdmin() . "<br><br>";
// $userCrud->updateUser($user2);

// $user = $userCrud->readUserById(1);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br>";

// ======================================= || READ ALL ROWS || ==========================================
// $allUsers = $userCrud->readAllUsers();

// foreach($allUsers as $user){
//   echo "ID: " . $user->id . "<br>";
//   echo "NAME: " . $user->name . "<br>";
//   echo "EMAIL: " . $user->email . "<br>";
//   echo "ADMIN: " . $user->admin . "<br>";
// }


// ======================================= || READ ROW || ==========================================;
// $user = $userCrud->readUserById(7);
// $newUser = new User($user->name, $user->email, $user->password);
// echo "User ID: " . $user->id;
// echo "User ID: " . $user->name;
// echo "User ID: " . $user->password;
// echo "User ID: " . $user->id;
// var_dump(get_object_vars($newUser));




// ======================================= || CREATE ROW || ==========================================
// $user = new User('Daan3', 'daan@mail.nl', 'test', TRUE);
// $user->setId($userCrud->createUser($user));
// echo "User Number: " . $user->getId() . " has been created.<br>";
// echo "Its name is: " . $user->getName() . "<br>";

// $user = $userCrud->readUserById($user->getId());
// $newUser = new User($user->name, $user->email, $user->password);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br><br>";
?>