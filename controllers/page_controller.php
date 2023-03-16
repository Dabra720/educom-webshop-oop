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
          // $this->model->createMenu();
          $this->model->setPage("home");
        }
        break;
      case 'logout':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->doLogoutUser();
        // $this->model->createMenu();
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
      case 'register':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->validateRegister();
        if($this->model->valid){
          $this->model->storeUser($this->model->values['email'], $this->model->values['name'], $this->model->values['password']);
          $this->model->setPage('login');
        }
        break;
      case 'profile':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        // $this->model->hasAuthorisation();
        if($this->model->hasAuthorisation()){// Autorisatie check bouwen in Usermodel.
          $this->model->validatePasswordChange();
          $this->model->setPage('profile');
        } else {
          $this->model->setPage('login');
        }
        break;
      case 'change':
        require_once "models/user_model.php";
        $this->model = new UserModel($this->model);
        $this->model->validatePasswordChange();
        if($this->model->valid){
          $this->model->updateUser('password', $this->model->values['new_pass']);
          $this->model->setPage('profile');
        }// else {$this->model->setPage('change');}
        break;
      case 'webshop':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->handleActions();
        $this->model->getProducts();
        break;
      case 'topFive':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->setTopFive();
        break;
      case 'detail':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->handleActions();
        $this->model->setProduct();
        break;
      case 'cart':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->handleActions();
        $this->model->setCartContent();
        break;
      case 'upload':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->validateProduct();
        if($this->model->valid){
          $target_dir = "C:/xampp/htdocs/educom-webshop-oop/Images/";
          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $this->model->uploadImage($target_file);
          $this->model->storeProduct($this->model->values['name'], $this->model->values['message'], $this->model->values['price'], $_FILES["image"]["name"]);
          $this->model->setPage('webshop');
          $this->model->getProducts();
        }
        break;
      case 'home':
        require_once "models/product_model.php";
        $this->model = new ProductModel($this->model);
        $this->model->handleActions();
    }
  }

  // to client: presentatie laag
  private function showResponsePage(){
    $this->model->createMenu();
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
      case "thanks":
        require_once "views/contact_thanks_doc.php";
        $view = new ContactThanksDoc($this->model);
        break;
      case "register":
        require_once "views/register_doc.php";
        $view = new RegisterDoc($this->model);
        break;
      case "login":
        require_once "views/login_doc.php";
        $view = new LoginDoc($this->model);
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
      case 'upload':
        require_once "views/upload_doc.php";
        $view = new UploadDoc($this->model);
        break;
      default:
      require_once "views/basic_doc.php";
        $view = new BasicDoc($this->model); // 404 Error
    }
    $view->show();
  }
}

?>