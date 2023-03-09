<?php
function databaseConnection(){
  $servername = "localhost";
  $username = "webshop_user";
  $password = "lrV5Y*ABOoXF)N*a";
  $dbname = "webshop_daan";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    // die("Connection failed: " . mysqli_connect_error());
    throw new Exception(mysqli_connect_error());
  }
  return $conn;
}


// Create database
// $sql = "CREATE DATABASE webshop_daan";
// if (mysqli_query($conn, $sql)) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . mysqli_error($conn);
// }

// mysqli_close($conn);
?>