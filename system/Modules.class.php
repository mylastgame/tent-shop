<?php
class Modules extends Collection
{
  public function __construct()
  {
    $this->object = 'Module';
    $this->table = MODULES_TABLE;
    $this->relations = array('table'=>SECTIONS_MODULES_TABLE,
                             'child_id'=>'mod_id',
                             'parent_id'=>'sec_id');
  }
}
?>
