<?php
require_once "basic_doc.php";

class ProfileDoc extends BasicDoc{

  protected function showContent(){
    echo '<h1>Profiel '. $this->model->user->getName() .'</h1>';
    echo '<table>';
    echo '<tr>';
    echo '<td>Userid: </td>';
    echo '<td>'. $this->model->user->getId() .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Naam: </td>';
    echo '<td>'. $this->model->user->getName() .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Email: </td>';
    echo '<td>'. $this->model->user->getEmail() .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Password: </td>';
    echo '<td>'. $this->model->user->getPassword() .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="index.php?page=change" class="submit"><button class="btn btn-secondary">Wijzig wachtwoord</button></a></td>';
    // echo '<td><input type="hidden" name="page" value="change"></td>';
    echo '</tr>';
    echo '</table>';
  
  }
}

?>