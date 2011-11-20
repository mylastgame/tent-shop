<?php
class Category
{
  private $id;
  private $name;
  private $url;
  private $img;
  private $products;

  public function __construct($id, $name, $url, $img)
  {
    $this->id = $id;
    $this->name = $name;
    $this->url = $url;
    $this->img = $img;
    
  }

  public function load_data()
  {
    $this->products = new Products($this->id);
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

  public function get_products()
  {
    return $this->products;
  }
}
?>
