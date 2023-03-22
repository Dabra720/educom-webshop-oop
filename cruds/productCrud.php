<?php
require_once "product.php";

class ProductCrud{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = $crud;
  }

  // Returns created user's id
  public function createProduct($product){
    $sql = "INSERT INTO products(name, description, price, filename) VALUES(:name, :description, :price, :filename)";
    $params = array(':name'=>$product->getName(), ':description'=>$product->getDescription(), ':price'=>$product->getPrice(), ':filename'=>$product->getFilename());
    $productId = $this->crud->createRow($sql, $params);
    return $productId;
  }

  public function readProductById($productId){
    $sql = "SELECT * FROM products WHERE id=:id";
    $params = array(":id"=>$productId);
    $product = $this->crud->readOneRow($sql, $params, 'Product');
    return $product;
  }

  public function readAllProducts(){
    $sql = "SELECT * FROM products";
    $params = array();
    return $this->crud->readMultipleRows($sql, $params, 'Product');
  }

  // public function updateProduct($product){
  //   $sql = "UPDATE products SET name=:name, email=:email, password=:password, admin=:admin WHERE id=:id";
  //   $params = array(':name'=>$product->getName(), ':description'=>$product->getDecription(), ':price'=>$product->getPrice(), ':filename'=>$product->getFilename());

  //   $this->crud->updateRow($sql, $params);
  // }

  public function deleteProduct($productId){
    $sql = "DELETE FROM products WHERE id=:id";
    $params = array(":id"=>$productId);

    $this->crud->deleteRow($sql, $params);

    // Deze functie moet nog iets krijgen om de image uit de map te verwijderen
  }

  public function readTopFive(){
    $sql = "SELECT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
    FROM products p
    LEFT JOIN invoice_row ir ON p.id=ir.product_id
    LEFT JOIN invoice i ON ir.invoice_id=i.id
    AND DATEDIFF(CURRENT_DATE(), i.date) < 7
    GROUP BY p.id
    ORDER BY quantity DESC
    LIMIT 5";
    $params = array();

    return $this->crud->readMultipleRows($sql, $params, 'Product');
  }

  // public function readLastOrders(){
  //   $sql = "SELECT ir.invoice_id, date, product_id, ir.quantity, p.name, p.price, p.filename 
  //   FROM `invoice_row` ir
  //   LEFT JOIN invoice i ON ir.invoice_id=i.id
  //   LEFT JOIN products p ON ir.product_id=p.id
  //   WHERE";

  //   $params = array();

  //   return $this->crud->readMultipleRows($sql, $params, 'Product');
  // }

  public function createOrder($user_id, $cartContent){
    // Rollback inbouwen, -> Autocommit uit??
    $sql = "INSERT INTO invoice (date, user_id) VALUE(CURRENT_DATE(), :id)";
    $params = array(':id'=>$user_id);

    $last_id = $this->crud->createRow($sql, $params);

    foreach($cartContent as $product_id=>$quantity){
      $sql = "INSERT INTO invoice_row(invoice_id, product_id, quantity) VALUES(:last_id, :product_id, :quantity)";
      $params = array(':last_id'=>$last_id, ':product_id'=>$product_id, ':quantity'=>$quantity);
      $this->crud->createRow($sql, $params);
    }

  }


}

?>