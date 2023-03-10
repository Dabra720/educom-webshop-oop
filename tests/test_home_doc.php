<?php
include_once "../views/home_doc.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$data = array('page'=>'Home', 'values'=>array(), 'menu'=>$menuItems);

$view = new HomeDoc($data);
$view->show();

?>