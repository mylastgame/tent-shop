<?php
class Handler404 extends ModuleHandler
{
  public function handle()
  {

  }

  public function  getResponce($module) {
    $r = new ModuleResponse($module->get('name'));
    $r->set('ErrorMessage', 'http://'.SITE_NAME.Request::getInstance()->getUri());
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
