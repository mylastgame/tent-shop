<?php
class Categories extends Collection
{
  public function  __construct() {
    $this->object = 'Category';
    $this->table = CATEGORIES_TABLE;
  }
}
?>
