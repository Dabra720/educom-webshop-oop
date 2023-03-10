<?php
require_once "forms_doc.php";

class ChangePasswordDoc extends FormsDoc{

  private function showForm(){
    $this->showFormStart(true);
    $this->showFormField('old_pass', 'Huidige wachtwoord', 'password', $this->data);
    $this->showFormField('new_pass', 'Nieuwe wachtwoord', 'password', $this->data);
    $this->showFormField('new_pass_rep', 'Herhaal wachtwoord', 'password', $this->data);
    $this->showFormEnd('change');
  }
  protected function showContent(){
    echo '<h1>Wachtwoord wijzigen</h1>';
    $this->showForm();
  }
}
?>