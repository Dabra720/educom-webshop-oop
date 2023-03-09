<?php
require 'forms.php';
function showLoginContent($data){
  echo '<h1>LOGIN</h1>';
  echo '<h2>Vul je gegevens in</h2>';
  showLoginForm($data);
}

function showLoginForm($data){
	showFormStart(true);
	showFormField('email', 'E-Mail', 'email', $data);
	showFormField('password', 'Wachtwoord', 'password', $data);
	showFormEnd('login');
}
?>