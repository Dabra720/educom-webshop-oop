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

  // Post meegestuurd omdat ik ze anders niet meer kon ophalen
  public function handleAction($post){
    $action = Util::getUrlVar('function');
    $productId = Util::getUrlVar('id');
    
    $ajax = new AjaxDoc();
    switch ($action){
      case "getRating":
        // echo "Product ID: " . $productId;
        $rating = $this->crud->readAverageRating($productId);
        // var_dump($rating);
        // echo $rating;
        if($rating){ // getRating geeft JSSON{rating:rating, id:productid}
          // Util::logDebug("Wel rating" . $rating['AVG(rating)']);
          $ajax->getRating($rating);
        } else{
          // Util::logDebug("Geen rating");
          $ajax->getRating(array('rating'=>10, 'product_id'=>$productId));
        }
        break;
      case "setRating":
        $rate = $post['rating'];
        $rating = $this->crud->readUserProductRating($this->userId, $productId);
        if($rating){
          $this->crud->updateRating($this->userId, $productId, $rate);
        } else{
          $this->crud->createRating($this->userId, $productId, $rate);
        }
        // $rating = $this->crud->readUserProductRating($this->userId, $productId);
        $rating = $this->crud->readAverageRating($productId);
        $ajax->getRating($rating);
        break;
      default:

    }
  }


  


}

?>