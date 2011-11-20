<div class="main_account">
  <p class="small_title">Информация о Ваших заказах.</p>
  <table id="orders">
    <tr><td class="orders">ID:</td><td class="orders">Сумма заказа:</td><td class="orders">Дата:</td><td class="orders">Состояние:</td><td></td></tr>
  <?php foreach ($r->get('orders') as $order):?>
    <?php echo '<tr><td class="orders">'.$order->get('id').
               '</td><td class="orders">'.$order->get('total_price').
               'р</td><td class="orders">'.date('d.m.y', $order->get('date')).
               '</td><td class="orders">'.$order->get('state').
               '</td><td class="orders"><a href=http://'.SITE_NAME.'/account/orders/'.$order->get('id').'>Подробнее</a></td></tr>';?>
  <?php endforeach;?>
  </table>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/';?>>Назад</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>Выход</a></p>
</div>