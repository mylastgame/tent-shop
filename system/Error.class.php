<?php
class Error
{
  private $type;

  public function __construct($type)
  {
    $this->type = $type;
  }

  public function handleError()
  {
    if($this->type == 'BadRequestParameter') System::getInstance ()->setSection('404');
  }
}
?>
