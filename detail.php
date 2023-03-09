<?php
// var_dump($data);
function showDetailContent($data){
  echo '<div class="product_detail">
    <div class="product_image">
      <img src="Images/'.getArrayVar($data['product'], 'filename').'" style="width:80%;height:100%">
    </div>
    <div class="product_title">
      '.getArrayVar($data['product'], 'name').'
    </div>
    <div class="product_price">
      &#8364; '.getArrayVar($data['product'], 'price').'
    </div>
    <div class="">
      <div class="product_description">
        <p>'.getArrayVar($data['product'], 'description').'</p>
        
      </div>';
  if(isUserLoggedIn()){    
    addAction('detail', 'updateCart', 'Update cart', getArrayVar($data['product'], 'id'), getArrayVar($data['product'], 'name'));
  }
  echo '</div>';
}


?>