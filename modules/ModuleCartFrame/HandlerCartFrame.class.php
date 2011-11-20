<?php
class HandlerCartFrame extends ModuleHandler
{
  public function handle()
  {
    
  }

  public function  getResponce($module) {
    $cart = Cart::getInstance();

    $r = new ModuleResponse($module->get('name'));
    $r->setTemplate($module->getTemplate('index'));
    $r->set('count', $cart->countPurchases());
    return $r;
  }
}
?>
