<?php
class Catalog
{
  private static $instance;
  private $categories;
  private $category;
  private $products;
  private $product;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Catalog();
    return self::$instance;
  }

  private function  __construct()
  {
    $this->loadData();
  }

  private function loadData()
  {
    $this->categories = new Categories();
    $this->categories->load();
    
    if(System::getInstance()->getSection()->get('name') != 'catalog') return;
    $request = Request::getInstance();
    $validator = Validator::getInstance();
    if(!$request->getFirst()) return;
    if(!$validator->isText($request->getFirst())) return;

    $category = $this->categories->getElementBy('url', $validator->safe($request->getFirst()));
    if(!$category) return;    
    $this->category = $category;
    $this->products = new Products();
    $this->products->load('depends_on_parent', $this->category->get('id'));
    
    if(!$request->getSecond()) return;
    $product = $this->products->getElementBy('url', $validator->safe($request->getSecond()));
    if(!$product) return;
    $this->product = $product;
  }

  public function getCategories()
  {
    if($this->categories) return $this->categories->get();
    return false;
  }

  public function getCategory()
  {
    if($this->category) return $this->category;
    return false;
  }

  public function getProducts()
  {
    if($this->products) return $this->products->get();
    return false;
  }

  public function getProduct()
  {
    if($this->product) return $this->product;
    return false;
  }


}
?>
