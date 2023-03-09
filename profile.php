<?php
require 'forms.php';
// var_dump($data);

function showProfileContent($data){
  echo '
  <h1>Profiel '. $data['values']['name'] .'</h1>
  <table>
    <tr>
      <td>Userid: </td>
      <td>'. $data['values']['id'] .'</td>
    </tr>
    <tr>
      <td>Naam: </td>
      <td>'. $data['values']['name'] .'</td>
    </tr>
    <tr>
      <td>Email: </td>
      <td>'. $data['values']['email'] .'</td>
    </tr>
    <tr>
      <td>Password: </td>
      <td>'. $data['values']['password'] .'</td>
      
    </tr>
    <tr>
      <td><a href="index.php?page=change" class="submit"><button class="btn btn-secondary">Wijzig wachtwoord</button></a></td>
      <td><input type="hidden" name="page" value="change"></td>
    </tr>
  </table>
  ';
}

function showChangePasswordForm($data){
  echo '<h1>Wachtwoord wijzigen</h1>';
  showFormStart(true);
  showFormField('old_pass', 'Huidige wachtwoord', 'password', $data);
  showFormField('new_pass', 'Nieuwe wachtwoord', 'password', $data);
  showFormField('new_pass_rep', 'Herhaal wachtwoord', 'password', $data);
  showFormEnd('change');
}

?>