<?php
require_once "basic_doc.php";

class ProfileDoc extends BasicDoc{

  protected function showContent(){
    echo '<h1>Profiel '. $this->data['values']['name'] .'</h1>';
    echo '<table>';
    echo '<tr>';
    echo '<td>Userid: </td>';
    echo '<td>'. $this->data['values']['id'] .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Naam: </td>';
    echo '<td>'. $this->data['values']['name'] .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Email: </td>';
    echo '<td>'. $this->data['values']['email'] .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Password: </td>';
    echo '<td>'. $this->data['values']['password'] .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="index.php?page=change" class="submit"><button class="btn btn-secondary">Wijzig wachtwoord</button></a></td>';
    echo '<td><input type="hidden" name="page" value="change"></td>';
    echo '</tr>';
    echo '</table>';
  
  }
}