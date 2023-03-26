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

    return $this->crud->createRow($sql, $params);
  }

  // per product Id de rating (1-5) bij te werken voor deze user Id.
  public function updateRating($userId, $productId, $rating){
    $sql = "UPDATE ratings SET rating=:rating WHERE user_id=:user_id AND product_id=:product_id";
    $params = array(':rating'=>$rating, ':user_id'=>$userId, ':product_id'=>$productId);

    $this->crud->updateRow($sql, $params);
  }

  public function readUserProductRating($userId, $productId){
    $sql = "SELECT * FROM ratings WHERE user_id=:userId AND product_id=:productId";
    $params = array(':userId'=>$userId, ':productId'=>$productId);

    return $this->crud->readOneRow($sql, $params, NULL);
  }
  // per product Id de "gemiddelde" rating op te vragen.
  public function readAverageRating($productId){
    $sql = "SELECT product_id, AVG(rating) AS rating FROM `ratings` WHERE product_id=:product_id";
    $params = array(':product_id'=>$productId);

    return $this->crud->readOneRow($sql, $params, NULL);
  }

  // een overzicht van alle "gemiddelde" ratings voor alle producten op te vragen.
  public function readAllAverageRatings(){
    $sql = "SELECT product_id, AVG(rating) FROM `ratings` GROUP BY product_id";
    $params = array();

    return $this->crud->readMultipleRows($sql, $params, NULL);
  }


}

?>