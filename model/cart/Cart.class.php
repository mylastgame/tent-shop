<?php
class Cart
{
  private static $instance;
  private $purchases;
  private $errors;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Cart();
    return self::$instance;
  }

  private function  __construct()
  {
    $this->loadPurchases();
  }

  private function loadPurchases()
  {
    $request = Request::getInstance();
    $this->purchases = unserialize($request->getCookie('cart'));
  }

  public function countPurchases()
  {
    if(!$this->purchases) return 0;

    $count = 0;
    foreach($this->purchases as $amount)
    {
      $count += $amount;
    }
    return $count;
  }

  public function addPurchase($id, $amount)
  {
    $validator = Validator::getInstance();

    if(!$validator->isId($id)) $this->errors['id'] = true;
    if(!$validator->isNumber($amount)) $this->errors['amount'] = true;

    if($this->errors) return false;

    if($this->purchases[$id]) $this->purchases[$id] += $amount;
    else $this->purchases[$id] = $amount;

    $this->saveCookie();
  }

  private function saveCookie()
  {
    setcookie('cart', serialize($this->purchases), time() + 3600, "/", SITE_NAME);
  }

  private function clearCookie()
  {
    setcookie('cart', '', time(), "/", SITE_NAME);
  }

  public function hasPurchases()
  {
    if($this->purchases) return true;
    return false;
  }

  public function getCartSet()
  {
    if(!$this->purchases) return false;

    $products = new Products();
    $ids = array_keys($this->purchases);
    $products->load('or', 'id', $ids);

    $cartSet = new CartSet();
    foreach($products->get() as $product)
    {
      $cartSet->add($product, $this->purchases[$product->get('id')]);
    }

    return $cartSet;
  }

  public function clearCart()
  {
    $this->purchases = false;
    $this->clearCookie();
  }

  public function changeCart()
  {
   $request = Request::getInstance();
   $validator = Validator::getInstance();

   if($request->getPost('delete'))
   {
     foreach ($request->getPost('delete') as $id=>$value)
     {
       unset($this->purchases[$id]);
     }
   }

   foreach ($request->getPost('amount') as $id=>$amount)
   {
     if($this->purchases[$id] && $validator->isNumber($amount)) $this->purchases[$id] = $amount;
   }

   $this->saveCookie();

  }

  public function loadCartSet($id)
  {
    $cartSet = new CartSet();
    $purchases = $cartSet->loadById($id);
    foreach($purchases as $purchase)
    {
      $ids[] = $purchase['prod_id'];
    }

    $products = new Products();
    $products->load('or', 'id', $ids);
    $producst_array = $products->get();

    for($i=0; $i<count($purchases); $i++)
    {
      $cartSet->add($producst_array[$i], $purchases[$i]['amount']);
    }

    return $cartSet;
  }

  public function registerNewOrder()
  {
    $account = Account::getInstance();
    $request = Request::getInstance();

    $cartSet = $this->getCartSet();
    $cartSet->save();
    $order = new Order();
    $order->set(array('cart_set_id'=>$cartSet->getNumId()));
    $order->set(array('state'=>'Новый'));
    if($account->getCustomer()) $order->set(array('cus_id'=>$account->getCustomer()->get('id')));
    $order->setDeliveryInfo($request->getPostAll());
    $order->set(array('total_price'=>$cartSet->getTotalPrice()));
    $order->genDate();
    $order->newElement();
    $this->clearCart();
  }

}
?>
