<?php $errors=$r->get('errors');?>
<div class="main_account">
  ����������� ������ ������������:
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/account/new';?>>
    <table>
      <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
      <tr><td>������:</td><td><input type="password" name="password">(������� 6 ��������, ������ ����� � �����)</td></tr>
      <tr><td><input type="submit" name="submit" value="������������������"></td><td></td></tr>
    </table>
  <?php if($errors['email']) echo '�� ���������� ������ email!<br>'; ?>
  <?php if($errors['password']) echo '�� ���������� ������ ������!<br>'; ?>
  <?php if($errors['emailExists']) echo '������� � ����� email ��� ����������';?>
  </form>
</div>