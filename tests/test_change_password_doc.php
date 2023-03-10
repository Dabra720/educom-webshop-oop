<?php
include_once "../views/change_password_doc.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$data = array('page'=>'about', 'values'=>array(), 'errors'=>array(), 'menu'=>$menuItems);

$view = new ChangePasswordDoc($data);
$view->show();

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}

?>