<?php
require_once "forms_doc.php";

class ContactDoc extends FormsDoc{
  
  private function showForm(){
    $this->showFormStart(true);
    $this->showFormField('aanhef', 'Aanhef', 'select', $this->model, true, $this->model->salutations);
    $this->showFormField('name', 'Naam', 'text', $this->model);
    $this->showFormField('email', 'E-Mail', 'email', $this->model);
    $this->showFormField('phone', 'Telefoon', 'text', $this->model);
    $this->showFormField('voorkeur', 'Communicatievoorkeur', 'radio', $this->model, true, $this->model->comm_prefs);
    $this->showFormField('message', 'Bericht', 'textarea', $this->model);
    $this->showFormEnd('contact');
  }
  protected function showContent()
  {
    // var_dump($this->model->errors);
    echo '<h1>Neem contact met ons op</h1>';
	  echo '<h2>Contactgegevens</h2>';
    $this->showForm();
  }
}

?>