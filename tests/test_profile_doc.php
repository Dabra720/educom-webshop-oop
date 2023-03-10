<?php
include_once "../views/profile_doc.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$profile = array('id'=>1, 'name'=>'Daan', 'email'=>'dbraas@gmail.com', 'password'=>'test');
$data = array('page'=>'profile', 'values'=>$profile, 'menu'=>$menuItems);
// $data = validateChangePassword();

$view = new ProfileDoc($data);
$view->show();

?>