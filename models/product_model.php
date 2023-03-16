<?php
require_once "page_model.php";

class ProductModel extends PageModel{
  public $products = array();
  public $product = array();
  // public $values = array();
  // public $topFive = array();

  public function __construct($pageModel)
  {
    PARENT::__construct($pageModel);
  }

  public function setProduct($id=NULL){
    if(is_null($id)){
      if($this->isPost){
        $this->product = $this->getProductBy('id', Util::getPostVar('id'));
      } else {
        $this->product = $this->getProductBy('id', Util::getUrlVar('id'));
      }
    } else{
      $this->product = $this->getProductBy('id', $id);
    }
    
  }

  public function getProducts(){
    require_once "repository.php";
    $this->products = selectProducts();
  }

  public function getProductBy($search, $value){
    require_once "repository.php";
    switch($search){
      case 'id':
        $product = findProductById($value);
        return $product;
    }
    return NULL;
  }

  public function setTopFive(){
    require_once "repository.php";
    $this->products = getTopFive();
  }

  public function setCartContent(){
    $this->products = $this->sessionManager->getCartContent();
  }

  // Om het toevoegen van een knop makkelijker te maken
  public function addAction($nextpage, $action, $buttonTxt, $productId = NULL, $name = NULL){
    $amount = $this->sessionManager->getAmountFromCart($productId);
    // debug_to_console('Amount: ' . $amount);
    // debug_to_console('Id: ' . $productId);
    if ($this->sessionManager->isUserLoggedIn()){
      echo "<form class='form-inline' action='index.php' method='post'>";
      echo "<div class='form-group'>";
      echo "<input type='hidden' name='action' value='$action'>";
      if(!empty($productId)){
        echo "<input type='number' name='amount' class='form-control' value='"; echo (!empty($amount)) ? $amount : '0'; echo "' min='0' style='width: 70px;'>";
        echo "<input type='hidden' name='id' value='$productId'>";
      }
      if(!empty($name)) {
        echo "<input type='hidden' name='name' value='$name'>";
      }
      echo "<input type='hidden' name='page' value='$nextpage'>";
      echo "<button class='btn btn-light'>$buttonTxt</button>";
      echo "</div>";
      echo "</form>";
    }
  }

  // Voor het afhandelen van de acties van de knoppen van hierboven ^^
  public function handleActions(){
    $action = Util::getPostVar("action");
    switch($action) {
      case "updateCart":
        $productId = Util::getPostVar("id");
        $amount = Util::getPostVar("amount");
        if($amount == 0){
          $this->sessionManager->removeFromCart($productId);
        } else if($amount > 0){
          $this->sessionManager->updateCart($productId, $amount);
        }
        break;
      case "order":
        $user_id = $this->sessionManager->getCurrentUser("id");
        $cartContent = $this->sessionManager->getCartContent();
        if($cartContent){
          $this->saveOrder($user_id, $cartContent);
        }
        break;
      case 'upload':

        break;
    }
  }

  private function saveOrder($userId, $cartContent){
    require_once "repository.php";
    try{
      insertOrder($userId, $cartContent);
      $this->sessionManager->emptyCart();
    } catch(Exception $e){
      $this->errors['generic'] = "Processing order went wrong..";
    }
    
  }

  // ============================================ Product Upload ==================================================
  public function validateProduct(){
    if($this->isPost){
      $this->validateField('name', 'isEmpty');
      $this->validateField('price', 'priceValid');
      $this->validateField('message', 'isEmpty');
      $this->validateImage();
      if(empty($this->errors)){
        $this->valid = true;
        // $target_dir = "C:/xampp/htdocs/educom-webshop-oop/Images/";
        // $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // $this->uploadImage($target_file);
        Util::logDebug("Naam: " . $this->values['name']);
        Util::logDebug("Beschrijving: " . $this->values['message']);
        Util::logDebug("Prijs: " . $this->values['price']);
        Util::logDebug("Filenaam: " . $_FILES["image"]["name"]);
        // $this->storeProduct($this->values['name'], $this->values['message'], $this->values['price'], $_FILES["image"]["name"]);
      }
    }
  }

  private function validateField($value, $check){
    // $checkFields = explode(":", $check);
  
    $this->values[$value] = Util::getPostVar($value);
  
    if(empty($this->values[$value])){
      $this->errors[$value] = ucfirst($value) . " is required";
    } else {
      switch($check){
        case 'priceValid':
          if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/', $this->values[$value])){
            $this->errors[$value] = "Not a valid Price";
          }
          break;
        default:

      }
    }
  }

  private function validateImage(){
    $target_dir = "C:/xampp/htdocs/educom-webshop-oop/Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_FILES["name"])) {
      // $this->values['image'] = $_FILES['tmp_name'];
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        $this->errors['image'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $this->errors['image'] = "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $this->errors['image'] = "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      $this->errors['image'] = "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $this->errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      // $this->valid = true;
      // if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      //   echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      // } else {
      //   echo "Sorry, there was an error uploading your file.";
      // }
    }
  }

  public function uploadImage($target_file){

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
      Util::logDebug("There was an error uploading your file.");
    }
  }

  public function storeProduct($name, $description, $price, $filename){
    require_once "repository.php";
    insertProduct($name, $description, $price, $filename);
  }
}

?>