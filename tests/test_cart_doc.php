<?php
include_once "../views/cart_doc.php";

$isUserLoggedIn = false;

$product1 = array('id'=>1, 'name'=>'Product1', 'price'=>9.95, 'filename'=>'creatine_monohydate_500g.png');
$product2 = array('id'=>2, 'name'=>'Product2', 'price'=>19.95, 'filename'=>'whey_delicious_vanilla_1000g.png'); 
define("cartContent", array(1=>$product1, 2=>$product2));
$data = array('page'=>'basic', 'cart'=>cartContent, 'values'=>array());
$data['menu'] = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
  if($isUserLoggedIn){
    $data['menu']['cart'] = "SHOPPINGCART";
    $data['menu']['profile'] = "PROFILE";
    $data['menu']['logout'] = "LOGOUT " . getCurrentUser('name');
  } else{
    $data['menu']['register'] = "REGISTER";
    $data['menu']['login'] = "LOGIN";
  }

  function getCartContent(){
    return cartContent;
  }


$view = new CartDoc($data);
$view->show();

// Werkt hier nog niet, wel in index.
?>