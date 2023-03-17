<?php 
// // index.php NEW
session_start();
require_once "controllers/page_controller.php";

// $crud = new Crud();
// $modelFactory = new ModelFactory($crud);
// $controller = new PageController($modelFactory);

$controller = new PageController();
$controller->handleRequest();

?>