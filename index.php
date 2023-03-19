<?php 
// // index.php NEW
session_start();
require_once "controllers/page_controller.php";
// require_once "crud.php";
require_once "tests/testCrud.php";
require_once "modelFactory.php";
require_once "user.php";

// $crud = new Crud();
$crud = new TestCrud();
$modelFactory = new ModelFactory($crud);
$controller = new PageController($modelFactory);
// var_dump($_SESSION);
// $controller = new PageController();
$controller->handleRequest();

?>