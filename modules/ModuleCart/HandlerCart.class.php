<?php
class HandlerCart extends ModuleHandler
{
  public function handle()
  {
    $request = Request::getInstance();
    $cart = Cart::getInstance();
    $account = Account::getInstance();

    if(!$cart->hasPurchases() && $request->uriMoreThan(0) || $request->uriMoreThan(1))
    {
      Errors::getInstance()->add(new Error('BadRequestParameter'));
      return;
    }

    if($request->uriEqual(1) && $request->getFirst() != 'order')
    {
      Errors::getInstance()->add(new Error('BadRequestParameter'));
      return;
    }

    if($request->getPost('change_cart'))
    {
      $cart->changeCart();
    }

    if($request->getPost('clear_cart'))
    {
      $cart->clearCart();
    }

    if($request->getPost('check_address') || $request->getPost('change_order_address'))
    {
      $account->checkValues($request->getPostAll());
      $account->checkEmpty($request->getPostAll());
    }
  }

  public function  getResponce($module) {
    $r = new ModuleResponse($module->get('name'));
    $request = Request::getInstance();
    $cart = Cart::getInstance();
    $account = Account::getInstance();

    if($request->getPost('order_done'))
    {
      if($account->getErrors())
      {
        $customer = Account::getInstance()->getCustomer();
        if($customer)
        {
          $r->set('customer', $customer);
          $r->setTemplate($module->getTemplate('order_address_cus'));
          return $r;
        }
        $r->setTemplate($module->getTemplate('order_address_unk'));
        return $r;
      }
      $cart->registerNewOrder();      
      $r->setTemplate($module->getTemplate('order_done'));
      return $r;
    }

    if($request->getPost('change_order_address'))
    {
      if($account->getErrors())
      {
        $r->setTemplate($module->getTemplate('order_address_unk'));
        return $r;
      }
      $r->set('customer', new Customer($request->getPostAll()));
      $r->setTemplate($module->getTemplate('order_address_cus'));
      return $r;
    }

    if($request->getPost('check_address'))
    {
      if(!$account->getErrors())
      {
        $customer = new Customer($request->getPostAll());
        $r->set('customer', $customer);
        $r->set('cartSet', $cart->getCartSet());
        $r->setTemplate($module->getTemplate('order'));
        return $r;
      }
      $r->set('errors', $account->getErrors());
    }

    if($request->getFirst('order'))
    {
      $customer = Account::getInstance()->getCustomer();
      if($customer) 
      {
        $r->set('customer', $customer);
        $r->setTemplate($module->getTemplate('order_address_cus'));
        return $r;
      }
      $r->setTemplate($module->getTemplate('order_address_unk'));
      return $r;
    }

    if($cart->hasPurchases())
    { 
      $r->set('cartSet', $cart->getCartSet());
      $r->set('count', $cart->countPurchases());
      $r->setTemplate($module->getTemplate('cart_overview'));
      return $r;
    }
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
