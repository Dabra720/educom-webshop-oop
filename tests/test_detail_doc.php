<?php
include_once "../views/detail_doc.php";
include_once "../session_manager.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$product1 = array('id'=>1, 'name'=>'Creatine Monohydrate 500g', 'price'=>9.95, 'filename'=>'creatine_monohydate_500g.png');
$data = array('page'=>'detail', 'values'=>array(), 'product'=>$product1, 'menu'=>$menuItems);
// $data = validateChangePassword();

$view = new DetailDoc($data);
$view->show();

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}
?>