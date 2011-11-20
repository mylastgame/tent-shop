<?php $customer=$r->get('customer');?>
<div class="main_account">
  <table id="orders">
    <tr><td class="orders">Товар</td><td class="orders">Цена</td><td class="orders">Количество</td><tr>
    <?php foreach($r->get('cartSet')->getPurchases() as $purchase):?>
      <?php echo '<tr><td class="orders">'.$purchase['product']->get('name').'</td><td class="orders">'.$purchase['product']->get('price').'</td><td class="orders">'.$purchase['amount'].'</td></tr>'?>
    <?php endforeach;?>
  </table>
  Общая сумма: <?php echo $r->get('cartSet')->getTotalPrice();?>
  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/cart/';?>">

  <p>
  <p class="tb_padding">Информация для доставки:</p>
  <table>
    <tr><td class="orders">Email:</td><td class="orders"><?php echo $customer->get('email');?></td></tr>
    <tr><td class="orders">Имя:</td><td class="orders"><?php echo $customer->get('name'); ?></td></tr>
    <tr><td class="orders">Телефон:</td><td class="orders"><?php echo $customer->get('phone'); ?></td></tr>
    <tr><td class="orders">Адрес:</td><td class="orders"><?php echo $customer->get('address'); ?></td></tr>
    <tr><td class="orders">Доп. информация:</td><td class="orders"><?php echo $customer->get('notes'); ?></td></tr>
  </table>
  <input type="submit" name="change_order_address" value="Изменить">
  <input type="hidden" name="email" value="<?php echo $customer->get('email');?>">
  <input type="hidden" name="name" value="<?php echo $customer->get('name');?>">
  <input type="hidden" name="phone" value="<?php echo $customer->get('phone');?>">
  <input type="hidden" name="address" value="<?php echo $customer->get('address');?>">
  <input type="hidden" name="notes" value="<?php echo $customer->get('notes');?>">

  </p>
  <p class="tb_padding"> <input type="submit" name="order_done" value="Оформить заказ"></p>
  </form>

</div>
