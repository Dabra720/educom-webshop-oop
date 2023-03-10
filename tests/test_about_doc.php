<?php
include_once "../views/about_doc.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$data = array('page'=>'about', 'values'=>array(), 'menu'=>$menuItems);

$view = new AboutDoc($data);
$view->show();

?>