<?php
$customer = $r->get('customer');
$errors = $r->get('errors');
?>
<div class="main_account">
  Информация о пользователе:
  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/account/change';?>">
  <table>
    <tr><td>Email:</td><td><input type=text name=email value='<?php echo $customer->get('email');?>'></td></tr>
    <tr><td>Имя:</td><td><input type=text name=name value='<?php echo $customer->get('name') ?>'></td></tr>
    <tr><td>Телефон:</td><td><input type=text name=phone value='<?php echo $customer->get('phone') ?>'></td></tr>
    <tr><td>Адрес доставки:</td><td><textarea name="address"><?php echo $customer->get('address') ?></textarea></td></tr>
    <tr><td>Дополнительная инфомация:</td><td><textarea name="notes"><?php echo $customer->get('notes') ?></textarea></td></tr>
    <tr><td><input type="submit" name="change" value="Сохранить"></td><td></td></tr>
  </table>
  </form>
  <?php if($errors) :?>
    <?php if($errors['email']) echo 'Не правильный формат email';?>
    <?php if($errors['name']) echo 'Не правильный формат имени';?>
    <?php if($errors['phone']) echo 'Не правильный формат телефона';?>
    <?php if($errors['address']) echo 'Не правильный формат адреса';?>
    <?php if($errors['notes']) echo 'Не правильный формат дополнительной информации';?>
    <?php if($errors['password']) echo 'Не правильный формат пароля';?>
    <?php if($errors['emailExists']) echo 'Аккаунт с таким email уже существует';?>
  <?php endif;?>

  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/account/change';?>">
  Новый пароль:<input type=password name=password>
  <input type="submit" name="change_password" value="Изменить пароль">
  </form>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/';?>>Назад</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/orders/';?>>Информация о заказах</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>Выход</a></p>
</div>
