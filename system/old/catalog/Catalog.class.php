<?php
class Catalog
{
  private static $instance;
  private $categories;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Catalog();
    return self::$instance;
  }

  private function  __construct()
  {
    $this->categories = new Categories();
  }

  public function getCategories()
  {
    return $this->categories->getCategories();
  }

  public function get_category()
  {
    return $this->categories->get_category();
  }

  public function get_products()
  {
    return $this->categories->get_category()->get_products()->get_products();
  }

  public function get_product()
  {
    return $this->categories->get_category()->get_products()->get_product();
  }


}
?>
