<?php $errors = $r->get('errors'); ?>
<div class="main_account">
  <p>���� � ������ �������:</p>
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/account/'; ?>>
  <span id="email">Email:</span><input type="text" name="email"><br/>
  ������:<input type="password" name="password"><br/>
  <input type="submit" name="login" value="�����"><br/>
  </form>
  <?php if($errors) :?>
    <?php if($errors['email']) echo '�� ���������� ������ email!<br>'; ?>
    <?php if($errors['password']) echo '�� ���������� ������ ������!<br>'; ?>
    <?php if($errors['unknownEmail']) echo '�� ���������� email ��� ������!<br>'; ?>
    <?php if($errors['badPassword']) echo '�� ���������� email ��� ������!<br>'; ?>
  <?php endif;?>
  <a href=<?php echo 'http://'.SITE_NAME.'/account/new'; ?>>�����������</a> ������ ������������
</div>