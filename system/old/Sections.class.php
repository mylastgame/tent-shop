<?php
class Sections
{
  private $sections;
  private $current_section;

  public function __construct(Application $application)
  {
    $this->sections = $this->load_data($application);
    $this->current_section = $this->inner_get_section();
  }

  private function load_data($application)
  {
    $db = DB::init_db();
    $sections = $db->select(SECTIONS_TABLE, '*', 'WHERE app_id='.$application->get_id());
    $array = array();
    foreach ($sections as $sec)
    {
      $array[] = new Section($sec['id'], $application->get_id(), $sec['name'], 
                             $sec['title'], $sec['url'], $sec['template'], $sec['display']);
    }
    return $array;
  }

  public function get_sections()
  {
    return $this->sections;
  }

  public function get_section()
  {
    if(isset($this->current_section)) return $this->current_section;
    else return $this->inner_get_section ();
  }

  public function inner_get_section()
  {
    $request = Request::get_request();
    foreach($this->sections as $sec)
    {
      if(!$sec->is_display()) continue;
      if($request->get_first() == '' || $request->get_first() == 'index.php') return $this->get_section_by_name('index');
      if($request->get_first() == $sec->get_name())
      {
        $request->shift_uri();
        return $sec;
      }
    }
    $e = new SystemError('UnknownSection');
    Errors::get_instance()->add_error($e);
    return false;
  }

  public function get_section_by_name($name)
  {
    foreach ($this->sections as $sec)
    {
      if($name == $sec->get_name()) return $sec;
    }
  }

  public function set_section($section_name)
  {
    $this->current_section = $this->get_section_by_name($section_name);
  }
}
?>
