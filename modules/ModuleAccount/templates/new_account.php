<?php $errors=$r->get('errors');?>
<div class="main_account">
  Регистрация нового пользователя:
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/account/new';?>>
    <table>
      <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
      <tr><td>Пароль:</td><td><input type="password" name="password">(Минимум 6 символов, только буквы и цифры)</td></tr>
      <tr><td><input type="submit" name="submit" value="Зарегистрироваться"></td><td></td></tr>
    </table>
  <?php if($errors['email']) echo 'Не правильный формат email!<br>'; ?>
  <?php if($errors['password']) echo 'Не правильный формат пароля!<br>'; ?>
  <?php if($errors['emailExists']) echo 'Аккаунт с таким email уже существует';?>
  </form>
</div>