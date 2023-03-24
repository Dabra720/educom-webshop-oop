<?php

class AjaxDoc{

  public function __construct()
  {
    header("Content-Type: application/json");
  }

  public function setRating($rating){
    $array = array('rating'=>$rating['rating'], 'id'=>$rating['product_id']);
    echo json_encode($array);
  }

  public function getRating($rating, $id){
    $array = array('rating'=>$rating, 'id'=>$id);
    echo json_encode($array);
  }

  // public function showContent(){

  // }
}


?>