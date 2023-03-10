<?php
require_once "basic_doc.php";

class AboutDoc extends BasicDoc{

  protected function showContent(){
    echo '<h1>Daan Braas</h1>';
		echo '<p>Mijn naam is Daan Braas. Ik ben 30 jaar en woon in Hillegom. </p>';
		echo '<p>Mijn hobbies zijn:</p>';
		echo '<ul>';
		echo '<li>Gamen</li>';
		echo '<li>Bordspellen</li>';
		echo '<li>Kaartspellen</li>';
		echo '<li>Tricking</li>';
		echo '<ul>'; 
  }
}


?>