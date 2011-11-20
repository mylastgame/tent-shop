<?php
class Errors {
  private static $instance;

  private $system_errors;
  private $module_errors;

  private function  __construct()
  {

  }

  public static function get_instance()
  {
    if(!isset(self::$instance)) self::$instance = new Errors();
    return self::$instance;
  }

  public function add_error($error)
  {
    if($error instanceof SystemError) $this->system_errors[] = $error;
    if($error instanceof ModuleError) $this->module_errors[] = $error;
  }

  public function is_errors()
  {
    return ($this->is_system_errors() && $this->is_module_errors());
  }

  public function is_system_errors()
  {
    return (bool) count($this->system_errors);
  }

  public function is_module_errors()
  {
    return isset($this->module_errors);
  }

  public function get_system_errors()
  {
    return $this->system_errors;
  }

  public function get_module_errors()
  {
    return $this->module_errors;
  }

  public function handle_errors()
  {
    if($this->is_system_errors())
    {
      $this->handle_system_errors();
      return;
    }
    $this->handle_module_errors();
  }

  public function handle_system_errors()
  {
    while($error = array_shift($this->system_errors))
    {
      $error->handle_error();
    }
  }

  public function handle_module_errors()
  {
    foreach ($this->get_module_errors() as $error)
    {
      $error->handle_error();
    }
  }

  public function clear()
  {
    $this->system_errors = array();
    $this->module_errors = array();
  }
}
?>
