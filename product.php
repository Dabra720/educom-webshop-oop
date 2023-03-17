<?php

class Product{
  private $id;
  private $name;
  private $description;
  private $price;
  private $filename;
  

  public function __construct($name, $description, $price, $filename, $id=NULL)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->filename = $filename;
    $this->price = $price;

  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id = $id;
  }


  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
  }

  public function getDescription(){
    return $this->description;
  }
  public function setDescription($description){
    $this->description = $description;
  }

  public function getPrice(){
    return $this->price;
  }
  public function setPrice($price){
    $this->price = $price;
  }

  public function getFilename(){
    return $this->filename;
  }
  public function setFilename($filename){
    $this->filename = $filename;
  }
}

?>