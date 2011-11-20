<?php
$cur_category = $r->get('category');
$products = $r->get('products');
?>
<div>
<p class="title">опндсйрш</p>
<?php foreach($r->get('categories') as $category): ?>
<?php if($cur_category->get('id') == $category->get('id')):?>
<?php echo '<p id="curent_category">'.$category->get('name').'</p>';?>
<?php foreach($products as $product):?>
<?php echo '<p class="product"><a href='.$product->getUrl().'>'.$product->get('name').'</a></p>';?>
<?php endforeach; continue; endif;?>
<?php echo '<p class="category"><a href='.$category->getUrl().'>'.$category->get('name').'</a></p>';?>
<?php endforeach;?>
</div>
