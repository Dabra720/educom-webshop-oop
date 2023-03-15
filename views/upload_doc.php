<?php
require_once "forms_doc.php";

class UploadDoc extends FormsDoc{
  
  private function showForm(){
    $this->showFormStart(true, true);
    $this->showFormField('name', 'Naam', 'text', $this->model);
    $this->showFormField('price', 'Prijs', 'text', $this->model);
    $this->showFormField('message', 'Beschrijving', 'textarea', $this->model);
    $this->showFormField('image', 'Afbeelding', 'file', $this->model);
    $this->showFormEnd('webshop');
  }
  protected function showContent()
  {
    // var_dump($_FILES);
    // var_dump($_POST);
    // echo "value: " . $this->model->values['image'];
    echo '<h1>Upload een nieuw product</h1>';
	  echo '<h2>Productgegevens</h2>';
    $this->showForm();
  }
}

?>