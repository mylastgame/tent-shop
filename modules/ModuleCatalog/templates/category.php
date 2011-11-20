<?php
$category = $r->get('category');
$products = $r->get('products');
?>
<div class="main_index">
  <p id="catalog_string"><a href=http://<?php echo SITE_NAME; ?>/catalog/>Каталог</a>
  -><?php echo '<a href='.$category->getUrl().'>'.$category->get('name').'</a></p>';?>
  <?php foreach($products as $product):?>
  <?php echo '<p class="catalog_category"><img src="'.$product->getImg().'"><br><a href='.$product->getUrl().'>'.$product->get('name').'</a></p>'; ?>
  <?php endforeach; ?>
</div>
