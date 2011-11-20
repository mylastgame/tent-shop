<?php $customer = $r->get('customer');?>
<div class="main_account">
  Информация о пользователе:
  <table>
    <tr><td>Email:</td><td><?php echo $customer->get('email') ?></td></tr>
    <tr><td>Имя:</td><td><?php echo $customer->get('name') ?></td></tr>
    <tr><td>Телефон:</td><td><?php echo $customer->get('phone') ?></td></tr>
    <tr><td>Адрес доставки:</td><td><?php echo $customer->get('address') ?></td></tr>
    <tr><td>Дополнительная инфомация:</td><td><?php echo $customer->get('notes') ?></td></tr>
  </table>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/change/';?>>Изменить данные</a> | 
  <a href=<?php echo 'http://'.SITE_NAME.'/account/orders/';?>>Информация о заказах</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>Выход</a></p>
</div>
