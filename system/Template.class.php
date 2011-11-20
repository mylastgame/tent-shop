<?php
class Template extends Entity
{
  public function  __construct($values = false) {
    $this->table = MTEMPLATES_TABLE;
    parent::__construct($values);
  }
}
?>
