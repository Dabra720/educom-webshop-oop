<?php
require_once "product_doc.php";

class DetailDoc extends ProductDoc{

  protected function showContent()
  {
    echo '<div class="product_detail">';
    echo '<div class="product_image">';
    echo '<img src="../educom-webshop-oop/Images/'.Util::getArrayVar($this->model->product, 'filename').'" style="width:80%;height:100%">';
    echo '</div>';
    echo '<div class="product_title">';
    echo Util::getArrayVar($this->model->product, 'name');
    echo '</div>';
    echo '<div class="product_price">';
    echo '&#8364; '.Util::getArrayVar($this->model->product, 'price');
    echo '</div>';
    echo '<div class="">';
    echo '<div class="product_description">';
    echo '<p>'.Util::getArrayVar($this->model->product, 'description').'</p>';
        
    echo '</div>';
    if($this->model->hasAuthorisation()){    
      $this->model->addAction('detail', 'updateCart', 'Update cart', Util::getArrayVar($this->model->product, 'id'), Util::getArrayVar($this->model->product, 'name'));
    }
    echo '</div>';
  }
}

?>