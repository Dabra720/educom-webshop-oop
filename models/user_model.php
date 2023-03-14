<?php
require_once "page_model.php";

class UserModel extends PageModel{
  public $values = array();
  public $errors = array();
  public $salutations = array("-"=>"invalid", "Dhr"=>"Dhr", "Mvr"=>"Mvr", "Geen aanhef"=>"none");
  public $comm_prefs = array("email"=>"E-Mail", "phone"=>"Telefoon");
  public $valid = false;

  public function __construct($pageModel)
  {
    PARENT::__construct($pageModel);
  }
  // =================================================== PASSWORD CHANGE ========================================================
  public function validatePasswordChange(){

    $old_pass = Util::getPostVar('old_pass');
    $new_pass = Util::getPostVar('new_pass');
    $pass_rep = Util::getPostVar('new_pass_rep');

    $user = $this->getUserBy('id', $this->sessionManager->getCurrentUser('id'));
    if($user){
      // debug_to_console("ValidateProfile: " . $user['name']);
      $this->values['old_pass'] = $old_pass;
      $this->values['new_pass'] = $new_pass;
      $this->values['new_pass_rep'] = $pass_rep;
      $this->values['id'] = $user['id'];
      $this->values['name'] = $user['name'];
      $this->values['email'] = $user['email'];
      $this->values['password'] = $user['password'];
    }

    if($this->isPost){
      $this->validateField('old_pass', 'isEmpty');
      if($old_pass == $user['password']){
        $this->validateField('new_pass_rep', 'pass_rep:new_pass');
      } else {
        $this->errors['old_pass'] = "Password is incorrect";
      }
      if(empty($this->errors)){
        $this->valid = true;
        $this->values['password'] = $new_pass;
      }
    }
  }

  public function getUserBy($search, $value){
    require_once "repository.php";
    switch($search){
      case 'email':
        $user = findUserByEmail($value);
        return $user;
      case 'id':
        $user = findUserById($value);
        return $user;
    }
    return NULL;
  }

  public function updateUser($key, $value){
    require_once "repository.php";
    setUser($key, $value, $this->sessionManager->getCurrentUser('id'));
  }

  // ====================================================== REGISTER ============================================================
  public function validateRegister(){
    if($this->isPost){
      $this->validateField('email', 'emailValid');
      $this->validateField('name', 'nameValid');
      $this->validateField('password', 'isEmpty');
      $this->validateField('pass_rep', 'pass_rep:password');

      try{
        if(!empty($this->values['email'])){
          if($this->doesEmailExist($this->values['email'])){
            $this->errors['email'] = "Already exists";
          } else{
            if(empty($data['errors'])){
              $this->valid = true;
            }
          }
        }
      } catch (Exception $ex){
        $this->errors['generic'] = "Er is een technische storing, probeer het later nogmaals.";
        Util::logDebug("Register failed: " . $ex->getMessage());
      }
    }
    // return $data;
  }

  private function doesEmailExist($email){
    require_once "repository.php";
    if(!is_null(findUserByEmail($email))){
      return true;
    } else {return false;}
  }

  public function storeUser($email, $name, $password){
    require_once "repository.php";
    saveUser($email, $name, $password);
  }

  // ====================================================== LOGIN ============================================================ 
  public function validateLogin(){
    if($this->isPost){
      try{
        $user = $this->authenticateUser();
        if(is_null($user)){
          $this->errors['email'] = "Email and/or password is wrong";
          $this->errors['password'] = "Email and/or password is wrong";
        } else{
          $this->valid = true;
          $this->values['id'] = $user['id'];
          $this->values['name'] = $user['name'];
        }
      } catch(Exception $ex){
        $this->errors['generic'] = "Er is een technische storing, probeer het later nogmaals.";
        Util::logDebug("Authentication failed: " . $ex->getMessage());
      }
    }
  }

  private function authenticateUser(){
    require_once "repository.php";
    $user = findUserByEmail(Util::getPostVar('email'));
    if(!empty($user)){
      if($user['password']==Util::getPostVar('password')){
        return $user;
      }
    }
    return NULL;
  }

  public function doLoginUser(){
    $this->sessionManager->doLoginUser($this->values);

  }
  public function doLogoutUser(){
    $this->sessionManager->doLogoutUser();
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
        $this->valid = true;
      }
    }
  }

  // ====================================================== FIELDS ============================================================
  private function validateField($value, $check){
    $checkFields = explode(":", $check);
  
    $this->values[$value] = Util::getPostVar($value);
  
    if(empty($this->values[$value])){
      $this->errors[$value] = ucfirst($value) . " is required";
    } else {
      switch($checkFields[0]){
        case 'aanhefValid':
          // Util::logDebug("aanhef: " . $this->values[$value]);
          if($this->values[$value]!="invalid"){
            // Util::logDebug($this->salutations);
            if(!in_array($this->values[$value], $this->salutations)){
              $this->errors[$value] = "Not an option";
            }else{
              $this->values[$value] = "";
            }
          }else{
            $this->errors[$value] = "Pick an option";
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