<?php

// $data = array();

// if($_SERVER['REQUEST_METHOD']=="POST"){
  // var_dump($_POST);
  // $data = new AjaxDoc();
class AjaxDoc{


  public function __construct()
  {
    header("Content-Type: application/json");
    $model = array('success'=>FALSE, 'result'=>5, 'rating'=>$_POST['rating']);
    $json = json_encode($model);
    echo $json;
  }

  public function getRating($rating, $id){
    $array = array('rating'=>$rating, 'id'=>$id);

    echo json_encode($array);

  }

  // public $success;
  // public $result;
  // public $rating;

  // $data->success = true;
  // $data->result = 1;
  // $data->rating = $_POST['rating'];
  // // $data = array('success'=>FALSE, 'result'=>5, 'rating'=>$_POST['rating']);

  // $json = json_encode($data);
  // header("Content-Type: application/json");
  // echo $json;


}

?>