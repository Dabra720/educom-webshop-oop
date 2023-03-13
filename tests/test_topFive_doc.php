<?php
include_once "../views/topFive_doc.php";
include_once "../session_manager.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$product1 = array('id'=>1, 'name'=>'Creatine Monohydrate 500g', 'price'=>18.95, 'filename'=>'creatine_monohydate_500g.png', 'quantity'=>25);
$product2 = array('id'=>2, 'name'=>'Whey Delicious 1000g Eiwitshake Coconut', 'price'=>29.95, 'filename'=>'creatine_monohydate_500g.png', 'quantity'=>25);
$product3 = array('id'=>3, 'name'=>'	Whey Delicious 1000g Eiwitshake Raspberry/kiwi', 'price'=>9.95, 'filename'=>'creatine_monohydate_500g.png', 'quantity'=>25);
$product4 = array('id'=>4, 'name'=>'Whey Delicious 1000g Eiwitshake Vannilla', 'price'=>9.95, 'filename'=>'creatine_monohydate_500g.png', 'quantity'=>25);
$product5 = array('id'=>5, 'name'=>'XXL Shaker zwart (bidon) 800ml', 'price'=>7.95, 'filename'=>'creatine_monohydate_500g.png', 'quantity'=>25);
$top = array(1=>$product1, 2=>$product2, 3=>$product3, 4=>$product4, 5=>$product5);
$data = array('page'=>'detail', 'values'=>array(), 'top'=>$top, 'menu'=>$menuItems);
// $data = validateChangePassword();

$view = new TopFiveDoc($data);
$view->show();

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}
?>