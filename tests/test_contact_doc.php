<?php
include_once "../views/contact_doc.php";

define("SALUTATIONS", array("Dhr"=>"Dhr", "Mvr"=>"Mvr"));
define("COMM_PREFS", array("email"=>"E-Mail", "phone"=>"Telefoon"));

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');

$data = array('page'=>'contact', 'values'=>array(), 'errors'=>array(), 'menu'=>$menuItems);

$view = new ContactDoc($data);
$view->show();

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}

?>