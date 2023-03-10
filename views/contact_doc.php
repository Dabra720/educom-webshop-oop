<?php
require_once "forms_doc.php";

class ContactDoc extends FormsDoc{
  protected $data;

  public function __construct($myData)
  {
    $this->data = $myData;
  }
  private function showForm(){
    $this->showFormStart(true);
    $this->showFormField('aanhef', 'Aanhef', 'select', $this->data, true, SALUTATIONS);
    $this->showFormField('name', 'Naam', 'text', $this->data);
    $this->showFormField('email', 'E-Mail', 'email', $this->data);
    $this->showFormField('phone', 'Telefoon', 'text', $this->data);
    $this->showFormField('voorkeur', 'Communicatievoorkeur', 'radio', $this->data, true, COMM_PREFS);
    $this->showFormField('message', 'Bericht', 'textarea', $this->data);
    $this->showFormEnd('contact');
  }
  protected function showContent()
  {
    echo '<h1>Neem contact met ons op</h1>';
	  echo '<h2>Contactgegevens</h2>';
    $this->showForm();
  }
}

?>