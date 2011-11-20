<?php

class Modules
{
  private $modules = array();

  public function __construct($section)
  {
    $this->modules = $this->load_modules($section);
  }

  private function load_modules($section)
  {    
    $db = DB::init_db();
    $modules = $db->select_query('Select id, name from '.MODULES_TABLE.' m
      inner join '.SECTIONS_MODULES_TABLE.' sm 
        on m.id=sm.mod_id where sm.sec_id=\''.$section->get_id().'\'');

    $array = array();
    foreach ($modules as $mod)
    {
      $tmpls = $db->select_query('select name, path from '.MTEMPLATES_TABLE.' t
        inner join '.MODULES_MTEMPLATES_TABLE.' mm on t.id=mm.tmpl_id
          where mm.mod_id='.$mod['id']);
      $templates = array();
      foreach($tmpls as $tmpl) $templates[$tmpl['name']] = $tmpl['path'];
      $array[] = new $mod['name']($mod['id'], $mod['name'], $templates);
    }
    return $array;
  }

  public function get_modules()
  {
    return $this->modules;
  }

  public function get_module_by_name($name)
  {
    foreach($this->modules as $module)
    {
      if($module->get_name() == $name) return $module;
    }
  }
}
?>
