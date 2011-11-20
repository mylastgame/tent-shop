<?php
class DB
{
  private $host;
  private $user;
  private $password;
  private $database;
  private static $instance;
  private $mysqli;

  private function __construct()
  {
    $this->host = DB_HOST;
    $this->user = DB_USER;
    $this->password = DB_PASS;
    $this->database = DB_DBASE;
    $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
  }

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new DB();
    return self::$instance;
  }

  public function select($table, $rows = '*', $condition = false, $view_result = 'assoc')
  {
    $query = 'Select';
    if($rows == '*') $query .= ' * ';
    elseif(!is_array($rows) && $rows != '*') $query .= ' '.$rows.' ';
    else
    {
      $lenght = count($rows);
      $i = 1;
      foreach ($rows as $row)
      {
        if($i != $lenght) $query .= ' '.$row.',';
        if($i == $lenght) $query .= ' '.$row.' ';
        $i++;
      }      
    }

    $query .= ' from '.$table;

    if($condition) $query .= ' '.$condition;

    //echo $query;

    $result = $this->mysqli->query($query);
    if($view_result == 'assoc') return $this->get_result_assoc($result);
    if($view_result == 'single') return $this->get_result_single($result);
    if($view_result == 'row') return $this->get_result_row($result);
  }

  public function select_query($query, $view_result = 'assoc')
  {
    //echo $query;
    $result = $this->mysqli->query($query);
    
    if($view_result == 'assoc') return $this->get_result_assoc($result);
    if($view_result == 'single') return $this->get_result_single($result);
  }

  public function get_result_assoc($result)
  {
    $return_value;
    while($row = $result->fetch_assoc()) $return_value[] = $row;
    return $return_value;
  }

  public function get_result_single($result)
  {
    $row = $result->fetch_row();
    return $row[0];
  }

  public function get_result_row($result)
  {
    return $result->fetch_assoc();
  }


  public function insert($table, $values)
  {
    $query = "INSERT INTO ".$table." SET ";
    $count = count($values);
    $i = 1;
    foreach ($values as $key=>$value)
    {
      if($i == $count) $query .= $key.'='.'\''.$value.'\'';;
      if($i != $count) $query .= $key.'='.'\''.$value.'\', ';
      $i++;
    }

    //echo $query;

    $this->mysqli->query($query);
    return $this->mysqli->insert_id;
  }

  public function update($table, $values, $conditions)
  {
    $query = "UPDATE ".$table." SET ";
    $count = count($values);
    $i = 1;
    foreach ($values as $key=>$value)
    {
      if($i == $count) $query .= $key.'='.'\''.$value.'\'';;
      if($i != $count) $query .= $key.'='.'\''.$value.'\', ';
      $i++;
    }
    $query .= $conditions;

    //echo $query;

    $this->mysqli->query($query);
  }

  public function multipleInsert($table, $rows)
  {
    $count = count($rows);
    $query = 'INSERT INTO '.$table.' VALUES';
    $i=1;
    foreach($rows as $row)
    {
      $query .= '(';
      $countRow = count($row);
      $j = 1;
      foreach($row as $value)
      {
        if($j != $countRow) $query .= $value.',';
        if($j == $countRow) $query .= $value;
        $j++;
      }
      if($i != $count) $query .= '),';
      if($i == $count) $query .= ')';
      $i++;
    }

    //echo $query;
    $this->mysqli->query($query);
  }
}
?>
