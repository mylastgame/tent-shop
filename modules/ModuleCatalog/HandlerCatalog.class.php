<?php
class HandlerCatalog extends ModuleHandler
{
  public function handle()
  {
    $catalog = Catalog::getInstance();
    $request = Request::getInstance();
    $cart = Cart::getInstance();

    if($request->UriEqual(2))
    {
      if(is_object($catalog->getCategory()) && is_object($catalog->getProduct()))
      {
        if($request->hasPost())
        {
          $cart->addPurchase($request->getPost('product_id'), $request->getPost('amount'));
        }
        return true;
      } 
    }

    if($request->UriEqual(1))
    {
      if(is_object($catalog->getCategory())) return true;
    }

    if($request->UriEqual(0)) return true;

    Errors::getInstance()->add(new Error('BadRequestParameter'));
  }

  public function  getResponce($module)
  {
    $catalog = Catalog::getInstance();
    $r = new ModuleResponse($module->get('name'));

    $r->set('categories', $catalog->getCategories());
    if($catalog->getCategory())
    {
      $r->set('category', $catalog->getCategory());
      $r->set('products', $catalog->getProducts());
      if($catalog->getProduct())
      {
        $r->set('product', $catalog->getProduct());
        $r->setTemplate($module->getTemplate('product'));
        return $r;
      }
      $r->setTemplate($module->getTemplate('category'));
      return $r;
    }
    $r->setTemplate($module->getTemplate('index'));
    return $r;
  }
}
?>
