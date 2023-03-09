<?php 

//=================== USER ========================
function doLoginUser($data){
  $_SESSION['id'] = $data['values']['id'];
  $_SESSION['name'] = $data['values']['name'];
  $_SESSION['cart'] = array();
}
function isUserLoggedIn(){
  if(isset($_SESSION['name'])){
    return TRUE;
  } else { return FALSE; }
}
function getCurrentUser($value){
  switch($value){
    case 'name':
      return $_SESSION['name'];
    case 'id':
      return $_SESSION['id'];
  }
}
function doLogoutUser(){
  session_unset();
}

//=================== PRODUCT ========================
function storeInCart($productId, $amount){
  // debug_to_console('Amount to store: ', $amount);
  
  if(isset($_SESSION['cart'][$productId])){
    $_SESSION['cart'][$productId] += $amount;
  }else{
    $_SESSION['cart'][$productId] = $amount;
  }
}
function updateCart($productId, $amount){
  $_SESSION['cart'][$productId] = $amount;
}
function removeFromCart($productId){
  unset($_SESSION['cart'][$productId]);
}
function emptyCart(){
  $_SESSION['cart'] = array();
}

function getCartContent(){
  return $_SESSION['cart'];
}

function getAmountFromCart($productId){
  $amount = getArrayVar(getCartContent(),$productId);
  // debug_to_console($amount);
  return getArrayVar(getCartContent(),$productId);
}

?>