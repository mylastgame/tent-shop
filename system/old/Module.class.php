<?php
class Module
{
  protected $name;
  protected $templates;

  public function __construct($id, $name, $templates)
  {
    $this->id = $id;
    $this->name = $name;
    $this->templates = $templates;
  }

  public function get_id()
  {
    return $this->id;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_template($name)
  {
    return $this->templates[$name];
  }

  public function handle_request()
  {
    $r = new ModuleResponse($this->get_name());
    $r->set_template($this->get_template('index'));
    return $r;
  }

}
?>
