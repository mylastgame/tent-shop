<?php $errors=$r->get('errors');?>
<div class="main_account">
  Информация для доставки:
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/cart/order';?>>
    <table>
      <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
      <tr><td>Имя:</td><td><input type="text" name="name"></td></tr>
      <tr><td>Телефон:</td><td><input type="text" name="phone"></td></tr>
      <tr><td>Адрес:</td><td><textarea name="address"></textarea></td></tr>
      <tr><td>Доп. информация:</td><td><textarea name="notes"></textarea></td></tr>
      <tr><td><input type="submit" name="check_address" value="Продолжить"></td><td></td></tr>
    </table>
  </form>
  <?php if($errors['email']) echo 'Не правильный формат email!<br>'; ?>
  <?php if($errors['name']) echo 'Не правильный формат имени!<br>'; ?>
  <?php if($errors['phone']) echo 'Не правильный формат телефона!<br>'; ?>
  <?php if($errors['address']) echo 'Не правильный формат адреса!<br>'; ?>
  <?php if($errors['notes']) echo 'Не правильный формат дополнительной информации!<br>'; ?>
  <?php if($errors['emptyEmail']) echo 'Email обязателен для заполнения !<br>'; ?>
  <?php if($errors['emptyName']) echo 'Имя обязательно для заполнения !<br>'; ?>
  <?php if($errors['emptyPhone']) echo 'Телефон обязателен для заполнения !<br>'; ?>
  <?php if($errors['emptyAddress']) echo 'Адрес обязателен для заполнения !<br>'; ?>
</div>