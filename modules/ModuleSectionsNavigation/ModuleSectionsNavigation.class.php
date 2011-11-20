<?php
class ModuleSectionsNavigation extends Module
{
  public function  handle_request() 
  {
    $sections = System::init_system()->get_sections();
    $section = System::init_system()->get_section();
    
    $r = new ModuleResponse($this->get_name());
    $r->setTemplate($this->get_template('index'));
    $r->set('current_section', $section);
    $r->set('sections', $sections);
    return $r;
  }
}
?>
