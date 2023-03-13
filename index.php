<?php 
// // index.php NEW
session_start();
require_once "controllers/page_controller.php";

$controller = new PageController();
$controller->handleRequest();

?>