<?php
class Category extends Entity
{
  public function  __construct($values = false) {
    parent::__construct($values);
    $this->table = CATEGORIES_TABLE;
  }

  public function getUrl()
  {
    return 'http://'.SITE_NAME.'/catalog/'.$this->get('url');
  }

  public function getImg()
  {
    return 'http://'.SITE_NAME.'/img/'.$this->get('img');
  }
}
?>
