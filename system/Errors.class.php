<?php
class Errors
{
  private static $instance;

  private $errors;

  private function  __construct()
  {

  }

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Errors();
    return self::$instance;
  }

  public function add(Error $error)
  {
    $this->errors[] = $error;
  }

  public function isErrors()
  {
    if($this->errors) return true;
    return false;
  }

  public function handleErrors()
  {
    if($this->errors)
    {
      while($error = array_shift($this->errors))
      {
        $error->handleError();
      }
    }
  }

  public function clear()
  {
    $this->errors = array();
  }
}
?>
