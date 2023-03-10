<?php
require_once "forms_doc.php";

class RegisterDoc extends FormsDoc{
  protected $data;

  public function __construct($myData)
  {
    $this->data = $myData;
  }
  private function showForm(){
    $this->showFormStart(TRUE);
	  $this->showFormField('name', 'Naam', 'text', $this->data);
    $this->showFormField('email', 'E-Mail', 'email', $this->data);
    $this->showFormField('password', 'Wachtwoord', 'password', $this->data);
    $this->showFormField('pass_rep', 'Herhaal wachtwoord', 'password', $this->data);
    $this->showFormEnd('register');
  }

  protected function showContent()
  {
    echo '<h1>Registreer nu je account</h1>';
    echo '<h2>Voer je gegevens in:</h2>';
    $this->showForm();
  }
}

?>