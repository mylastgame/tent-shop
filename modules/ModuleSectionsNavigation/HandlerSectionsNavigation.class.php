<?php
class HandlerSectionsNavigation extends ModuleHandler
{
  public function handle()
  {

  }

  public function  getResponce($module) {
    $sections = System::getInstance()->getSections();
    $section = System::getInstance()->getSection();

    $r = new ModuleResponse($module->get('name'));
    $r->setTemplate($module->getTemplate('index'));
    $r->set('current_section', $section);
    $r->set('sections', $sections);
    return $r;
  }
}
?>
