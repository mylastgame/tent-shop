<?php
$cur_category = $r->get('category');
$products = $r->get('products');
$cur_product = $r->get('product');
?>
<div>
<p class="title">опндсйрш</p>
<?php foreach($r->get('categories') as $category): ?>
  <?php if($cur_category->get('id') == $category->get('id')):?>
    <?php echo '<p id="curent_category"><a href='.$category->getUrl().'>'.$category->get('name').'</a></p>';?>
    <?php foreach($products as $product):?>
      <?php if($cur_product->get('id') == $product->get('id')):?>
        <?php echo '<p id="current_product">'.$product->get('name').'</p>';?>
        <?php continue;?>
      <?php endif;?>
      <?php echo '<p class="product"><a href='.$product->getUrl().'>'.$product->get('name').'</a></p>';?>
    <?php endforeach;?>
    <?php continue;?>
  <?php endif;?>
  <?php echo '<p class="category"><a href='.$category->getUrl().'>'.$category->get('name').'</a></p>';?>
<?php endforeach;?>
</div>
