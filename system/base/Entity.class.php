<?php
abstract class Entity
{
  protected $data = array();
  protected $changed_data = array();
  protected $table;

  public function __construct($values = false)
  {
    if($values) foreach($values as $key=>$value) $this->data[$key] = $value;
  }

  public function set($values)
  {
    foreach($values as $key=>$value) 
    {
      if($this->data[$key] != $value)
      {
        $this->changed_data[$key] = $value;
        $this->data[$key] = $value;
      }
    }
  }

  public function get($key)
  {
    if($this->data[$key]) return $this->data[$key];
    return false;
  }

  public function save()
  {
    if($this->changed_data) DB::getInstance()->update($this->table, $this->changed_data, 'WHERE id='.$this->get('id'));
    else return false;
  }

  public function newElement()
  {
    return DB::getInstance()->insert($this->table, $this->data);
  }

  public function getUrl()
  {
    return 'http://'.SITE_NAME.'/'.$this->get('url');
  }
  
}
?>
