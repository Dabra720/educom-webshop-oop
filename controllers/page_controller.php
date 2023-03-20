<?php 
require_once "models/page_model.php";

class PageController{
  private $model;
  private $modelFactory;

  public function __construct($modelFactory){
    $this->model = new PageModel(NULL);
    $this->modelFactory = $modelFactory;
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
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");
        $this->model->validateLogin();
        break;
      case 'logout':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");
        $this->model->doLogoutUser();
        break;
      case 'contact';
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");;
        $this->model->validateContact();
        break;
      case 'register':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");
        $this->model->validateRegister();
        break;
      case 'profile':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");
        $this->model->loginCheck();
        break;
      case 'change':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("user");
        $this->model->validatePasswordChange();
        $this->model->loginCheck();
        break;
      case 'webshop':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        $this->model->handleActions();
        $this->model->setProducts();
        break;
      case 'topFive':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        $this->model->setTopFive();
        break;
      case 'detail':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        $this->model->handleActions();
        $this->model->setProduct();
        break;
      case 'cart':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        $this->model->handleActions();
        $this->model->setCartContent();
        $this->model->loginCheck();
        break;
      case 'upload':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        $this->model->validateProduct();
        break;
      case 'delete':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
        if($this->model->isAdmin()){
          $this->model->deleteProduct();
          $this->model->setPage('webshop');
          $this->model->setProducts();
        }
      case 'home':
        $this->modelFactory->pageModel = $this->model;
        $this->model = $this->modelFactory->createModel("product");
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