<?php
require_once "product_doc.php";

class DetailDoc extends ProductDoc{

  protected function showContent()
  {
    echo '<div class="product_detail">';
    echo '<div class="product_image">';
    echo '<img src="../Images/'.getArrayVar($this->data['product'], 'filename').'" style="width:80%;height:100%">';
    echo '</div>';
    echo '<div class="product_title">';
    echo getArrayVar($this->data['product'], 'name');
    echo '</div>';
    echo '<div class="product_price">';
    echo '&#8364; '.getArrayVar($this->data['product'], 'price');
    echo '</div>';
    echo '<div class="">';
    echo '<div class="product_description">';
    echo '<p>'.getArrayVar($this->data['product'], 'description').'</p>';
        
    echo '</div>';
    if(isUserLoggedIn()){    
      addAction('detail', 'updateCart', 'Update cart', getArrayVar($this->data['product'], 'id'), getArrayVar($this->data['product'], 'name'));
    }
    echo '</div>';
  }
}

?>