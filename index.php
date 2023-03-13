<?php 
session_start();
require 'validation.php';
require 'service.php';
// require 'product_service.php';
require 'session_manager.php';

$page = getRequestedPage();
$data = processRequest($page);
// var_dump($data);
// var_dump($_SESSION);
showResponsePage($data);

function getRequestedPage() 
{     
   $requested_type = $_SERVER['REQUEST_METHOD']; 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getPostVar('page','home');
   } 
   else 
   { 
       $requested_page = getUrlVar('page','home');
   } 
   $requested_page = test_input($requested_page);
   return $requested_page; 
} 

function processRequest($page){
  switch ($page){
    case 'login':
      $data = validateLogin();
      if($data['validForm']){
        doLoginUser($data);
        $page = 'home';
      }
      break;
    case 'logout':
      doLogoutUser();
      $page = 'home';
      break;
    case 'contact';
      $data = validateContact();
      if($data['validForm']){
        $page = 'thanks';
      }
      break;
    case 'register':
      $data = validateRegister();
      if($data['validForm']){
        storeUser($data['values']['email'], $data['values']['name'], $data['values']['password']);
        $page = 'login';
      }
      break;
    case 'profile':
        if(isUserLoggedIn()){
          $data = validateChangePassword();
          $page='profile';
        } else {
          $data = validateLogin();
          $page ='login';
        }
      break;
    case 'change':
      $data = validateChangePassword();
      if($data['validForm']){
        updateUser('password', $data['values']['new_pass']);
        $data = validateChangePassword();
        $page = 'profile';
      } else {$page = 'change';}
      break;
    case 'webshop':
      handleActions();
      $data = getProducts();
      break;
    case 'topFive':
      $data = getTopFive();
      break;
    case 'detail':
      handleActions();
      if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data['product'] = getProductBy('id', getUrlVar('id'));
      } else{
        $data['product'] = getProductBy('id', getPostVar('id'));
      }
      break;
    case 'cart':
      handleActions();
      break;
    case 'home':
      handleActions();
      break;
  }
  $data['page'] = $page;
  $data['menu'] = array('home' => 'HOME', 'about' => 'ABOUT', 'contact' => 'CONTACT', 'webshop'=>'WEBSHOP', 'topFive'=>'TOP 5');
  if(isUserLoggedIn()){
    $data['menu']['cart'] = "SHOPPINGCART";
    $data['menu']['profile'] = "PROFILE";
    $data['menu']['logout'] = "LOGOUT " . getCurrentUser('name');
  } else{
    $data['menu']['register'] = "REGISTER";
    $data['menu']['login'] = "LOGIN";
  }
  return $data;
}

function showResponsePage($data){
  $view = NULL;

  switch($data['page']){
    case "home":
      require_once 'views/home_doc.php';
      $view = new HomeDoc($data);
      break;
    case "about":
      require_once 'views/about_doc.php';
      $view = new AboutDoc($data);
      break;
    case "contact":
      require_once "views/contact_doc.php";
      $view = new ContactDoc($data);
      break;
    case "register":
      require_once "views/register_doc.php";
      $view = new RegisterDoc($data);
      break;
    case "login":
      require_once "views/login_doc.php";
      $view = new LoginDoc($data);
      break;
    case "thanks":
      require_once "views/contact_thanks_doc.php";
      $view = new ContactThanksDoc($data);
      break;
    case "profile":
      require_once "views/profile_doc.php";
      $view = new ProfileDoc($data);
      break;
    case 'change':
      require_once "views/change_password_doc.php";
      $view = new ChangePasswordDoc($data);
      break;
    case 'webshop':
      require_once "views/webshop_doc.php";
      $view = new WebshopDoc($data);
      break;
    case 'topFive':
      require_once "views/topFive_doc.php";
      $view = new TopFiveDoc($data);
      break;
    case 'detail':
      include_once "views/detail_doc.php";
      $view = new DetailDoc($data);
      break;
    case 'cart':
      require_once "views/cart_doc.php";
      $view = new CartDoc($data);
      break;
    default:
      pageNotFound($data);
  }
  $view->show();
}

function pageNotFound($data){
  var_dump($data);
  echo '<h1>PAGE NOT FOUND 404</h1>';
}

function getValue($data, $key, $default=''){
  return getArrayVar($data['values'], $key, $default);
}
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}

function getPostVar($key, $default='')
{ 
  $value = filter_input(INPUT_POST, $key); 
  return isset($value) ? $value : $default;
} 

function getUrlVar($key, $default=''){
  return isset($_GET[$key]) ? $_GET[$key] : $default;
}

// Debug tool, om variabelen makkelijk te kunnen checken
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "');</script>";
}

function logDebug($msg){
  debug_to_console($msg);
}

?>