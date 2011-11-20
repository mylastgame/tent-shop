<?php
class ModuleError
{
  private $module;
  private $errors;

  public function  __construct($module) {
    $this->module = $module;    
  }

  public function getModule()
  {
    return $this->module;
  }

  public function addError($error)
  {
    $this->errors[$error] = true;
  }

  public function get($error)
  {
    if($this->errors[$error]) return true;
    return false;
  }

  public function hasErrors()
  {
    if(count($this->errors) > 0) return true;
    return false;
  }
}
?>
