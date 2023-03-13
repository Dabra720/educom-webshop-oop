<?php
require_once "basic_doc.php";

abstract class FormsDoc extends BasicDoc{

  protected function showFormStart($hasRequiredFields){
    if($hasRequiredFields){
      echo "<span class='text-danger'>* required fields</span>";
    }
    echo "<form action='index.php' method='POST'>";
    echo "<div class='form-group'>";
  }
  protected function showFormField($field, $label, $type, $model, $required=true, $options=NULL){
    switch($type){
      case 'select':
        $this->showRowStart($label);
        echo "<select name='$field' id='$field' class='form-control'>";
        foreach($this->model->salutations as $key=>$label){
          echo "<option value='$label' "; if (Util::getArrayVar($this->model->values, $field)==$key) echo "selected"; echo " >$key</option>";
        }
        echo '</select><span class="text-danger">* '.Util::getArrayVar($this->model->errors, $field).'</span>';
        $this->showRowEnd();
        break;
      case 'radio':
        $this->showRowStart($label);
        echo "<div class='form-check form-check-inline'>";
        foreach($this->model->comm_prefs as $key=>$value){
          echo "<input type='$type' name='$field' id='$key' "; if (Util::getArrayVar($this->model->values, $field)==$value) echo "checked"; echo " value='$value' class='form-check-input'><label for='$key' class='form-check-label mr-sm-2'>$value</label>";
        }
        echo "<span class='text-danger'>* ".Util::getArrayVar($this->model->errors, $field)."</span>";
        echo "</div>";
        $this->showRowEnd();
        break;
      case 'textarea':
        $this->showRowStart($label);
        echo "<$type name='$field' class='form-control'>".Util::getArrayVar($this->model->values, $field)."</$type><span class='text-danger'>* ".Util::getArrayVar($this->model->errors, $field)."</span>";
        $this->showRowEnd();
        break;
      default:
        $this->showRowStart($label);
        echo "<input type='$type' name='$field' id='$field' value='".Util::getArrayVar($this->model->values, $field)."' class='form-control'><span class='text-danger'>* ".Util::getArrayVar($this->model->errors, $field)."</span>";
        $this->showRowEnd();
        break;
    }
  }
  private function showRowStart($label){
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<label for='$label'>$label: </label>";
    echo "</div>";
    echo "<div class='col'>";
  }
  private function showRowEnd(){
    echo "</div>"; // end .col
    echo "</div>"; // end .row
  }

  protected function showFormEnd(){
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<input type='submit' value='Verzend'>";
    echo "<input type='hidden' name='page' value='".$this->model->page."'>";
    echo "</div>"; // end .col
    echo "</div>"; // end .row
    echo "</div>"; // end .form-group
    echo "</form>";
  }


}

?>