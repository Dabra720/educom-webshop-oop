<?php

class Util{

  // // Haal een value uit de 'values' array, deze wordt volgens mij niet meer gebruikt.
  public static function getValue($data, $key, $default=''){
    return getArrayVar($data, $key, $default);
  }

  // Haal een value uit de opgegeven array, aan de hand van een $key
  public static function getArrayVar($array, $key, $default='') 
  { 
     return isset($array[$key]) ? $array[$key] : $default; 
  }
  
  //Haal een value op uit de Post array, aan de hand van een $key
  public static function getPostVar($key, $default='')
  { 
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? Util::test_input($value) : $default; // Post variabelen worden clean returned
  } 
  
  // Haal een value op uit de GET array, aan de hand van een $key
  public static function getUrlVar($key, $default=''){
    return isset($_GET[$key]) ? Util::test_input($_GET[$key]) : $default; // GET variabelen worden clean returned
  }

  // Haal alle vreemde tekens uit de input.
  public static function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Debug tool, om variabelen makkelijk te kunnen checken
  public static function logDebug($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "');</script>";
  }
}

?>