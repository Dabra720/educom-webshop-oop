<?php
require_once "page_model.php";

class ProductModel extends PageModel{
  public $products = array();
  public $product = array();
  // public $topFive = array();

  public function __construct($pageModel)
  {
    PARENT::__construct($pageModel);
  }

  // public function validateProduct(){
  //   if($this->isPost){
  //     $this->product['id'] = Util::getPostVar('id');
  //     $this->product['amount'] = Util::getPostVar('amount');
  //   }
  //   if(!empty($data['product'])){
  //     $this->valid = true;
  //   }
  // }

  public function setProduct($id=NULL){
    if(is_null($id)){
      if($this->isPost){
        $this->product = $this->getProductBy('id', Util::getPostVar('id'));
      } else {
        $this->product = $this->getProductBy('id', Util::getUrlVar('id'));
      }
    } else{
      $this->product = $this->getProductBy('id', $id);
    }
    
  }

  public function getProducts(){
    require_once "repository.php";
    $this->products = selectProducts();
  }

  public function getProductBy($search, $value){
    require_once "repository.php";
    switch($search){
      case 'id':
        $product = findProductById($value);
        return $product;
    }
    return NULL;
  }

  public function setTopFive(){
    require_once "repository.php";
    $this->products = getTopFive();
  }

  public function setCartContent(){
    $this->products = $this->sessionManager->getCartContent();
  }

  // Om het toevoegen van een knop makkelijker te maken
  public function addAction($nextpage, $action, $buttonTxt, $productId = NULL, $name = NULL){
    $amount = $this->sessionManager->getAmountFromCart($productId);
    // debug_to_console('Amount: ' . $amount);
    // debug_to_console('Id: ' . $productId);
    if ($this->sessionManager->isUserLoggedIn()){
      echo "<form class='form-inline' action='index.php' method='post'>";
      echo "<div class='form-group'>";
      echo "<input type='hidden' name='action' value='$action'>";
      if(!empty($productId)){
        echo "<input type='number' name='amount' class='form-control' value='"; echo (!empty($amount)) ? $amount : '0'; echo "' min='0' style='width: 70px;'>";
        echo "<input type='hidden' name='id' value='$productId'>";
      }
      if(!empty($name)) {
        echo "<input type='hidden' name='name' value='$name'>";
      }
      echo "<input type='hidden' name='page' value='$nextpage'>";
      echo "<button class='btn btn-light'>$buttonTxt</button>";
      echo "</div>";
      echo "</form>";
    }
  }

  // Voor het afhandelen van de acties van de knoppen van hierboven ^^
  public function handleActions(){
    $action = Util::getPostVar("action");
    switch($action) {
      case "updateCart":
        $productId = Util::getPostVar("id");
        $amount = Util::getPostVar("amount");
        if($amount == 0){
          $this->sessionManager->removeFromCart($productId);
        } else if($amount > 0){
          $this->sessionManager->updateCart($productId, $amount);
        }
        break;
      case "order":
        $user_id = $this->sessionManager->getCurrentUser("id");
        $cartContent = getCartContent();
        if($cartContent)
        saveOrder($user_id, $cartContent);
        break;
    }
  }

}




?>