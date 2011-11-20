<?php
class ModuleErrors
{
  private static $instance;
  private $errors;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new ModuleErrors();
    return self::$instance;
  }

  public function addError($NewError)
  {
    if(!$this->errors)
    {
      $this->errors[] = $NewError;
      return;
    }

    foreach($this->errors as $key=>$error)
    {
      if($error->getModule() == $NewError->getModule()) 
      {
        $this->errors[$key] = $NewError;
        return;
      }
    }
    $this->errors[] = $NewError;
  }

  public function getError($moduleName)
  {
    if(!$this->errors) return false;
    foreach($this->errors as $error)
    {
      if($moduleName == $error->getModule()) return $error;
    }
  }
}
?>
