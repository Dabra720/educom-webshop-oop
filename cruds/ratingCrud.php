<?php

class RatingCrud{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = $crud;
  }

  // per product Id de rating (1-5) op te slaan voor deze user Id.
  public function createRating($userId, $productId){

  }

  // per product Id de rating (1-5) bij te werken voor deze user Id.
  public function updateRating($userId, $productId){

  }

  // per product Id de "gemiddelde" rating op te vragen.
  public function readAverageRating($productId){

  }

  // een overzicht van alle "gemiddelde" ratings voor alle producten op te vragen.
  public function readAllAverageRatings(){

  }

}

?>