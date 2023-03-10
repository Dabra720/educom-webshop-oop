<?php
require_once "basic_doc.php";

class HomeDoc extends BasicDoc{

  protected function showContent(){
    echo '<h1>Welkom op deze site</h1>';
		echo '<p>Welkom, bezoekers van deze website.</p>'; 
  }
}


?>