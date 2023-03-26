<?php
/*
Indien een gebruiker is ingelogd, kan deze ook op een ster onder het product klikken, dan gebeurt het volgende:
- Voor dat product wordt de "index" van de ster als rating worden opgestuurd naar de AJAX controller.
- (bijv. een klik op de 3de ster onder een product, geeft voor dat product en voor die user een rating van 3)
- Deze zal de nieuwe rating voor dit product toevoegen of bijwerken voor dit product, waarna hij het nieuwe "gemiddelde" rating voor dat product terugstuurt.
- In javascript update je het aantal sterren met dit nieuwe gemiddelde.
*/
require_once "views/ajax_doc.php";

class AjaxController{
  private $crud;
  private $userId;

  public function __construct($modelFactory)
  {
    $this->crud = $modelFactory->createCrud('rating');
    $this->userId = $_SESSION['id'];
  }

  public function handleAction($post){
    $action = Util::getUrlVar('function');
    $productId = Util::getUrlVar('id');
    $rating = $this->crud->readUserProductRating($this->userId, $productId);
    $ajax = new AjaxDoc();
    switch ($action){
      case "getRating":
        // getRating returns JSON: {rating: 'rating', id: 'product_id'}
        // $productId = Util::getUrlVar('id');
        // $rating = $this->crud->readUserProductRating($this->userId, $productId);
        if($rating){
          $ajax->getRating($rating);
        } else{
          $ajax->getRating(array('rating'=>0, 'product_id'=>$productId));
        }
        break;
      case "setRating":
        $rate = $post['rating'];
        // var_dump($post);

        if($rating){
          $this->crud->updateRating($this->userId, $productId, $rate);
        } else{
          $this->crud->createRating($this->userId, $productId, $rate);
        }
        $rating = $this->crud->readUserProductRating($this->userId, $productId);
        $ajax->getRating($rating);
        break;
      default:
        // echo "Handle that action!";
    }
  }

  // private function doesRatingExist($userid, $productid){
  //   if($this->crud->readUserProductRating($userid, $productid)){
  //     return true;
  //   } else {
  //     return false;
  //   }

  // }

  


}

?>