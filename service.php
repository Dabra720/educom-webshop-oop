<?php
require 'repository.php';

// ================================= USERS ==================================
function authenticateUser($email, $password){
  $user = findUserByEmail($email);
  if(!empty($user)){
    if($user['password']==$password){
      return $user;
    }
  } else{
    return NULL;
  }
}

function getUserBy($search, $value){
  switch($search){
    case 'email':
      $user = findUserByEmail($value);
      return $user;
    case 'id':
      $user = findUserById($value);
      return $user;
  }
  return NULL;

}

function doesEmailExist($email){
  if(!is_null(findUserByEmail($email))){
    return true;
  } else {return false;}
}

function storeUser($email, $name, $password){
  saveUser($email, $name, $password);
}

// ================================= PRODUCTS ==================================
function getProducts(){
  $data = selectProducts();
  return $data;
}

function getTopFive(){
  $data = selectTopFive();
  return $data;
}

function getProductBy($search, $value){
  switch($search){
    case 'id':
      $product = findProductById($value);
      return $product;
  }
  return NULL;
}

// Om het toevoegen van een knop makkelijker te maken
function addAction($nextpage, $action, $buttonTxt, $productId = NULL, $name = NULL){
  $amount = getAmountFromCart($productId);
  // debug_to_console('Amount: ' . $amount);
  // debug_to_console('Id: ' . $productId);
  if (isUserLoggedIn()){
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
function handleActions(){
  $action = getPostVar("action");
  switch($action) {
    case "updateCart":
      $productId = getPostVar("id");
      $amount = getPostVar("amount");
      if($amount == 0){
        removeFromCart($productId);
      } else if($amount > 0){
        updateCart($productId, $amount);
      }
      break;
    case "order":
      $user_id = getCurrentUser("id");
      $cartContent = getCartContent();
      if($cartContent)
      saveOrder($user_id, $cartContent);
      break;
  }
}

function saveOrder($userId, $cartContent){

  try{
    storeOrder($userId, $cartContent);
    emptyCart();
  }catch(Exception $e){

  }

}
?>