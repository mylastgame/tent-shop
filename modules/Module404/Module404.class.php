<?php
class Module404 extends Module
{
  public function  handle_request() {

    $r = new ModuleResponse($this->get_name());
    $r->set('ErrorMessage', 'http://'.SITE_NAME.Request::get_request()->get_uri());
    $r->set_template($this->get_template('index'));
    return $r;
  }
}
?>
