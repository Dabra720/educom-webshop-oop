<?php
require_once "product_doc.php";

class WebshopDoc extends ProductDoc{
  
  private function showProduct($product){
    echo "<div class='col mb-4'>";
    echo "<div class='card bg-primary'>";
    echo "<a href='index.php?page=detail&id=".$product->getId()."' style='color:black; text-decoration:none;'>";
    echo "<div class='card-header'>";
    echo "<h3>".$product->getName()."</h3>";
    echo "</div>"; // card-header
    echo "<div class='card-body'>";
    echo "<img src='../educom-webshop-oop/Images/".$product->getFilename()."' alt='".$product->getName()."' class='img-fluid'>";
    echo "</div>"; // card-body
    echo "</a>";
    echo "<div class='card-footer'>";
    if($this->model->hasAuthorisation()){
    echo '<div class="rating" data-id='.$product->getId().'>
    <span class="star" id='.$product->getId().' data-index=1>*</span>
    <span class="star" id='.$product->getId().' data-index=2>*</span>
    <span class="star" id='.$product->getId().' data-index=3>*</span>
    <span class="star" id='.$product->getId().' data-index=4>*</span>
    <span class="star" id='.$product->getId().' data-index=5>*</span>
    </div>';
    }
    echo "<div class='float-left'>";
    echo "<h3>&#8364; ".number_format($product->getPrice(),2,',','.')."</h3>"; 
    echo "</div>"; // float-left
    echo "<div class='float-right'>";
    if($this->model->hasAuthorisation()){
      $this->addAction('webshop', 'updateCart', 'Update Cart', $product->getId(), $product->getName());
    }
    echo "</div>"; // float-right
    echo "</div>"; // card-footer
    echo "</div>"; // card bg-primary
    echo "</div>"; // col mb-4
  }

  protected function showContent()
  {
    echo '<div class="row">';
    echo '<div class="col">';
    echo '<h1>Producten</h1>';
    echo '</div>';
    echo '<div class="col">';
    if($this->model->isAdmin()){
      echo '<a href="index.php?page=upload" class="submit float-right"><button class="btn btn-primary">Voeg product toe</button></a>'; 
    }
    echo '</div>';
    echo '</div>';
    

    echo "<div class='row row-cols-1 row-cols-md-2 card-deck'>";
    foreach($this->model->products as $product){
      $this->showProduct($product);
    }
    echo "</div>";
  }

  
}

?>