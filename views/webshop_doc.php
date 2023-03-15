<?php
require_once "product_doc.php";

class WebshopDoc extends ProductDoc{
  
  private function showProduct($value){
    echo "<div class='col mb-4'>";
    echo "<div class='card bg-primary'>";
    echo "<a href='index.php?page=detail&id=".$value['id']."' style='color:black; text-decoration:none;'>";
    echo "<div class='card-header'>";
    echo "<h3>".$value['name']."</h3>";
    echo "</div>"; // card-header
    echo "<div class='card-body'>";
    echo "<img src='../educom-webshop-oop/Images/".$value['filename']."' alt='".$value['name']."' class='img-fluid'>";
    echo "</div>"; // card-body
    echo "</a>";
    echo "<div class='card-footer'>";
    echo "<div class='float-left'>";
    echo "<h3>&#8364; ".number_format($value['price'],2,',','.')."</h3>"; 
    echo "</div>"; // float-left
    echo "<div class='float-right'>";
    if($this->model->hasAuthorisation()){
      $this->model->addAction('webshop', 'updateCart', 'Update Cart', $value['id'], $value['name']);
    }
    echo "</div>"; // float-right
    echo "</div>"; // card-footer
    echo "</div>"; // card bg-primary
    echo "</div>"; // col mb-4
  }

  protected function showContent()
  {
    echo '<h1>Producten</h1>';
    echo "<div class='row row-cols-1 row-cols-md-2'>";
    foreach($this->model->products as $key => $value){
      $this->showProduct($value);
    }
    echo "</div>";
  }

  
}

?>