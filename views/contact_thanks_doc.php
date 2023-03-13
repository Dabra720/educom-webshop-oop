<?php
require_once "basic_doc.php";

class ContactThanksDoc extends BasicDoc{
  
  protected function showContent()
  {

    // echo "Beste " . SALUTATIONS[getValue($this->model->values['aanhef'], 'aanhef', 'Dhr')] . " " . getValue($this->model->values['name'], 'name') . ", dankjewel voor het posten!" . "<br>";
    echo "Beste " . $this->model->values['aanhef'] . " " . $this->model->values['name'] . ", dankjewel voor het posten!" . "<br>";
    echo "Emailadres: " . $this->model->values['email'] . "<br>";
    echo "Telefoonnummer: " . $this->model->values['phone'] . "<br>";
    echo "Communicatievoorkeur: " . $this->model->values['voorkeur'] . "<br>";
    echo "Bericht: " . $this->model->values['message'] . "<br>";
  }
}

?>