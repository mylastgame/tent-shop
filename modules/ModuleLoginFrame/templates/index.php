<?php $errors = $r->get('errors'); ?>
<div class="LoginFrame">
Вход для пользователей:
<form method="POST" action=<?php echo 'http://'.SITE_NAME.Request::getInstance()->getUri();?>>
<p><span id="email">Email:</span><input type="text" name="email_lframe" size="15"></p>
<p>Пароль:<input type="password" name="password_lframe" size="15"></p>
<p><input type="submit" name="login_lframe" value="Вход"></p>
</form>
<?php if($errors['email']) echo 'Не правильный формат email!<br>'; ?>
<?php if($errors['password']) echo 'Не правильный формат пароля!<br>'; ?>
<?php if($errors['unknownEmail']) echo 'Не правильный email или пароль!<br>'; ?>
<?php if($errors['badPassword']) echo 'Не правильный email или пароль!<br>'; ?>
</div>