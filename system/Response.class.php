<?php
class Response
{
  private $module_responses;

  
  private static $instance;

  private function  __construct()
  {

  }

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Response();
    return self::$instance;
  }

  public function getResponseFromModule($name, $response)
  {
    if($response instanceof ModuleResponse) $this->module_responses[$name] = $response;
  }

  public function getModuleResponse($name)
  {
    return $this->module_responses[$name];
  }

  public function clear()
  {
    $this->module_responses = array();
  }

  public function delModuleResponse($name)
  {
    unset($this->module_responses[$name]);
  }

  public function contt()
  {
    foreach($this->module_responses as $k=>$r) $a[] = $k;
    return $a;
  }
}
?>
