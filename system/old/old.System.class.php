<?php
class System
{
  private $applications;
  private static $instance;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new System();
    return self::$instance;
  }

  private function  __construct()
  {
    $this->applications = new Applications();
    $this->applications->load();
    Request::get_request();
    Response::get_response();
  }

  public function get_application()
  {
    return $this->applications->get_application();
  }


  public function handle_request() 
  {    
    $errors = Errors::get_instance();
    if($errors->is_system_errors()) $errors->handle_system_errors();

    $response = Response::get_response();
    foreach($this->get_modules() as $module)
    {
      $module->handle_request();
    }

    if($errors->is_system_errors()) 
    {           
      $errors->handle_system_errors();
      $this->handle_request();
    }
  }

  public function get_responce()
  {
    foreach($this->get_modules() as $module)
    {
      $response->get_response_from_module($module->get_name(), $module->get_responce());
    }
  }

  public function get_modules()
  {
    return $this->applications
            ->get_application()
            ->get_sections()
            ->get_section()
            ->get_modules()
            ->get_modules();
  }

  public function set_section($section_name)
  {
    $this->applications
            ->get_application()
            ->get_sections()
            ->set_section($section_name);
  }

  public function display()
  {
    $response = Response::get_response();
    require_once SITE_ROOT.$this->applications
            ->get_application()
            ->get_sections()
            ->get_section()
            ->get_template();
  }

  public function get_sections()
  {
    return $this->get_application()
            ->get_sections()
            ->get_sections();
  }

  public function get_section()
  {
    return $this->get_application()
            ->get_sections()
            ->get_section();
  }
}
?>
