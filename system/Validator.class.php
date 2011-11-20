<?php
class Validator
{
  private static $instance;

  private function  __construct()
  {

  }

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Validator();
    return self::$instance;
  }

  public function isEmail($email)
  {
    if(!$this->isNotEmpty($email)) return false;
    if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) return true;
    return false;
  }

  public function isText($text)
  {
    if(!$this->isNotEmpty($text)) return false;
    if(preg_match("/[<>`*]/", $text)) return false;
    if(preg_match("/--+/", $text)) return false;
    return true;
  }

  public function isNumber($number)
  {
    if(preg_match("/[\D]/", $number)) return false;
    return true;
  }

  public function isNotEmpty($value)
  {
    if($value) return true;
    return false;
  }

  public function lenghtMoreThan($text, $value)
  {
    if(strlen($text) > $value) return true;
    return false;
  }

  public function isPassword($password)
  {
    if(!$this->isText($password)) return false;
    if(!$this->lenghtMoreThan($password, PASSWORD_MIN_LENGTH-1)) return false;
    return true;
  }

  public function isId($id)
  {
    if(!$this->isNotEmpty($id)) return false;
    if(!$this->isNumber($id)) return false;
    return true;
  }

  public function isPhone($phone)
  {
    if(preg_match("/^[+]?[0-9() -]{5,30}$/", $phone)) return true;
    return false;
  }

  public function safe($string)
  {
    return trim(strip_tags(addslashes($string)));
  }
}
?>
