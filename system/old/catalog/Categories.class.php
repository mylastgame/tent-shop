<?php
class Categories
{
  private $categories;
  private $category;

  public function __construct()
  {
    $this->categories = $this->load_data();
    $this->category = $this->inner_get_category();
  }

  private function load_data()
  {
    $db = DB::init_db();
    $cats = $db->select(CATEGORIES_TABLE);
    foreach($cats as $cat)
    {
      $categories[] = new Category($cat['id'], $cat['name'], $cat['url'], $cat['img']);
    }
    return $categories;
  }

  private function inner_get_category()
  {
    if(!empty($this->category)) return $this->category;

    $request = Request::get_request();
    if($request->get_first() && System::init_system()->get_section()->get_name() == 'catalog')
    {
      $category = $this->get_category_by_url($request->get_first());
      if($category) 
      {
        $category->load_data();
        return $category;
      }

      $products = new Products('all');
      $product = $products->get_product_by_url($request->get_first());
      if($product)
      {
        $product->set_category_id($products->get_category_id($product));
        $category = $this->get_category_by_id($product->get_cat_id());
        $category->load_data();
        return $category;
      }
    }

    return false;
  }

  private function get_category_by_url($url)
  {
    foreach($this->categories as $category)
    {
      if($category->get_url() == $url) return $category;
    }
    return false;
  }

  private function get_category_by_id($id)
  {
    foreach($this->categories as $category)
    {
      if($category->get_id() == $id) return $category;
    }
    return false;
  }

  public function get_categories()
  {
    return $this->categories;
  }

  public function get_category()
  {
    if($this->category) return $this->category;
    return false;
  }
}
?>
