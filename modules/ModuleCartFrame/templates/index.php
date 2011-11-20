<div class="cartframe">
<img src="http://tent-shop.z4.ru/img/site/bag.jpg">
<p class="cartframe">Товаров в корзине: <?php echo $r->get('count');?></p>
<?php if($r->get('count') > 0):?>
  <?php echo '<p><a href=http://'.SITE_NAME.'/cart/>Оформить заказ</a></p>'; ?>
<?php endif;?>
</div>