<?php
require_once "product_doc.php";

class TopFiveDoc extends ProductDoc{

  private function showRow($product){
    echo '<tr>';
    echo '<td>';
    echo '<a href="index.php?page=detail&id='. $product->getId() .'" class="cart_link">';
    echo '<img src="../educom-webshop-oop/Images/'.$product->getFilename().'" class="rounded-circle" style="height:50px; width:auto;">';
    echo '</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $product->getId() .'" class="cart_link">'. $product->getName() .'</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $product->getId() .'" class="cart_link">'. $product->quantity .'</a></td>';
    echo '<td><a href="index.php?page=detail&id='. $product->getId() .'" class="cart_link">&#8364; '. number_format($product->getPrice(), 2, ',', '.') .'</a></td>';
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
    foreach($this->model->products as $product){
      // debug_to_console("key: " . $key);
      // debug_to_console("value: " . $value['id']);
      $this->showRow($product);
    }
    echo '</tbody>';
    echo '</table>';
  }
  
  
}

?>