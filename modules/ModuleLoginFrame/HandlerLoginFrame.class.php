<?php
class HandlerLoginFrame extends ModuleHandler
{
  public function handle()
  {
    $request = Request::getInstance();
    $account = Account::getInstance();

    if($request->getPost('login_lframe'))
    {
      $account->checkLogin($request->getPost('email_lframe'), $request->getPost('password_lframe'));
    }
    return;
  }

  public function  getResponce($module) {
    $r = new ModuleResponse($module->get('name'));
    $request = Request::getInstance();
    $account = Account::getInstance();

    if($account->getCustomer())
    {
      $r->set('customer', $account->getCustomer());
      $r->setTemplate($module->getTemplate('login'));
      return $r;
    }

    if($request->getPost('login_lframe'))
    {
      if(!$account->getErrors())
      {
        $r->set('customer', $account->getCustomer());
        $r->setTemplate($module->getTemplate('login'));
        return $r;
      }
      $r->set('errors', $account->getErrors());
    }
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
