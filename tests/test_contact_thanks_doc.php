<?php
include_once "../views/contact_thanks_doc.php";

define("SALUTATIONS", array("Dhr"=>"Dhr", "Mvr"=>"Mvr"));
define("COMM_PREFS", array("email"=>"E-Mail", "phone"=>"Telefoon"));

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$contact = array('id'=>1, 'name'=>'Daan', 'email'=>'dbraas@gmail.com', 'phone'=>'0643820378', 'aanhef'=>'Mvr', 'message'=>'Hallo, ik heb een klacht.', 'voorkeur'=>'Telefoon');
$data = array('page'=>'profile', 'values'=>$contact, 'menu'=>$menuItems);
// $data = validateChangePassword();

$view = new ContactThanksDoc($data);
$view->show();

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}
?>