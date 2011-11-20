<?php
class Order extends Entity
{
  public function __construct($values = false)
  {
    $this->table = ORDERS_TABLE;
    parent::__construct($values);
  }

  public function setDeliveryInfo($data)
  {
    $this->set(array('name'=>$data['name']));
    $this->set(array('email'=>$data['email']));
    $this->set(array('phone'=>$data['phone']));
    $this->set(array('address'=>$data['address']));
    $this->set(array('notes'=>$data['notes']));
  }

  public function genDate()
  {
    $this->set(array('date'=>time()));
  }
}
?>
