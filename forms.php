<?php

function showFormStart($hasRequiredFields){
  if($hasRequiredFields){
    echo "<span class='text-danger'>* required fields</span>";
  }
	echo "<form action='index.php' method='POST'>";
  echo "<div class='form-group'>";
}

function showFormField($field, $label, $type, $data, $required=true, $options=NULL){

  switch($type){
    case 'select':
      showRowStart($field, $label);
      echo "<select name='$field' id='$field' class='form-control'>";
      foreach(SALUTATIONS as $key=>$label){
        echo "<option value='$key' "; if (getArrayVar($data['values'], $field)==$label) echo "selected"; echo " >$label</option>"; 
      }
			echo '</select><span class="text-danger">* '.getArrayVar($data['errors'], $field).'</span>';
      showRowEnd();
      break;
    case 'radio':
      showRowStart($field, $label);
      echo "<div class='form-check form-check-inline'>";
      foreach(COMM_PREFS as $key=>$value){
        echo "<input type='$type' name='$field' id='$key' "; if (getArrayVar($data['values'], $field)==$value) echo "checked"; echo " value='$value' class='form-check-input'><label for='$key' class='form-check-label mr-sm-2'>$value</label>";
      }
      echo "<span class='text-danger'>* ".getArrayVar($data['errors'], $field)."</span>";
      echo "</div>";
      showRowEnd();
      break;
    case 'textarea':
      showRowStart($field, $label);
      echo "<$type name='$field' class='form-control'>".getArrayVar($data['values'], $field)."</$type><span class='text-danger'>* ".getArrayVar($data['errors'], $field)."</span>";
      showRowEnd();
      break;
    default:
      showRowStart($field, $label);
      echo "<input type='$type' name='$field' id='$field' value='".getArrayVar($data['values'], $field)."' class='form-control'><span class='text-danger'>* ".getArrayVar($data['errors'], $field)."</span>";
      showRowEnd();
      break;
  }
}
function showRowStart($field, $label){
  echo "<div class='row'>";
  echo "<div class='col'>";
  echo "<label for='$label'>$label: </label>";
  echo "</div>";
  echo "<div class='col'>";
}
function showRowEnd(){
  echo "</div>"; // end .col
  echo "</div>"; // end .row
}
function showFormEnd($page){
  echo "<div class='row'>";
  echo "<div class='col'>";
  echo "<input type='submit' value='Verzend'>";
  echo "<input type='hidden' name='page' value='$page'>";
  echo "</div>"; // end .col
  echo "</div>"; // end .row
  echo "</div>"; // end .form-group
  echo "</form>";

}

?>