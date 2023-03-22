<?php

class RatingCrud{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = $crud;
  }

  // per product Id de rating (1-5) op te slaan voor deze user Id.
  public function createRating($userId, $productId, $rating){
    $sql = "INSERT INTO ratings (user_id, product_id, rating) VALUES(:userId, :productId, :rating)";
    $params = array(':userId'=>$userId, ':productId'=>$productId, ':rating'=>$rating);

    $this->crud->createRow($sql, $params);
  }

  // per product Id de rating (1-5) bij te werken voor deze user Id.
  public function updateRating($userId, $productId){
    $sql = "UPDATE ratings SET ";
    $params = array();

    $this->crud->updateRow($sql, $params);
  }

  // per product Id de "gemiddelde" rating op te vragen.
  public function readAverageRating($productId){
    $sql = "";
    $params = array();

    $this->crud->readOneRow($sql, $params);
  }

  // een overzicht van alle "gemiddelde" ratings voor alle producten op te vragen.
  public function readAllAverageRatings(){
    $sql = "";
    $params = array();

    $this->crud->readMultipleRows($sql, $params);
  }

}

?>