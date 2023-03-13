<?php
require_once "forms_doc.php";

class LoginDoc extends FormsDoc{
  
  private function showForm(){
    $this->showFormStart(true);
    $this->showFormField('email', 'E-Mail', 'email', $this->data);
    $this->showFormField('password', 'Wachtwoord', 'password', $this->data);
    $this->showFormEnd('login');
  }
  protected function showContent()
  {
    echo '<h1>LOGIN</h1>';
    echo '<h2>Vul je gegevens in</h2>';
    $this->showForm();
  }
}

?>