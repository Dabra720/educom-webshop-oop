<?php
require_once "page_model.php";

class UserModel extends PageModel{
  // private $crud;
  public $salutations = array("-"=>"", "Dhr"=>"Dhr", "Mvr"=>"Mvr");
  public $comm_prefs = array("email"=>"E-Mail", "phone"=>"Telefoon");
  

  public function __construct($pageModel, $userCrud)
  {
    PARENT::__construct($pageModel);
    $this->crud = $userCrud;
    if($this->sessionManager->isUserLoggedIn()){
      // Create logged in user object
      $this->user = $this->crud->readUserById($this->sessionManager->getCurrentUser('id'));
    }
  }
  
  // =================================================== PASSWORD CHANGE ========================================================
  public function validatePasswordChange(){

      if($this->isPost){
      $this->validateField('old_pass', 'isEmpty');
      $this->validateField('new_pass', 'isEmpty');
      if($this->values['old_pass'] == $this->user->getPassword()){
        $this->validateField('new_pass_rep', 'pass_rep:new_pass');
      } else {
        $this->errors['old_pass'] = "Password is incorrect";
      }
      if(empty($this->errors)){
        $this->user->setPassword($this->values['new_pass']);
        $this->crud->updateUser($this->user);
        $this->setPage('profile');
      }
    }
  }

  // ====================================================== REGISTER ============================================================
  public function validateRegister(){
    if($this->isPost){
      $this->validateField('email', 'emailValid');
      $this->validateField('name', 'nameValid');
      $this->validateField('password', 'isEmpty');
      $this->validateField('pass_rep', 'pass_rep:password');
        
        if(!empty($this->values['email'])){
            if($this->crud->readUserByEmail($this->values['email'])){
            $this->errors['email'] = "Already exists";
          } else{
            if(empty($this->errors)){
              $this->valid = true;
            }
          }
        }

      if($this->valid){
        $user = new User();
        $user->setName($this->values['name']);
        $user->setEmail($this->values['email']);
        $user->setPassword($this->values['password']);
        $this->crud->createUser($user);
        $this->setPage('login');
      }
    }
  }

  // ====================================================== LOGIN ============================================================ 
  public function validateLogin(){
    if($this->isPost){
      try{
        $this->authenticateUser();
        if(!is_object($this->user)){
          $this->errors['email'] = "Email and/or password is wrong";
          $this->errors['password'] = "Email and/or password is wrong";
        } else{
          $this->valid = true;
          $this->values['id'] = $this->user->getId();
          $this->values['name'] = $this->user->getName();
        }
      } catch(Exception $ex){
        $this->errors['generic'] = "Er is een technische storing, probeer het later nogmaals.";
        Util::logDebug("Authentication failed: " . $ex->getMessage());
      }
      if($this->valid){
        $this->doLoginUser();
        $this->setPage("home");
      }
    }
  }

  // Als er geen user gevonden wordt is $user geen object
  private function authenticateUser(){
    $user = $this->crud->readUserByEmail(Util::getPostVar('email'));
    if(is_object($user)){
      if($user->password==Util::getPostVar('password')){
        $this->user = $user;
      }
    }
    return NULL;
  }

  public function doLoginUser(){
    $this->sessionManager->doLoginUser($this->user);

  }
  public function doLogoutUser(){
    $this->sessionManager->doLogoutUser();
    $this->setPage("home");
  }

  // ====================================================== CONTACT ============================================================
  public function validateContact(){

    if($this->isPost){
      $this->validateField('aanhef', 'aanhefValid');
      $this->validateField('name', 'nameValid');
      $this->validateField('email', 'emailValid');
      $this->validateField('phone', 'phoneValid');
      $this->validateField('voorkeur', 'prefValid');
      $this->validateField('message', 'isEmpty');

      if(empty($this->errors)){
        $this->setPage('thanks');
      }
    }
  }

  // ====================================================== FIELDS ============================================================
  private function validateField($value, $check){
    $checkFields = explode(":", $check);
  
    $this->values[$value] = Util::getPostVar($value);
    Util::logDebug("Validate value: " . $this->values[$value]);
  
    if(empty($this->values[$value])){
      $this->errors[$value] = ucfirst($value) . " is required";
    } else {
      switch($checkFields[0]){
        case 'aanhefValid':
            if(!in_array($this->values[$value], $this->salutations)){
              $this->errors[$value] = "Not an option";
            }
          break;
        case 'nameValid':
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z-' ]*$/",$this->values[$value])) {
            $this->errors[$value] = "Only letters and white space allowed";
          }
          break;
        case 'emailValid':
          // check if e-mail address is well-formed
          if (!filter_var($this->values[$value], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$value] = "Invalid ". $value ." format";
          }
          break;
        case 'phoneValid':
          if(!preg_match('/^[0-9]{10}+$/', $this->values[$value])){
            $this->errors[$value] = "Not a valid Phone number";
          }
          break;
        case 'prefValid':
          if(!in_array($this->values[$value], $this->comm_prefs)){
            $this->errors[$value] = "Not an option";
          }
          break;
        case 'pass_rep':
          if(strcmp($this->values[$value], $this->values[$checkFields[1]])){
            $this->errors[$value] = "Passwords don't match";
            $this->errors[$checkFields[1]] = "Passwords don't match";
            $this->values[$value] = "";
            $this->values[$checkFields[1]] = "";
          }
          break;
      }
    }
  }
}

?>