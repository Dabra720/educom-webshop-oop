<?php
// var_dump($data['products']);
function showWebshopContent($data){
  echo '<h1>Producten</h1>';
  // echo "<div class='card-group'>";
  echo "<div class='row row-cols-1 row-cols-md-2'>";
  foreach($data['products'] as $key => $value){
    // debug_to_console("key: " . $key);
    // debug_to_console("value: " . $value['id']);
    showProduct($key, $value);
  }
  echo "</div>";
  // echo "</div>";
}

function showProduct($key, $value){
  // echo "<div class='row row-cols-1 row-cols-sm-2'>";
  echo "<div class='col mb-4'>";

  echo "<div class='card bg-primary'>";

  echo "<a href='index.php?page=detail&id=".$value['id']."' style='color:black; text-decoration:none;'>";
  
  echo "<div class='card-header'>";
  echo "<h3>".$value['name']."</h3>";
  echo "</div>"; // card-header

  echo "<div class='card-body'>";
  echo "<img src='Images/".$value['filename']."' alt='".$value['name']."' class='img-fluid'>";
  echo "</div>"; // card-body

  echo "</a>";

  echo "<div class='card-footer'>";
  echo "<div class='float-left'>";
  echo "<h3>&#8364; ".$value['price']."</h3>";
  echo "</div>"; // float-left
  
  echo "<div class='float-right'>";
  if(isUserLoggedIn()){
    addAction('webshop', 'updateCart', 'Update Cart', $value['id'], $value['name']);
  }
  echo "</div>"; // float-right
  echo "</div>"; // card-footer
  
  echo "</div>"; // card bg-primary

  echo "</div>"; // col mb-4
}

?>