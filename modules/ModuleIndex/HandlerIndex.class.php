<?php
class HandlerIndex extends ModuleHandler
{
  public function handle()
  {
    $request = Request::getInstance();
    if($request->uriMoreThan(1))
    {
      Errors::getInstance()->add(new Error('BadRequestParameter'));
      return false;
    }  
  }

  public function  getResponce($module) {
    $r = new ModuleResponse($module->get('name'));
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
