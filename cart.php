<?php

function showCartContent2(){
  $total = 0;
  $cartContent = getCartContent();
  // var_dump($cartContent);
  echo '<h1>Winkelwagen</h1>';
  echo '<table>';
  echo '<tr>
    <th></th>
    <th>Naam</th>
    <th>Aantal</th>
    <th>Prijs</th>
    <th>Wijzig</th>
    </tr>';
  foreach($cartContent as $id=>$amount){
    $product = getProductBy('id', $id);
    $price = $product['price'] * $amount;
    $total += $price;
    echo '<tr>
      <td><a href="index.php?page=detail&id='. $id .'" class="cart_link"><img src="Images/'.$product['filename'].'" class="cart_image"></a></td>
      <td><a href="index.php?page=detail&id='. $id .'" class="cart_link">'. $product['name'] .'</a></td>
      <td style="text-align:center;"><a href="index.php?page=detail&id='. $id .'" class="cart_link">'. $amount .'</a></td>
      <td><a href="index.php?page=detail&id='. $id .'" class="cart_link">&#8364; '. number_format($price, 2, ',', '.') .'</a></td>
      <td>'; addAction('cart', 'updateCart', 'Wijzig', $id); echo '</td>
    </tr>';
  }
  echo '<tr><td></td><td></td><td></td><th>Totaal:</th></tr>';
  echo '<tr><td></td><td></td><td></td><td>&#8364; '. number_format($total, 2, ',', '.') .'</td></tr>';
  echo '<tr><td></td><td></td><td></td><td>'; addAction('home', 'order', 'Afrekenen'); echo '</td></tr>';
  echo '</table>';
}
function showCartContent(){
  $total = 0;
  $cartContent = getCartContent();

  echo "<h1>Winkelwagen</h1>";
  // showRow('Naam', 'Aantal', 'Prijs', 'Wijzig');
  echo "<div class='row'>";
  echo "<div class='col'></div>";
  echo "<div class='col'><p class='font-weight-bold'>Naam</p></div>";
  echo "<div class='col'><p class='font-weight-bold'>Aantal</p></div>";
  echo "<div class='col'><p class='font-weight-bold'>Prijs</p></div>";
  echo "<div class='col'><p class='font-weight-bold'>Wijzig</p></div>";
  echo "</div>";
  foreach($cartContent as $id=>$amount){
    $product = getProductBy('id', $id);
    $price = $product['price'] * $amount;
    $total += $price;
    
    echo "<div class='row border'>";
    
    echo "<div class='col'>";
    echo "<a href='index.php?page=detail&id=$id' class='stretched-link'>";
    echo "<img src='Images/".$product['filename']."' class='rounded-circle' style='height:50px;width:50px;'>";
    echo "</a>";
    echo "</div>";
    echo "<div class='col'>";
    echo "<a href='index.php?page=detail&id=$id' class='stretched-link text-decoration-none'>";
    echo $product['name']."</div>";
    echo "</a>";
    echo "<div class='col'>
    <a href='index.php?page=detail&id=$id' class='stretched-link text-decoration-none'>";
    echo $amount."</a></div>";
    echo "<div class='col'>";
    echo "<a href='index.php?page=detail&id=$id' class='stretched-link text-decoration-none'>&#8364; ".number_format($price,2,',','.')."</a></div>";
    echo "<div class='col'>"; addAction('cart', 'updateCart', 'Wijzig', $id); echo "</div>";
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
  addAction('home', 'order', 'Afrekenen');
  echo "</div>";
  echo "</div>";

}
?>