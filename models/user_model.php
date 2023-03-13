<?php
require_once "page_model.php";

class UserModel extends PageModel{
  public $values = array();
  public $errors = array();
  public $salutations = array("None"=>"-", "Dhr"=>"Dhr", "Mvr"=>"Mvr");
  public $comm_prefs = array("email"=>"E-Mail", "phone"=>"Telefoon");
  public $valid = false;

  public function __construct($pageModel)
  {
    PARENT::__construct($pageModel);
  }
  
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
    $user = findUserByEmail($this->values['email']);
  }

  public function doLoginUser(){
    $this->sessionManager->doLoginUser($this->values);

  }
  public function doLogoutUser(){
    $this->sessionManager->doLogoutUser();
  }

  // Valideer alle gegevens in het Contactform

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

  // Validate per veld, gebruikt in alle validate functies.
  private function validateField($value, $check){
    $checkFields = explode(":", $check);
  
    $this->values[$value] = Util::getPostVar($value);
  
    if(empty(Util::getPostVar($value))){
      $this->errors[$value] = ucfirst($value) . " is required";
    } else {
      switch($checkFields[0]){
        case 'aanhefValid':
          if(Util::getPostVar($value)!="None"){
            if(!in_array(Util::getPostVar($value), $this->salutations)){
            $this->errors[$value] = "Not an option";
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
          if(!preg_match('/^[0-9]{10}+$/', Util::getPostVar('phone'))){
            $this->errors[$value] = "Not a valid Phone number";
          }
          break;
        case 'prefValid':
          if(!in_array(Util::getPostVar($value), $this->comm_prefs)){
            $this->errors[$value] = "Not an option";
          }
          break;
        case 'pass_rep':
          if(strcmp(Util::getPostVar($value), $this->values[$checkFields[1]])){
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