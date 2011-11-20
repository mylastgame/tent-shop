<?php
class System
{
  private static $instance;
  private $applications;
  private $application;
  private $sections;
  private $section;
  private $modules;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new System();
    return self::$instance;
  }

  private function  __construct()
  {
    Request::getInstance();
    Response::getInstance();
    $this->init_system();
  }

  private function init_system()
  {
    $this->load_application();
    $this->load_section();
    $this->load_modules();
  }

  private function load_application()
  {
    $request = Request::getInstance();
    $this->applications = new Applications();
    $this->application = $this->applications->load()->getElementBy('url', $request->getFirst());
    if(!$this->application) $this->application = $this->applications->getElementBy ('name', 'main');
  }

  private function load_section()
  {
    $request = Request::getInstance();
    $this->sections = new Sections();
    $this->section = $this->sections
            ->load('with_spec_field', 'app_id', $this->application->get('id'))
            ->getElementBy('url', $request->getFirst()); 
    if(!$this->section)
    {
      if($request->getFirst() == 'index.php') $this->section = $this->sections->getElementBy ('name', 'index');
      else Errors::getInstance()->add(new Error('BadRequestParameter'));      
    }
    else
    {
      if($this->section->get('name') != 'index') $request->shiftUri();
    }
  }

  private function load_modules()
  {
    if(!$this->section) return;
    $this->modules = new Modules();
    $this->modules->load('depends_on_parent', $this->section->get('id'));
  }

  public function setSection($name)
  {
    $this->section = $this->sections->getElementBy('name', $name);
    $this->load_modules();
  }

  public function test()
  {
    //foreach($this->applications->get() as $app) echo $app->get('id').' : '.$app->get('name').' - '.$app->get('url').'<br>';
    //echo $this->application->get('name');
    //foreach($this->sections->get() as $sec) echo $sec->get('id').' : '.$sec->get('name').' - '.$sec->get('url').'<br>';
    //echo $this->section->get('name');
   // foreach($this->modules->get() as $m) echo $m->get('id').' : '.$m->get('name').'<br>';

    //$tt = $this->modules->getElementBy('name', 'ModuleCatalogNavigation')->getTest();
    //foreach ($tt as $t) echo $t->get('name').' - '.$t->get('path');
  }

  public function handleRequest()
  {
    $errors = Errors::getInstance();
    if($errors->isErrors()) $errors->handleErrors();

    foreach($this->modules->get() as $module)
    {
      $module->handleRequest();
    }

    if($errors->isErrors())
    {
      $errors->handleErrors();
      $this->handleRequest();
    }
  }

  public function getResponce()
  {
    $response = Response::getInstance();
    foreach($this->modules->get() as $module)
    {
      $response->getResponseFromModule($module->get('name'), $module->getResponce());
    }
  }

  public function display()
  {
    $response = Response::getInstance();
    require_once SITE_ROOT.$this->section->get('template');
  }

  public function getSection()
  {
    if($this->section) return $this->section;
    return false;
  }

  public function getSections()
  {
    if($this->sections) return $this->sections->get();
    return false;
  }

}
?>
