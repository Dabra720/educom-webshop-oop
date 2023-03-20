<?php
require_once "product_doc.php";

class CartDoc extends ProductDoc{
  
  protected function showContent()
  {
    $total = 0;
    // $cartContent = getCartContent();

    echo "<h1>Winkelwagen</h1>";
    echo "<div class='row'>";
    echo "<div class='col'></div>";
    echo "<div class='col'><p class='font-weight-bold'>Naam</p></div>";
    echo "<div class='col'><p class='font-weight-bold'>Aantal</p></div>";
    echo "<div class='col'><p class='font-weight-bold'>Prijs</p></div>";
    echo "<div class='col'><p class='font-weight-bold'>Wijzig</p></div>";
    echo "</div>";
    foreach($this->model->products as $product){
      $price = $product->getPrice() * $product->quantity; // Totaal per product
      $total += $price; // Totaal van alles
      
      echo "<div class='row border'>";
      
      echo "<div class='col'>";
      echo "<a href='index.php?page=detail&id=".$product->getId()."' class='stretched-link'>";
      echo "<img src='Images/".$product->getFilename()."' class='rounded-circle' style='height:50px;width:50px;'>";
      echo "</a>";
      echo "</div>";
      echo "<div class='col'>";
      echo "<a href='index.php?page=detail&id=".$product->getId()."' class='stretched-link text-decoration-none'>";
      echo $product->getName()."</div>";
      echo "</a>";
      echo "<div class='col'>
      <a href='index.php?page=detail&id=".$product->getId()."' class='stretched-link text-decoration-none'>";
      echo $product->quantity."</a></div>";
      echo "<div class='col'>";
      echo "<a href='index.php?page=detail&id=".$product->getId()."' class='stretched-link text-decoration-none'>&#8364; ".number_format($product->getPrice(),2,',','.')."</a></div>";
      echo "<div class='col'>"; 
      $this->model->addAction('cart', 'updateCart', 'Wijzig', $product->getId()); 
      echo "</div>";
      echo "</div>";
      
    }
    echo "<div class='row'>";
    echo "<div class='col'></div>";
    echo "<div class='col'></div>";
    echo "<div class='col'></div>";
    echo "<div class='col'>";
    echo "<p class='font-weight-bold'>Totaal</p>";
    echo "<p>&#8364; ".number_format($total,2,',','.')."</p>";
    echo "</div>";
    echo "<div class='col pt-4'>";
    $this->model->addAction('home', 'order', 'Afrekenen');
    echo "</div>";
    echo "</div>";
  }
}

?>