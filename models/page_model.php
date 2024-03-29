<?php 
require_once "menu_item.php";
require_once "session_manager.php";
require_once "Util.php";

class PageModel{
  public $page;
  protected $isPost = false;
  public $menu;
  protected $sessionManager;
  public $values = array();
  public $errors = array();
  public $user = NULL;
  protected $valid = false;
  protected $crud;

  public function __construct($copy){
    if(empty($copy)){
      // First instance of PageModel
      $this->sessionManager = new SessionManager();
    }else{
      // Called from the constructor of an extended class...
      $this->page = $copy->page;
      $this->isPost = $copy->isPost;
      $this->menu = $copy->menu;
      $this->sessionManager = $copy->sessionManager;
      $this->values = $copy->values;
      $this->errors = $copy->errors;
    }
  }

  public function getRequestedPage(){     
    $this->isPost = ($_SERVER['REQUEST_METHOD']=="POST"); 
    if ($this->isPost)
    { 
      $this->setPage(Util::getPostVar('page','home'));
    } 
    else
    { 
      $this->setPage(Util::getUrlVar('page','home'));
    } 
  }

  public function getRequestedAction(){
    if ($this->isPost)
    { 
      return (Util::getPostVar('action'));
    } 
    else
    { 
      return (Util::getUrlVar('action'));
    } 
  }

  public function setPage($newPage){
    $this->page = $newPage;
  }

  public function hasAuthorisation(){
    return $this->sessionManager->isUserLoggedIn();
  }

  public function isAdmin(){
    if($this->sessionManager->isUserLoggedIn()){
      // return $this->user->getAdmin();
      return $this->sessionManager->getCurrentUser('admin');
    }else{
      return false;
    }
  }
  public function getUserId(){
    return $this->sessionManager->getCurrentUser('id');
  }

  // Voor elke pagina die alleen voor logged in users is.
  public function loginCheck(){
    if(!$this->sessionManager->isUserLoggedIn()){
      $this->setPage('login');
    }
  }

  public function createMenu(){
    $this->menu['home'] = new MenuItem('home', 'HOME');
    $this->menu['about'] = new MenuItem('about', 'ABOUT');
    $this->menu['contact'] = new MenuItem('contact', 'CONTACT');
    $this->menu['webshop'] = new MenuItem('webshop', 'WEBSHOP');
    $this->menu['topFive'] = new MenuItem('topFive', 'TOP 5');
    if($this->sessionManager->isUserLoggedIn()){
      $this->menu['cart'] = new MenuItem('cart', 'SHOPPINGCART');
      $this->menu['profile'] = new MenuItem('profile', 'PROFILE');
      $this->menu['logout'] = new MenuItem('logout', 'LOGOUT ' . $this->sessionManager->getCurrentUser('name'));
    } else{
      $this->menu['register'] = new MenuItem('register', 'REGISTER');
      $this->menu['login'] = new MenuItem('login', 'LOGIN');
    }
  }
}

?>