<?php
class Section extends Entity
{
  public function  __construct($values = false) {
    $this->table = SECTIONS_TABLE;
    parent::__construct($values);
  }
}
?>
