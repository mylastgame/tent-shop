<?php
class Product extends Entity
{
  public function  __construct($values = false) {
    parent::__construct($values);
    $this->table = PRODUCTS_TABLE;
  }

  public function getUrl()
  {
    return 'http://'.SITE_NAME.'/catalog/'.Catalog::getInstance()->getCategory()->get('url').'/'.$this->get('url');
  }

  public function getImg()
  {
    return 'http://'.SITE_NAME.'/img/'.$this->get('img');
  }
}
?>
