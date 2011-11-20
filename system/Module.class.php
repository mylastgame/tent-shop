<?php
class Module extends Entity
{
  private $templates;

  public function  __construct($values = false) {
    $this->table = MODULES_TABLE;
    parent::__construct($values);
    $classname = $this->get('handler');
    $this->handler = new $classname();
  }

  public function handleRequest()
  {
    $this->handler->handle();
  }

  public function getResponce()
  {
    $this->loadTemplates();
    return $this->handler->getResponce($this);
  }

  public function loadTemplates()
  {
    $this->templates = new Templates();
    $this->templates->load('depends_on_parent', $this->get('id'));
  }

  public function getTemplate($name)
  {
    return $this->templates->getElementBy('name', $name);
  }
}
?>
