<?php
class Request
{
  private $data;
  private static $instance;

  private function  __construct()
  {
    $this->data = $this->load();
  }

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Request();
    return self::$instance;
  }

  private function load()
  {
    $data['POST'] = $_POST;
    $data['COOKIE'] = $_COOKIE;
    $data['SERVER'] = $_SERVER;

    $data['request_uri'] = $_SERVER['REQUEST_URI'];
    $data['uri'] = explode("/", $_SERVER['REQUEST_URI']);
    array_shift($data['uri']);
    $count = count($data['uri']);
    if(!$data['uri'][$count - 1]) unset ($data['uri'][$count - 1]);
    return $data;
  }

  public function getUri()
  {
    return $this->data['request_uri'];
  }

  public function getFirst()
  {
    return $this->getUriElement(1);
  }

  public function getSecond()
  {
    return $this->getUriElement(2);
  }

  public function getUriElement($key)
  {
    $key -= 1;
    if(isset($this->data['uri'][$key])) return $this->data['uri'][$key];
    else return false;
  }

  public function shiftUri()
  {
    array_shift($this->data['uri']);
  }

  public function countUriElements()
  {
    return count($this->data['uri']);
  }

  public function uriLessThan($number)
  {
    if($this->countUriElements() < $number) return true;
    else return false;
  }

  public function uriMoreThan($number)
  {
    if($this->countUriElements() > $number) return true;
    else return false;
  }

  public function uriEqual($number)
  {
    if($this->countUriElements() == $number) return true;
    else return false;
  }

  public function getPost($value)
  {
    if($this->data['POST'][$value]) return $this->data['POST'][$value];
    return false;
  }

  public function getPostAll()
  {
    if($this->data['POST']) return $this->data['POST'];
    return false;
  }

  public function hasPost()
  {
    if(count($this->data['POST']) > 0) return true;
    return false;
  }

  public function getCookie($value)
  {
    if($this->data['COOKIE'][$value]) return $this->data['COOKIE'][$value];
    return false;
  }

  public function getServer($value)
  {
    if($this->data['SERVER'][$value]) return $this->data['SERVER'][$value];
    return false;
  }
}
?>
