<?php
class Products extends Collection
{
  public function  __construct() {
    $this->object = 'Product';
    $this->table = PRODUCTS_TABLE;
    $this->relations = array('table'=>CATEGORIES_PRODUCTS_TABLE,
                             'child_id'=>'prod_id',
                             'parent_id'=>'cat_id');
  }
}
?>