<?php
class Application
{
  private $id;
  private $name;
  private $url;
  private $sections;

  public function __construct($id, $name, $url = '')
  {
    $this->id = $id;
    $this->name = $name;
    $this->url  = $url;
  }

  public function load_sections()
  {
    $this->sections = new Sections($this);
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_url()
  {
    return $this->url;
  }

  public function get_id()
  {
    return $this->id;
  }

  public function get_sections()
  {
    if(!is_object($this->sections)) $this->load_sections();
    return $this->sections;
  }
}
?>
