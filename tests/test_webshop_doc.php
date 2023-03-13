<?php
include_once "../views/webshop_doc.php";
include_once "../session_manager.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$product1 = array('id'=>1, 'name'=>'Product1', 'price'=>9.95, 'filename'=>'creatine_monohydate_500g.png');
$product2 = array('id'=>2, 'name'=>'Product2', 'price'=>19.95, 'filename'=>'whey_delicious_vanilla_1000g.png'); 
$products = array(1=>$product1, 2=>$product2);
$data = array('page'=>'basic', 'products'=>$products, 'values'=>array(), 'menu'=>$menuItems);

$view = new WebshopDoc($data);
$view->show();

?>