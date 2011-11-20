<?php

class Error {

  private $type;

  public function __construct($type)
  {
    $this->type = $type;       
  }

  public function get_type()
  {
    return $this->type;
  }

  public function handle_error()
  {
    
  }

}
?>
