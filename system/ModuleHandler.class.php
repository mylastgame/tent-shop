<?php
abstract class ModuleHandler
{
  protected $errors;

  public function  __construct()
  {
  
  }


  public function handle()
  {

  }

  public function getResponce($module)
  {
    $r = new ModuleResponse($module->get('name'));
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
