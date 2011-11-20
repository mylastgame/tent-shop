<?php
class Orders extends Collection
{
  public function  __construct() {
    $this->table = ORDERS_TABLE;
    $this->object = 'Order';
  }
}
?>
