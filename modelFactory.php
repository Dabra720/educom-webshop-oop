<?php

class ModelFactory{
  private $crud;

  public function __construct($crud){
    $this->crud = $crud;
  }

  public function createModel($name){
    $model = NULL;
    switch ($name){
      case "user":
        // $model = new UserModel();
        break;
      case "product":

        break;
    }
  }

} 

class CrudFactory{

}

?>