<?php
require_once "forms_doc.php";

class RegisterDoc extends FormsDoc{

  private function showForm(){
    $this->showFormStart(TRUE);
	  $this->showFormField('name', 'Naam', 'text', $this->model);
    $this->showFormField('email', 'E-Mail', 'email', $this->model);
    $this->showFormField('password', 'Wachtwoord', 'password', $this->model);
    $this->showFormField('pass_rep', 'Herhaal wachtwoord', 'password', $this->model);
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