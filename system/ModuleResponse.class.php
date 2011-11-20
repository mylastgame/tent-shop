<?php

class ModuleResponse {

  private $name;
  private $data;
  private $template;

  public function __construct($name)
  {
    $this->name = $name;
    $this->data = array();
  }

  public function set($key, $value)
  {
    $this->data[$key] = $value;
  }

  public function get($key)
  {
    return $this->data[$key];
  }

  public function setArray($array)
  {
    foreach ($array as $key => $value)
    {
      $this->data[$key] = $value;
    }
  }

  public function setTemplate($template)
  {
    $this->template = $template;
  }

  public function getTemplate()
  {
    return $this->template->get('path');
  }

  public function getName()
  {
    return $this->name;
  }
}
?>
