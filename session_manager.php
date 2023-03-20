<?php 

//=================== USER ========================
class SessionManager{
  public function doLoginUser($user){
  $_SESSION['id'] = $user->getId();
  $_SESSION['name'] = $user->getName();
  $_SESSION['admin'] = $user->getAdmin(); // Om admin status te kunnen checken
  $_SESSION['cart'] = array();
  }
  public function isUserLoggedIn(){
    if(isset($_SESSION['name'])){
      return TRUE;
    } else { return FALSE; }
  }
  public function getCurrentUser($value){
    switch($value){
      case 'name':
        return $_SESSION['name'];
      case 'id':
        return $_SESSION['id'];
      case 'admin':
        return $_SESSION['admin'];
    }
  }
  public function doLogoutUser(){
    session_unset();
  }

  //=================== PRODUCT ========================
  public function storeInCart($productId, $amount){
    // debug_to_console('Amount to store: ', $amount);
    
    if(isset($_SESSION['cart'][$productId])){
      $_SESSION['cart'][$productId] += $amount;
    }else{
      $_SESSION['cart'][$productId] = $amount;
    }
  }
  public function updateCart($productId, $amount){
    $_SESSION['cart'][$productId] = $amount;
  }
  public function removeFromCart($productId){
    unset($_SESSION['cart'][$productId]);
  }
  public function emptyCart(){
    $_SESSION['cart'] = array();
  }

  public function getCartContent(){
    return $_SESSION['cart'];
  }

  public function getAmountFromCart($productId){
    // $amount = getArrayVar(getCartContent(),$productId);
    // debug_to_console($amount);
    return Util::getArrayVar($this->getCartContent(),$productId);
  }

}

?>