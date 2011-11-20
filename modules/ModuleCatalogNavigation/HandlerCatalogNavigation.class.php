<?php
class HandlerCatalogNavigation extends ModuleHandler
{
  public function handle()
  {
    
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
