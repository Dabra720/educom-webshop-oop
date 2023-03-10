<?php
require_once "basic_doc.php";

class ContactThanksDoc extends BasicDoc{
  
  protected function showContent()
  {
    echo "Beste " . SALUTATIONS[getValue($this->data, 'aanhef', 'Dhr')] . " " . getValue($this->data, 'name') . ", dankjewel voor het posten!" . "<br>";
    echo "Emailadres: " . getValue($this->data, 'email') . "<br>";
    echo "Telefoonnummer: " . getValue($this->data, 'phone') . "<br>";
    echo "Communicatievoorkeur: " . getValue($this->data, 'voorkeur') . "<br>";
    echo "Bericht: " . getValue($this->data, 'message') . "<br>";
  }
}

?>