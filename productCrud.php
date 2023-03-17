<?php

class ProductCrud{
  private $crud;

  public function __construct($crud)
  {
    $this->crud = $crud;
  }

  // Returns created user's id
  public function createProduct($product){
    $sql = "INSERT INTO products(name, description, price, filename) VALUES(:name, :description, :price, :filename)";
    $params = array(':name'=>$product->getName(), ':description'=>$product->getDecription(), ':price'=>$product->getPrice(), ':filename'=>$product->getFilename());
    
    $productId = $this->crud->createRow($sql, $params);
    return $productId;
  }

  public function readProductById($productId){
    $sql = "SELECT * FROM products WHERE id=:id";
    $params = array(":id"=>$productId);

    return $this->crud->readOneRow($sql, $params);
  }

  public function readAllProducts(){
    $sql = "SELECT * FROM products";
    $params = array();
    return $this->crud->readAllRows($sql, $params);
  }

  public function updateProduct($product){
    $sql = "UPDATE products SET name=:name, email=:email, password=:password, admin=:admin WHERE id=:id";
    $params = array(':name'=>$product->getName(), ':description'=>$product->getDecription(), ':price'=>$product->getPrice(), ':filename'=>$product->getFilename());

    $this->crud->updateRow($sql, $params);
  }

  public function deleteProduct($productId){
    $sql = "DELETE FROM products WHERE id=:id";
    $params = array(":id"=>$productId);

    $this->crud->deleteRow($sql, $params);
  }
}

?>