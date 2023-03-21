<?php
require_once "basic_doc.php";

abstract class ProductDoc extends BasicDoc{

  // Om het toevoegen van een knop makkelijker te maken
  public function addAction($nextpage, $action, $buttonTxt, $productId = NULL, $name = NULL){
    $amount = $this->model->getAmountById($productId);
    if ($this->model->hasAuthorisation()){
      echo "<form class='form-inline' action='index.php' method='post'>";
      echo "<div class='form-group'>";
      echo "<input type='hidden' name='action' value='$action'>";
      if(!empty($productId)){
        echo "<input type='number' name='amount' class='form-control' value='"; echo (!empty($amount)) ? $amount : '0'; echo "' min='0' style='width: 70px;'>";
        echo "<input type='hidden' name='id' value='$productId'>";
      }
      if(!empty($name)) {
        echo "<input type='hidden' name='name' value='$name'>";
      }
      echo "<input type='hidden' name='page' value='$nextpage'>";
      echo "<button class='btn btn-light'>$buttonTxt</button>";
      echo "</div>";
      echo "</form>";
    }
  }
}

?>