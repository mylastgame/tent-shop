<?php
function __autoload($class_name)
{
  if($class_name == 'Modules' ||
     $class_name == 'Module')
  {
    require_once SITE_ROOT."system/".$class_name.".class.php";
    return;
  }


  if($class_name == 'Handler404')
  {
    require_once SITE_ROOT.'modules/Module404/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerCatalog')
  {
    require_once SITE_ROOT.'modules/ModuleCatalog/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerAccount')
  {
    require_once SITE_ROOT.'modules/ModuleAccount/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerCart')
  {
    require_once SITE_ROOT.'modules/ModuleCart/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerContacts')
  {
    require_once SITE_ROOT.'modules/ModuleContacts/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerCatalogNavigation')
  {
    require_once SITE_ROOT.'modules/ModuleCatalogNavigation/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerSectionsNavigation')
  {
    require_once SITE_ROOT.'modules/ModuleSectionsNavigation/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerCartFrame')
  {
    require_once SITE_ROOT.'modules/ModuleCartFrame/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerLoginFrame')
  {
    require_once SITE_ROOT.'modules/ModuleLoginFrame/'.$class_name.".class.php";
    return;
  }
  if($class_name == 'HandlerIndex')
  {
    require_once SITE_ROOT.'modules/ModuleIndex/'.$class_name.".class.php";
    return;
  }


  if($class_name == 'Account' ||
     $class_name == 'Customer' ||
     $class_name == 'Customers')
  {
    require_once SITE_ROOT.'model/account/'.$class_name.".class.php";
    return;
  }

  if($class_name == 'Catalog' ||
     $class_name == 'Categories' ||
     $class_name == 'Category' ||
     $class_name == 'Product'  ||
     $class_name == 'Products')
  {
    require_once SITE_ROOT.'model/catalog/'.$class_name.".class.php";
    return;
  }

  if($class_name == 'Cart' ||
     $class_name == 'CartSet' ||
     $class_name == 'Order' ||
     $class_name == 'Orders')
  {
    require_once SITE_ROOT.'model/cart/'.$class_name.".class.php";
    return;
  }

  if($class_name == 'Collection' ||
     $class_name == 'Entity')
  {
    require_once SITE_ROOT.'system/base/'.$class_name.".class.php";
    return;
  }

  require_once SITE_ROOT."system/".$class_name.".class.php";
}
?>
