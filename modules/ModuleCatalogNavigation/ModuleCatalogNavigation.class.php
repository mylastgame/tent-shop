<?php
class ModuleCatalogNavigation extends Module
{
  public function  handle_request() {

    $catalog = Catalog::get_catalog();   
    $r = new ModuleResponse($this->get_name());
    
    $r->set('categories', $catalog->get_categories());
    if($catalog->get_category()) 
    {
      $r->set('category', $catalog->get_category());
      $r->set('products', $catalog->get_products());
      if($catalog->get_product())
      {
        $r->set('product', $catalog->get_product());
        $r->set_template($this->get_template('product'));
        return $r;
      }
      $r->set_template($this->get_template('category'));
      return $r;
    }
    $r->set_template($this->get_template('index'));
    return $r;
  }
}
?>
