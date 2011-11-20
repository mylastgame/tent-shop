<?php
class Customers extends Collection
{
  public function  __construct()
  {
    $this->table = CUSTOMERS_TABLE;
    $this->object = Customer;
  }
}
?>
