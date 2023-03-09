<?php 
require 'forms.php';
function showRegisterContent($data){
  echo '<h1>Registreer nu je account</h1>
  <h2>Voer je gegevens in:</h2>';
  showRegisterForm($data);
}

function showRegisterForm($data){
	showFormStart(TRUE);
	showFormField('name', 'Naam', 'text', $data);
	showFormField('email', 'E-Mail', 'email', $data);
	showFormField('password', 'Wachtwoord', 'password', $data);
	showFormField('pass_rep', 'Herhaal wachtwoord', 'password', $data);
	showFormEnd('register');
	
}



?>