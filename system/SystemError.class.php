<?php
class SystemError extends Error
{
  public function handle_error()
  {
    if($this->get_type() == 'UnknownSection') $this->unknown_section();
    if($this->get_type() == 'BadRequestParameter') $this->unknown_section();
  }

  public function unknown_section()
  {
    System::init_system()->set_section('404');
  }
}
?>
