<?php $errors = $r->get('errors'); ?>
<div class="main_account">
  <p>Вход в личный кабинет:</p>
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/account/'; ?>>
  <span id="email">Email:</span><input type="text" name="email"><br/>
  Пароль:<input type="password" name="password"><br/>
  <input type="submit" name="login" value="Войти"><br/>
  </form>
  <?php if($errors) :?>
    <?php if($errors['email']) echo 'Не правильный формат email!<br>'; ?>
    <?php if($errors['password']) echo 'Не правильный формат пароля!<br>'; ?>
    <?php if($errors['unknownEmail']) echo 'Не правильный email или пароль!<br>'; ?>
    <?php if($errors['badPassword']) echo 'Не правильный email или пароль!<br>'; ?>
  <?php endif;?>
  <a href=<?php echo 'http://'.SITE_NAME.'/account/new'; ?>>Регистрация</a> нового пользователя
</div>