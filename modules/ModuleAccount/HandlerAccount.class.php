<?php
class HandlerAccount extends ModuleHandler
{
  public function handle()
  {
    $request = Request::getInstance();
    $account = Account::getInstance();

    if($request->UriEqual(0))
    {
      if($request->hasPost())
      {
        $account->checkLogin($request->getPost('email'), $request->getPost('password'));
      }
      return;
    }

    if($request->UriEqual(1))
    {
      if($request->getFirst() == 'logout') 
      {
        $account->logout();
        return;
      }

      if($request->getFirst() == 'change')
      {
        if($request->hasPost()) $account->change();
        return;
      }

      if($request->getFirst() == 'new')
      {
        if($request->hasPost()) $account->newCustomer();
        return;
      }

      if($request->getFirst() == 'orders') return;
    }

    if($request->UriEqual(2) && $request->getFirst() == 'orders' && Validator::getInstance()->isId($request->getSecond()))
    {
      return;
    }

    Errors::getInstance()->add(new Error('BadRequestParameter'));
  }

  public function  getResponce($module)
  {
    $r = new ModuleResponse($module->get('name'));
    $account = Account::getInstance();
    $request = Request::getInstance();

    if($request->getFirst() == 'new')
    {
      if($request->hasPost())
      {
        if(!$account->getErrors())
        {
          $r->set('customer', $account->getCustomer());
          $r->setTemplate($module->getTemplate('change_account'));
          return $r;
        }
        $r->set('errors', $account->getErrors());
      }
      $r->setTemplate($module->getTemplate('new_account'));
      return $r;
    }

    if(!$account->getCustomer())
    {
      if($account->getErrors()) $r->set('errors', $account->getErrors());
      $r->setTemplate($module->getTemplate('index'));
      return $r;      
    }

    $r->set('customer', $account->getCustomer());

    if($request->getFirst() == 'change')
    {
      if($request->hasPost())
      {
        if(!$account->getErrors()) 
        {
          $r->setTemplate($module->getTemplate('account'));
          return $r;
        }
        $r->set('errors', $account->getErrors());
      }      
      $r->setTemplate($module->getTemplate('change_account'));
      return $r;
    }

    if($request->getFirst() == 'orders' && $request->UriEqual(1))
    {
      $orders = $account->getCustomerOrders();
      if(!$orders)
      {
        $r->setTemplate($module->getTemplate('empty_orders'));
        return $r;
      }
      $r->set('orders', $orders);
      $r->setTemplate($module->getTemplate('orders'));
      return $r;
    }

    if($request->getFirst() == 'orders' && $request->UriEqual(2))
    {
      $order = $account->getCustomerOrder($request->getSecond());
      if(!$order)
      {
        $r->setTemplate($module->getTemplate('account'));
        return $r;
      }
      $r->set('order', $order);
      $r->set('cartSet', Cart::getInstance()->loadCartSet($order->get('cart_set_id')));
      $r->setTemplate($module->getTemplate('order'));
      return $r;
    }
    
    $r->setTemplate($module->getTemplate('account'));
    return $r;    
  }
}
?>
