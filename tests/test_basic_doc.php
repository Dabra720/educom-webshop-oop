<?php
include_once "../views/basic_doc.php";

$menuItems = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
$data = array('page'=>'basic', 'values'=>array(), 'menu'=>$menuItems);

$view = new BasicDoc($data);
$view->show();

?>