<div class="main_account">
  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/cart/'?>">
  <table id="orders">
    <tr><td class="orders">Товар</td><td class="orders">Цена</td><td class="orders">Количество</td><td class="orders">Удалить</td><tr>
    <?php foreach($r->get('cartSet')->getPurchases() as $purchase):?>
      <?php echo '<tr><td class="orders">'.$purchase['product']->get('name').'</td><td class="orders">'.$purchase['product']->get('price').'р</td>'?>
      <?php echo '<td class="orders"><input type=text size="1" value='.$purchase['amount'].' name=amount['.$purchase['product']->get('id').']></td>'?>
      <td class="orders"><input type="checkbox" name="delete[<?php echo $purchase['product']->get('id')?>]"></td></tr>
    <?php endforeach;?>
  </table>
  Общая сумма: <?php echo $r->get('cartSet')->getTotalPrice();?>
  <p class="tb_padding">
    <input type="submit" value="Изменить" name="change_cart">
    <input type="submit" value="Очистить корзину" name="clear_cart">
  </form>
  </p>
  <p><a href=<?php echo 'http://'.SITE_NAME.'/cart/order/'?>>Оформить заказ</a></p>
</div>
