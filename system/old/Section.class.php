<?php
class Section
{
  private $id;
  private $app_id;
  private $name;
  private $title;
  private $url;
  private $modules;
  private $template;
  private $display;

  public function __construct($id, $app_id, $name, $title, $url, $template, $display = true)
  {
    $this->id = $id;
    $this->app_id = $app_id;
    $this->name = $name;
    $this->title = $title;
    $this->url = $url;    
    $this->template = $template;
    $this->display = $display;
  }

  private function load_modules()
  {
    $this->modules = new Modules($this);
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_title()
  {
    return $this->title;
  }


  public function get_url()
  {
    return $this->url;
  }

  public function get_id()
  {
    return $this->id;
  }

  public function get_modules()
  {
    if(!is_object($this->modules)) $this->load_modules($this);
    return $this->modules;
  }

  public function get_template()
  {
    return $this->template;
  }

  public function is_display()
  {
    return $this->display;
  }

}
?>
