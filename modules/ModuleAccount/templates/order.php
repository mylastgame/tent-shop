<?php $order = $r->get('order');?>
<div class="main_account">
  <p class="small_title">Информация о заказе ID:<?php echo $order->get('id')?></p>
  <p class="tb_padding">Дата заказа: <?php echo date('d.m.y', $order->get('date'));?><br>
  Состояние заказа: <?php echo $order->get('state');?></p>
  <p>Список товаров:</p>
  <table id="orders">
    <tr><td class="orders">Название</td><td class="orders">Цена</td><td class="orders">Количество</td></tr>
    <?php foreach($r->get('cartSet')->getPurchases() as $purchase):?>
     <tr><td class="orders"><?php echo $purchase['product']->get('name');?></td>
     <td class="orders"><?php echo $purchase['product']->get('price');?>р.</td>
     <td class="orders"><?php echo $purchase['amount'];?></td></tr>
    <?php endforeach;?>
  </table>
  Общая сумма заказа: <?php echo $order->get('total_price');?>р.
  <p class="tb_padding">Информация по доставке:</p>
  Имя: <?php echo $order->get('name');?><br>
  email: <?php echo $order->get('email');?><br>
  Телефон: <?php echo $order->get('phone');?><br>
  Адрес: <?php echo $order->get('address');?><br>
  Доп. информация: <?php echo $order->get('notes');?><br>
  <p id="account_nav"><a href="http://<?php echo SITE_NAME?>/account/orders/">Назад</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>Выход</a>
  </p>
</div>