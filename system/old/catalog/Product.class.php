<?php
class Product
{
  private $id;
  private $name;
  private $price;
  private $url;
  private $img;
  private $cat_id;

  public function __construct($id, $name, $url, $img, $cat_id = false)
  {
    $this->id = $id;
    $this->name = $name;
    $this->url = $url;
    $this->img = $img;
    $this->cat_id = $cat_id;
  }

  public function get_id()
  {
    return $this->id;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_url()
  {
    return $this->url;
  }

  public function get_href()
  {
    return 'http://'.SITE_NAME.'/catalog/'.$this->url;
  }

  public function get_img()
  {
    return $this->img;
  }

  public function get_price()
  {
    return $this->price;
  }

  public function get_cat_id()
  {
    return $this->cat_id;
  }

  public function set_category_id($id)
  {
    $this->cat_id = $id;
  }
}
?>
