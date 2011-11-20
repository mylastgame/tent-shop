<?php
abstract class Collection
{
  protected $collection = array();
  protected $table;
  protected $relations;
  protected $object;

  public function  __construct()
  {
 
  }

  public function load($condition = false, $key = false, $value = false)
  {
    if(!$condition) 
    {
      $rows = DB::getInstance()->select($this->table);
      foreach ($rows as $row) $this->collection[] = new $this->object($row);
    }

    if($condition == 'with_spec_field')
    {
      $condition = 'WHERE '.$key.'=\''.$value.'\'';
      $rows = DB::getInstance()->select($this->table, '*', $condition);
      if($rows == NULL) return false;
      foreach ($rows as $row) $this->collection[] = new $this->object($row);
    }

    if($condition == 'depends_on_parent')
    {
      $rows = DB::getInstance()->select_query('Select * from '.$this->table.' c
      inner join '.$this->relations['table'].' r
        on c.id=r.'.$this->relations['child_id'].' where r.'.$this->relations['parent_id'].'=\''.$key.'\'');
      foreach ($rows as $row) $this->collection[] = new $this->object($row);
    }

    if($condition == 'or')
    {
      $cond = 'WHERE ';
      $count = count($value);
      $i = 1;
      foreach($value as $v)
      {
        if($i == $count) $cond .= $key.'=\''.$v.'\'';
        if($i != $count) $cond .= $key.'=\''.$v.'\' OR ';
        $i++;
      }

      $rows = DB::getInstance()->select($this->table, '*', $cond);
      foreach ($rows as $row) $this->collection[] = new $this->object($row);
    }

    return $this;
  }
  
  public function getElementBy($key, $value)
  {
    foreach($this->collection as $element)
    {
      if($element->get($key) == $value) return $element;
    }
    return false;
  }

  public function get()
  {
    if($this->collection) return $this->collection;
    return false;   
  }

  public function findElementBy($array)
  {
    $count = count($array);
    $i = 1;
    $condition = 'WHERE ';
    foreach($array as $key=>$value)
    {
      if($i == $count) $condition .= $key.'=\''.$value.'\'';
      if($i != $count) $condition .= $key.'=\''.$value.'\' AND ';
      $i++;
    }


    $row = DB::getInstance()->select($this->table, '*', $condition, 'row');
    if($row == NULL) return false;
    return new $this->object($row);
  }
}
?>
