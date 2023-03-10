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

function saveUser($email, $name, $password){
  $conn = databaseConnection();
  $name = mysqli_real_escape_string($conn, $name);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $sql = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$password')";

  mysqli_query($conn, $sql);

  mysqli_close($conn);

}

function updateUser($key, $value){
  $conn = databaseConnection();
  
  try{
    $sql = "UPDATE users SET $key='$value' WHERE id='".getCurrentUser('id'). "'";
    mysqli_query($conn, $sql);
  } finally {
    mysqli_close($conn);
  }
}
// ================================== PRODUCTS =======================================

function selectProducts(){
  // $data = array('validForm'=>false, 'values'=>array(), 'errors'=>array(), 'products'=>array(), 'cart'=>array());
  $conn = databaseConnection();
  $sql = "SELECT * FROM products";

  $data['products'] = mysqli_query($conn, $sql);

  mysqli_close($conn);
  return $data;
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

function storeOrder($user_id, $cartContent){
  $conn = databaseConnection();

  try{
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

  }finally{
    mysqli_close($conn);
  }
}

function selectTopFive(){
  $conn = databaseConnection();

  $sql = "SELECT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
  FROM products p
  LEFT JOIN invoice_row ir ON p.id=ir.product_id
  LEFT JOIN invoice i ON ir.invoice_id=i.id
  AND DATEDIFF(CURRENT_DATE(), i.date) < 7
  GROUP BY p.id
  ORDER BY quantity DESC
  LIMIT 5";
  $result['top'] = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
  
}

?>