<?php $errors = $r->get('errors'); ?>
<div class="LoginFrame">
���� ��� �������������:
<form method="POST" action=<?php echo 'http://'.SITE_NAME.Request::getInstance()->getUri();?>>
<p><span id="email">Email:</span><input type="text" name="email_lframe" size="15"></p>
<p>������:<input type="password" name="password_lframe" size="15"></p>
<p><input type="submit" name="login_lframe" value="����"></p>
</form>
<?php if($errors['email']) echo '�� ���������� ������ email!<br>'; ?>
<?php if($errors['password']) echo '�� ���������� ������ ������!<br>'; ?>
<?php if($errors['unknownEmail']) echo '�� ���������� email ��� ������!<br>'; ?>
<?php if($errors['badPassword']) echo '�� ���������� email ��� ������!<br>'; ?>
</div>