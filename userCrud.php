<?php

class UserCrud{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = $crud;
  }

  // Returns created user's id
  public function createUser($user){
    $sql = "INSERT INTO users(email, name, password, admin) VALUES(:email, :name, :password, :admin)";
    $params = array(':email'=>$user->getEmail(), ':name'=>$user->getName(), ':password'=>$user->getPassword(), ':admin'=>$user->getAdmin());
    
    $userId = $this->crud->createRow($sql, $params);
    // $user = new User()
    return $userId;
  }

  public function readUserByEmail($email){

  }

  public function readUserById($userId){
    $sql = "SELECT * FROM users WHERE id=:id";
    $params = array(":id"=>$userId);

    return $this->crud->readOneRow($sql, $params);
  }

  public function readAllUsers(){
    $sql = "SELECT * FROM users";
    $params = array();
    return $this->crud->readAllRows($sql, $params);
  }

  public function updateUser($user){
    $sql = "UPDATE users SET name=:name, email=:email, password=:password, admin=:admin WHERE id=:id";
    $params = array(":name"=>$user->getName(), ":email"=>$user->getEmail(), ":password"=>$user->getPassword(), ":admin"=>$user->getAdmin(), ":id"=>$user->getId());

    $this->crud->updateRow($sql, $params);
  }

  public function deleteUser($userId){
    $sql = "DELETE FROM users WHERE id=:id";
    $params = array(":id"=>$userId);

    $this->crud->deleteRow($sql, $params);
  }
}

?>