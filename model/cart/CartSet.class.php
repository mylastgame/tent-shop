<?php
class CartSet
{
  private $purchases;
  private $numId;

  public function  __construct()
  {
    $this->table = CART_SET_TABLE;
  }

  public function add(Product $product, $amount)
  {
    $this->purchases[] = array('product'=>$product, 'amount'=>$amount);
  }

  public function getPurchases()
  {
    if($this->purchases) return $this->purchases;
    return false;
  }

  public function getTotalPrice()
  {
    $total = 0;
    foreach($this->purchases as $p)
    {
      $total += $p['product']->get('price')*$p['amount'];
    }
    return $total;
  }

  public function save()
  {
    $data = array();
    $numId = DB::getInstance()->select_query('SELECT MAX(num_id) FROM '.$this->table, 'single');
    $numId++;
    foreach($this->purchases as $p)
    {
      $data[] = array('num_id'=>$numId, 'prod_id'=>$p['product']->get('id'), 'amount'=>$p['amount']);
    }
    DB::getInstance()->multipleInsert($this->table, $data);
    $this->numId = $numId;
  }
  
  public function getNumId()
  {
    if($this->numId) return $this->numId;
    return false;
  }

  public function loadById($id)
  {
    return DB::getInstance()->select($this->table, '*', 'WHERE num_id=\''.$id.'\'');
  }
}
?>
