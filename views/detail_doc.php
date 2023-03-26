<?php
require_once "product_doc.php";

class DetailDoc extends ProductDoc{

  protected function showContent()
  {
    Util::logDebug("Webshop Created.");
    echo '<div class="rating" data-id='.$this->model->product->getId().'>
    <span class="star" id='.$this->model->product->getId().' data-index=1>*</span>
    <span class="star" id='.$this->model->product->getId().' data-index=2>*</span>
    <span class="star" id='.$this->model->product->getId().' data-index=3>*</span>
    <span class="star" id='.$this->model->product->getId().' data-index=4>*</span>
    <span class="star" id='.$this->model->product->getId().' data-index=5>*</span>
    </div>';
    echo '<div class="product_detail">';
    echo '<div class="product_image">';
    echo '<img src="../educom-webshop-oop/Images/'.$this->model->product->getFilename().'" style="width:48%;height:60%;margin:auto;display:box;">';
    echo '</div>'; // product_image
    echo '<div class="product_title">';
    echo $this->model->product->getName();
    echo '</div>'; // product_title
    echo '<div class="product_price">';
    echo '&#8364; '.$this->model->product->getPrice();
    echo '</div>'; // product_price
    echo '<div class="product_description">';
    echo '<p>'.$this->model->product->getDescription().'</p>';
    echo '</div>'; // product_description
    echo '<div class="row">';
    if($this->model->hasAuthorisation()){    
      echo '<div class="col">';
      $this->addAction('detail', 'updateCart', 'Update cart', $this->model->product->getId(), $this->model->product->getName());
      echo '</div>';
    }
    if($this->model->isAdmin()){
      echo '<div class="col">';
      echo '<a href="index.php?page=delete&id='.$this->model->product->getId().'" class="submit float-right"><button class="btn btn-danger">Verwijder product</button></a>';
      echo '</div>';
    }
    echo '</div>'; // row
    echo '</div>'; // product_detail
  }
}

?>