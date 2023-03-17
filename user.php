<?php

class User{
  private $id;
  public $name;
  private $email;
  private $password;
  private $admin;
  

  public function __construct($name, $email, $password, $admin="false")
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->admin = $admin;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($userId){
    $this->id = $userId;
  }
  
  public function getEmail(){
    return $this->email;
  }
  public function setEmail($email){
    $this->email = $email;
  }

  // DEZE MOET UITEINDELIJK VERWIJDERD WORDEN!!
  public function getPassword(){
    return $this->password;
  }
  public function setPassword($password){
    $this->password = $password;
  }

  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
  }

  public function getAdmin(){
    return $this->admin;
  }
  public function setAdmin($admin){
    $this->admin = $admin;
  }

}

?>