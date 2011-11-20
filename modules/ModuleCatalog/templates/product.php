<?php
$category = $r->get('category');
$product = $r->get('product');
?>
<div class="main_index">
  <p id="catalog_string"><a href=http://<?php echo SITE_NAME; ?>/catalog/>Каталог</a>
  -><?php echo '<a href='.$category->getUrl().'>'.$category->get('name').'</a>';?>
  -><?php echo '<a href='.$product->getUrl().'>'.$product->get('name').'</a></p>';?>
  
  <div id="product_frame">
  <?php echo '<p id="product_title">'.$product->get('name').'</p>'; ?>
  <img src="<?php echo $product->getImg(); ?>">
  <p id="descr"><?php echo $product->get('description');?></p>
  <p>Цена: <?php echo $product->get('price');?>р.</p>
  <form method="POST" action="<?php echo $product->getUrl();?>">
  <p id="in_cart">Количество: <input type="text" name="amount" value="1" size="1">
  <input type="hidden" name="product_id" value="<?php echo $product->get('id'); ?>" >
  <input type="submit" name="purchase" value="В корзину"></p>
  </form>
  </div>
</div>