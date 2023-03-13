<?php

class MenuItem{
  private $page;
  private $label;

  public function __construct($page, $label)
  {
    $this->page = $page;
    $this->label = $label;
  }

  public function showMenuItem(){
    echo "<li class='nav-item'>";
    echo "<a class='nav-link' href='../educom-webshop-oop/index.php?page=$this->page'>$this->label</a>";
    echo "</li>";
  }
}
?>