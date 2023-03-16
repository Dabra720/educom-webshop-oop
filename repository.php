<?php
require 'connectDB.php';

function findUserByEmail($email){
  $conn = databaseConnection();
  $email = mysqli_real_escape_string($conn, $email);
  try{
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      throw new Exception("Find failed, sql: " . $sql . ", error: " . mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)){
        if($row['email']==$email){
          return $row;
        }
      }
    }
    return NULL;
  } finally {
    mysqli_close($conn);
  }
}

function findUserById($id){
  $conn = databaseConnection();
  $id = mysqli_real_escape_string($conn, $id);
  // debug_to_console("email: " . $email);
  try{
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      throw new Exception("Find failed, sql: " . $sql . ", error: " . mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)){
        if($row['id']==$id){
          return $row;
        }
      }
    }
    return NULL;
  } finally {
    mysqli_close($conn);
  }
}

function insertUser($email, $name, $password){
  $conn = databaseConnection();
  $name = mysqli_real_escape_string($conn, $name);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $sql = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$password')";

  mysqli_query($conn, $sql);

  mysqli_close($conn);

}

function setUser($key, $value, $id){
  $conn = databaseConnection();
  
  try{
    $sql = "UPDATE users SET $key='$value' WHERE id='$id'";
    mysqli_query($conn, $sql);
  } finally {
    mysqli_close($conn);
  }
}

function getAdminStatus($id){
  $user = findUserById($id);
  return $user['admin'];
}
// ================================== PRODUCTS =======================================

function selectProducts(){
  // $data = array('validForm'=>false, 'values'=>array(), 'errors'=>array(), 'products'=>array(), 'cart'=>array());
  $conn = databaseConnection();
  $sql = "SELECT * FROM products";

  $products = mysqli_query($conn, $sql);

  mysqli_close($conn);
  return $products;
}

function findProductById($id){
  $conn = databaseConnection();
  $id = mysqli_real_escape_string($conn, $id);
  try{
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      throw new Exception("Find product failed, sql: " . $sql . ", error: " . mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)){
        if($row['id']==$id){
          return $row;
        }
      }
    }
    return NULL;
  } finally {
    mysqli_close($conn);
  }
}

function insertOrder($user_id, $cartContent){
  $conn = databaseConnection();

  try{
    mysqli_autocommit($conn, FALSE); //Eerst alle query's klaar zetten voor dat ze commit worden

    $sql1 = "INSERT INTO invoice (date, user_id) VALUE(CURRENT_DATE(),'$user_id')";
    $result = mysqli_query($conn, $sql1);
    if(!$result){
      throw new Exception("storeOrder failed, sql: " . $sql1 . ", error: " . mysqli_error($conn));
    }

    $last_id = mysqli_insert_id($conn);
    foreach($cartContent as $key=>$value){
      mysqli_real_escape_string($conn, $key);
      mysqli_real_escape_string($conn, $value);
      $sql2 = "INSERT INTO invoice_row(invoice_id, product_id, quantity) VALUES($last_id, $key, $value)";
      mysqli_query($conn, $sql2);
    }

    mysqli_commit($conn); // Nu alle query's verwerken, rollback als er 1 niet goed gaat.

  } catch(Exception $ex){
    Util::logDebug("storeOrder failed: " . $ex->getMessage());
  }
  finally{
    mysqli_close($conn);
  }
}

function getTopFive(){
  $conn = databaseConnection();

  $sql = "SELECT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
  FROM products p
  LEFT JOIN invoice_row ir ON p.id=ir.product_id
  LEFT JOIN invoice i ON ir.invoice_id=i.id
  AND DATEDIFF(CURRENT_DATE(), i.date) < 7
  GROUP BY p.id
  ORDER BY quantity DESC
  LIMIT 5";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
  
}

function insertProduct($name, $description, $price, $file_name){
  $conn = databaseConnection();
  $values = array($name, $description, $price, $file_name);
  foreach($values as $value){
    $value = mysqli_real_escape_string($conn, $value);
  }

  $sql = "INSERT INTO products(name, description, price, filename) VALUES('$name', '$description', $price, '$file_name')";

  mysqli_query($conn, $sql);
  mysqli_close($conn);
  
}


?>