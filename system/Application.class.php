<?php
class Application extends Entity
{
  public function  __construct($values = false) {
    $this->table = APPLICATIONS_TABLE;
    parent::__construct($values);
  }
}
?>
