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

  public function __construct($crud)
  {
    $this->crud = new RatingCrud($crud);
    $this->userId = $_SESSION['id'];
  }

  public function handleAction(){
    Util::logDebug('<< Action handle >>');
    $action = Util::getUrlVar('function');
    $ajax = new AjaxDoc();
    switch ($action){
      case "setRating":
        Util::logDebug('<< setting rating: >>');
        var_dump($_POST);
        // $productId = Util::getPostVar('product_id');
        $productId = Util::getUrlVar('id');
        Util::logDebug('<< product id: >>' . $productId);
        var_dump(get_object_vars($this->crud->readUserById(2)));
        $rating = $this->crud->readUserProductRating($this->userId, $productId);
        if($rating){
          $ajax->setRating($rating);
        } else{
          $ajax->setRating(array('rating'=>0, 'product_id'=>$productId));
        }
        break;
      case "getRating":
        $ajax->getRating(Util::getPostVar('rating'), 2);
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