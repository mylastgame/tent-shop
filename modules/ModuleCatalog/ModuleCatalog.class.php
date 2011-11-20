<?php
class ModuleCatalog extends Module
{
  public function  handle_request()
  {
    $catalog = Catalog::get_catalog();
    $request = Request::get_request();

    if($request->uri_less_than(2))
    {
      $r = new ModuleResponse($this->get_name());

      if($request->uri_less_than(1))
      {
        $r->set('categories', $catalog->get_categories());
        $r->set_template($this->get_template('index'));
        return $r;
      }
      
      if($catalog->get_category())
      {
        $r->set('category', $catalog->get_category());
        if($catalog->get_product())
        {
          $r->set('product', $catalog->get_product());
          $r->set_template($this->get_template('product'));
          return $r;
        }
        $r->set('products', $catalog->get_products());
        $r->set_template($this->get_template('category'));
        return $r;
      }

    }

    $e = new SystemError('BadRequestParameter');
    Errors::get_instance()->add_error($e);
    return false;
  }
}
?>
