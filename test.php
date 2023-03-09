<?php
// Debug tool, om variabelen makkelijk te kunnen checken
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "');</script>";
}

echo 'Inhoud van users.txt: ';
$users_file = fopen('users/users.txt', 'a+') or die("Unable to open file!");

// $user_email = "dbraas@gmail.com";
// $user_name = "Daan Braas";
// $user_password = "test123";
// $array = array($user_email, $user_name, $user_password);

// $new_user = implode("|", $array);

// fwrite($users_file, "\n" . $new_user);
// fclose($users_file);

$users_file = fopen('users/users.txt', 'r');
while(!feof($users_file)){
	$str = fgets($users_file);
	debug_to_console("password: ". $str[0]."+" . $str[1]."+".$str[2]);
  echo fgets($users_file) . '<br>';
}
// echo fread($users_file, filesize('users/users.txt'));

echo '<span class="error">* required fields</span>
	<form action="" method="POST">
		E-Mail: <input type="text" name="email" value=""><span class="error">*</span>
		<br><br>
    Naam: <input type="text" name="name" value=""><span class="error">*</span>
		<br><br>
		Wachtwoord: <input type="text" name="password" value=""><span class="error">*</span>
		<br><br>
    Herhaal wachtwoord: <input type="text" name="pass_rep" value=""><span class="error">*</span>
    <br><br>
		<input type="hidden" name="page" value="registration">
		<input type="submit">
	</form>';


	function validateField($array, $value, $check){
		$checkFields = explode(":", $check);

		if(empty(getPostVar($value))){
			$array['errors'][$value] = $value . " is required";
		} else {
			switch($checkFields[0]){
				case 'nameValid':
					$array['values'][$value] = test_input(getPostVar($value));
					// check if name only contains letters and whitespace
					if (!preg_match("/^[a-zA-Z-' ]*$/",$array['values'][$value])) {
						$array['errors'][$value] = "Only letters and white space allowed";
					}
					break;
				case 'emailValid':
					$array['values'][$value] = test_input(getPostVar($value));
					// check if e-mail address is well-formed
					if (!filter_var($array['values'][$value], FILTER_VALIDATE_EMAIL)) {
						$array['errors'][$value] = "Invalid ". $value ." format";
					}
					break;
				case 'pass_rep':
					if(!strcmp(getPostVar($value), $array['values'][$checkFields[1]])){
						$array['values'][$value] = getPostVar($value);
					} else{
						$array['errors'][$value] = "Passwords don't match";
						$array['errors'][$checkFields[1]] = "Passwords don't match";
						$array['values'][$value] = "";
						$array['values'][$checkFields[1]] = "";
					}
					break;
			}
		}
		return $array;
	}
// Advanced SQL
$sqlSELECT = 'SELECT p.id, p.name, p.price, p.filename, ir.quantity FROM products p
LEFT JOIN invoice_row ir ON p.id=ir.product_id
';

$sqlSUM = 'SELECT SUM(quantity) FROM invoice_row WHERE product_id = 1
';

$sqlSELECTSUM = 'SELECT DISTINCT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
FROM products p
LEFT JOIN invoice_row ir ON p.id=ir.product_id
GROUP BY p.id
ORDER BY quantity DESC
';

$sqlTOP5 = 'SELECT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
FROM products p
LEFT JOIN invoice_row ir ON p.id=ir.product_id
GROUP BY p.id
ORDER BY quantity DESC
LIMIT 5
';

$sqlCOMPLETE = 'SELECT p.id, p.name, p.price, p.filename, SUM(ir.quantity) AS quantity
FROM products p
LEFT JOIN invoice_row ir ON p.id=ir.product_id
LEFT JOIN invoice i ON ir.invoice_id=i.id
AND DATEDIFF(CURRENT_DATE(), i.date) < 7
GROUP BY p.id
ORDER BY quantity DESC
LIMIT 5
';


?>
