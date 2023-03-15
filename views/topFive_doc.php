<?php
require_once "product_doc.php";

class TopFiveDoc extends ProductDoc{

  private function showTopFiveRow($value){
    echo '<tr>';
    echo '<td>';
    echo '<a href="index.php?page=detail&id='. $value['id'] .'" class="cart_link">';
    echo '<img src="../educom-webshop-oop/Images/'.$value['filename'].'" class="rounded-circle" style="height:50px; width:auto;">';
    echo '</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $value['id'] .'" class="cart_link">'. $value['name'] .'</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $value['id'] .'" class="cart_link">'. $value['quantity'] .'</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $value['id'] .'" class="cart_link">&#8364; '. number_format($value['price'], 2, ',', '.') .'</a></td>';
    echo '</tr>';
  }

  protected function showContent()
  {
    echo '<h1>Top 5 van afgelopen week</h1>';
    echo "<table class='table table-hover'>";
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>Naam:</th>';
    echo '<th>Aantal verkocht:</th>';
    echo '<th>Prijs per stuk:</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach($this->model->products as $key => $value){
      // debug_to_console("key: " . $key);
      // debug_to_console("value: " . $value['id']);
      $this->showTopFiveRow($value);
    }
    echo '</tbody>';
    echo '</table>';
  }
  
  
}

?>