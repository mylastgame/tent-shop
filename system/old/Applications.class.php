<?php
class Applications
{
  private $applications;
  private $current_application;

  public function __construct()
  {
    $this->applications = $this->load_data();
    $this->current_application = $this->inner_get_application();
  }

  private function load_data()
  {
    $db = DB::init_db();
    $applications = $db->select(APPLICATIONS_TABLE);
    $array = array();
    foreach ($applications as $app)
    {
      $array[] = new Application($app['id'], $app['name'], $app['url']);
    }
    
    return $array;
  }

  public function get_applications()
  {
    return $this->applications;
  }

  public function get_application()
  {
    if($this->current_application) return $this->current_application;
    else $this->inner_get_application ();
  }

  public function inner_get_application()
  {
    $request = Request::get_request();
    foreach($this->applications as $app)
    {
      if($request->get_first() == '' || $request->get_first() == 'index.php') return $this->get_application_by_name('main');
      if($request->get_first() == $app->get_url())
      {
        $request->shift_uri();
        return $app;
      }
    }
    return $this->get_application_by_name('main');
  }

  public function get_application_by_name($name)
  {
    foreach ($this->applications as $app)
    {
      if($name == $app->get_name()) return $app;
    }
  }
}
?>
