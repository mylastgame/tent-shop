<?php
class ModuleIndex extends Module
{
  public function  handle_request() {
    $request = Request::get_request();
    if($request->uri_more_than(1))
    {
      $e = new SystemError('BadRequestParameter');
      Errors::get_instance()->add_error($e);
      return false;
    }   
  }

  public function get_responce()
  {
    $r = new ModuleResponse($this->get_name());
    $r->set_template($this->get_template('index'));
    return $r;
  }
}
?>
