<?php 
require_once "models/page_model.php";

class PageController{
  private $model;

  public function __construct(){
    $this->model = new PageModel(NULL);
  }

  public function handleRequest(){
    $this->getRequest();
    $this->processRequest();
    $this->showResponsePage();
  }

  // From client
  private function getRequest(){
    $this->model->getRequestedPage();
  }

  // Business flow code
  private function processRequest(){
    switch ($this->model->page){
      case 'login':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->validateLogin();
        if($this->model->valid){
          $this->model->doLoginUser($this->model->values);
          $this->model->setPage("login");
        }
        break;
      case 'logout':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->doLogoutUser();
        $this->model->setPage("home");
        break;
      case 'contact';
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->validateContact();
        if($this->model->valid){
          $this->model->setPage('thanks');
        }
        break;
    //   case 'register':
    //     $data = validateRegister();
    //     if($data['validForm']){
    //       storeUser($data['values']['email'], $data['values']['name'], $data['values']['password']);
    //       $page = 'login';
    //     }
    //     break;
    //   case 'profile':
    //       if(isUserLoggedIn()){
    //         $data = validateChangePassword();
    //         $page='profile';
    //       } else {
    //         $data = validateLogin();
    //         $page ='login';
    //       }
    //     break;
    //   case 'change':
    //     $data = validateChangePassword();
    //     if($data['validForm']){
    //       updateUser('password', $data['values']['new_pass']);
    //       $data = validateChangePassword();
    //       $page = 'profile';
    //     } else {$page = 'change';}
    //     break;
    //   case 'webshop':
    //     handleActions();
    //     $data = getProducts();
    //     break;
    //   case 'topFive':
    //     $data = getTopFive();
    //     break;
    //   case 'detail':
    //     handleActions();
    //     if($_SERVER['REQUEST_METHOD'] == "GET"){
    //       $data['product'] = getProductBy('id', getUrlVar('id'));
    //     } else{
    //       $data['product'] = getProductBy('id', getPostVar('id'));
    //     }
    //     break;
    //   case 'cart':
    //     handleActions();
    //     break;
    //   case 'home':
    //     handleActions();
    //     break;
    }
  }

  // to client: presentatie laag
  private function showResponsePage(){
    $view = NULL;

    switch($this->model->page){
      case "home":
        require_once 'views/home_doc.php';
        $view = new HomeDoc($this->model);
        break;
      case "about":
        require_once 'views/about_doc.php';
        $view = new AboutDoc($this->model);
        break;
      case "contact":
        require_once "views/contact_doc.php";
        $view = new ContactDoc($this->model);
        break;
      case "register":
        require_once "views/register_doc.php";
        $view = new RegisterDoc($this->model);
        break;
      case "login":
        require_once "views/login_doc.php";
        $view = new LoginDoc($this->model);
        break;
      case "thanks":
        require_once "views/contact_thanks_doc.php";
        $view = new ContactThanksDoc($this->model);
        break;
      case "profile":
        require_once "views/profile_doc.php";
        $view = new ProfileDoc($this->model);
        break;
      case 'change':
        require_once "views/change_password_doc.php";
        $view = new ChangePasswordDoc($this->model);
        break;
      case 'webshop':
        require_once "views/webshop_doc.php";
        $view = new WebshopDoc($this->model);
        break;
      case 'topFive':
        require_once "views/topFive_doc.php";
        $view = new TopFiveDoc($this->model);
        break;
      case 'detail':
        include_once "views/detail_doc.php";
        $view = new DetailDoc($this->model);
        break;
      case 'cart':
        require_once "views/cart_doc.php";
        $view = new CartDoc($this->model);
        break;
      default:
        $view = new BasicDoc($this->model); // 404 Error
    }
    $view->show();
  }
}

?>