<?php
class Customer extends Entity
{
  public function  __construct($values) {
    parent::__construct($values);
    $this->table = CUSTOMERS_TABLE;
  }
}
?>
