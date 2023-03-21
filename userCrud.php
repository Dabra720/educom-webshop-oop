<?php
require_once "user.php";

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
    return $userId;
  }

  public function readUserByEmail($email){
    $sql = "SELECT * FROM users WHERE email=:email";
    $params = array(":email"=>$email);
    $user = $this->crud->readOneRow($sql, $params, 'User');
    return $user;
  }

  public function readUserById($userId){
    $sql = "SELECT * FROM users WHERE id=:id";
    $params = array(":id"=>$userId);
    $user = $this->crud->readOneRow($sql, $params, 'User');
    return $user;
  }

  // public function readAllUsers(){
  //   $sql = "SELECT * FROM users";
  //   $params = array();
  //   return $this->crud->readMultipleRows($sql, $params);
  // }

  public function updateUser($user){
    $sql = "UPDATE users SET name=:name, email=:email, password=:password, admin=:admin WHERE id=:id";
    $params = array(":name"=>$user->getName(), ":email"=>$user->getEmail(), ":password"=>$user->getPassword(), ":admin"=>$user->getAdmin(), ":id"=>$user->getId());

    $this->crud->updateRow($sql, $params);
  }

  // public function deleteUser($userId){
  //   $sql = "DELETE FROM users WHERE id=:id";
  //   $params = array(":id"=>$userId);

  //   $this->crud->deleteRow($sql, $params);
  // }
}

?>