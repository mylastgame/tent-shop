<?php
class Templates extends Collection
{
  public function __construct()
  {
    $this->object = 'Template';
    $this->table = MTEMPLATES_TABLE;
    $this->relations = array('table'=>MODULES_MTEMPLATES_TABLE,
                             'child_id'=>'tmpl_id',
                             'parent_id'=>'mod_id');
  }
}
?>
