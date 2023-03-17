<?php
// session_start();
// require_once "controllers/page_controller.php";
require_once "../crud.php";
require_once "../user.php";
require_once "../userCrud.php";

$crud = new Crud();
// $modelFactory = new ModelFactory($crud);
// $controller = new PageController();
$userCrud = new UserCrud($crud);

// ======================================= || DELETE ROW || ==========================================
// $allUsers = $userCrud->readAllUsers();

// foreach($allUsers as $user){
//   echo "ID: " . $user->id . "<br>";
//   echo "NAME: " . $user->name . "<br>";
//   echo "EMAIL: " . $user->email . "<br>";
//   echo "ADMIN: " . $user->admin . "<br>";
//   echo "--------------------------------<br>";
// }
// echo "<br>====================================================================<br>";
// $userCrud->deleteUser(10);
$i = 20;
while($i>10){
  $userCrud->deleteUser($i);
  $i -= 1;
}

$allUsers = $userCrud->readAllUsers();

foreach($allUsers as $user){
  echo "ID: " . $user->id . "<br>";
  echo "NAME: " . $user->name . "<br>";
  echo "EMAIL: " . $user->email . "<br>";
  echo "ADMIN: " . $user->admin . "<br>";
  echo "--------------------------------<br>";
}




// ======================================= || UPDATE ROW || ==========================================

// $user = $userCrud->readUserById(1);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br><br>";

// $user2 = new User($user->name, $user->email, $user->password, $user->admin, $user->id);
// $user2->setName('Daan');
// $user2->setEmail('dbraas@gmail.com');
// // var_dump(get_object_vars($newUser));
// echo "ID: " . $user2->getId() . "<br>";
// echo "NAME: " . $user2->getName() . "<br>";
// echo "EMAIL: " . $user2->getEmail() . "<br>";
// echo "ADMIN: " . $user2->getAdmin() . "<br><br>";
// $userCrud->updateUser($user2);

// $user = $userCrud->readUserById(1);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br>";

// ======================================= || READ ALL ROWS || ==========================================
// $allUsers = $userCrud->readAllUsers();

// foreach($allUsers as $user){
//   echo "ID: " . $user->id . "<br>";
//   echo "NAME: " . $user->name . "<br>";
//   echo "EMAIL: " . $user->email . "<br>";
//   echo "ADMIN: " . $user->admin . "<br>";
// }


// ======================================= || READ ROW || ==========================================;
// $user = $userCrud->readUserById(7);
// $newUser = new User($user->name, $user->email, $user->password);
// echo "User ID: " . $user->id;
// echo "User ID: " . $user->name;
// echo "User ID: " . $user->password;
// echo "User ID: " . $user->id;
// var_dump(get_object_vars($newUser));




// ======================================= || CREATE ROW || ==========================================
// $user = new User('Daan3', 'daan@mail.nl', 'test', TRUE);
// $user->setId($userCrud->createUser($user));
// echo "User Number: " . $user->getId() . " has been created.<br>";
// echo "Its name is: " . $user->getName() . "<br>";

// $user = $userCrud->readUserById($user->getId());
// $newUser = new User($user->name, $user->email, $user->password);

// echo "ID: " . $user->id . "<br>";
// echo "NAME: " . $user->name . "<br>";
// echo "EMAIL: " . $user->email . "<br>";
// echo "PASSWORD: " . $user->password . "<br>";
// echo "ADMIN: " . $user->admin . "<br><br>";
?>