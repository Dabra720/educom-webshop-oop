<?php
/*
Indien een gebruiker is ingelogd, kan deze ook op een ster onder het product klikken, dan gebeurt het volgende:
- Voor dat product wordt de "index" van de ster als rating worden opgestuurd naar de AJAX controller.
- (bijv. een klik op de 3de ster onder een product, geeft voor dat product en voor die user een rating van 3)
- Deze zal de nieuwe rating voor dit product toevoegen of bijwerken voor dit product, waarna hij het nieuwe "gemiddelde" rating voor dat product terugstuurt.
- In javascript update je het aantal sterren met dit nieuwe gemiddelde.
*/

class AjaxController{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = new RatingCrud($crud);
  }

  public function handleAction(){
    // $action = Util::getUrlVar('function');
    $action = Util::getPostVar('function');
    switch ($action){
      case "setRating":
        $ajax = new AjaxDoc();
        $ajax->getRating(Util::getPostVar('rating'), 2);
        break;
      case "getRating":

        break;
      default:
        echo "Handle that action!";
      }
    }
  


}

?>