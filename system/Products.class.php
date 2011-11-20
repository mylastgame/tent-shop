<?php
class Products
{
  private $products;
  private $product;

  public function  __construct($id)
  {
    if($id == 'all') $this->products = $this->load_all();
    else
    {
      $this->products = $this->load_data($id);
      $this->product = $this->get_product();
    }
  }

  private function load_data($id)
  {
    $db = DB::init_db();
    $prods = $db->select_query('SELECT id, name, url, img from '.PRODUCTS_TABLE.' 
      p inner join '.CATEGORIES_PRODUCTS_TABLE.' cp On p.id=cp.prod_id where cp.cat_id='.$id);
    foreach($prods as $prod)
    {
      $products[] = new Product($prod['id'], $prod['name'], $prod['url'], $prod['img'], $id);
    }
    return $products;
  }

  private function load_all()
  {
    $db = DB::init_db();
    $prods = $db->select(PRODUCTS_TABLE);
    foreach($prods as $prod)
    {
      $products[] = new Product($prod['id'], $prod['name'], $prod['url'], $prod['img']);
    }
    return $products;
  }

  public function get_product()
  {
    if(!empty($this->product)) return $this->product;

    $request = Request::get_request();
    if($request->get_first() && System::init_system()->get_section()->get_name() == 'catalog')
    {
      $product = $this->get_product_by_url($request->get_first());
      if($product) return $product;
    }
    return false;
  }

  public function get_products()
  {
    return $this->products;
  }

  public function get_product_by_url($url)
  {
    foreach($this->products as $product)
    {
      if($product->get_url() == $url) return $product;
    }
    return false;
  }

  public function get_category_id($product)
  {
    $db = DB::init_db();
    return $result =  $db->select(CATEGORIES_PRODUCTS_TABLE, 'cat_id', 'WHERE prod_id='.$product->get_id(), 'single');
  }
}
?>