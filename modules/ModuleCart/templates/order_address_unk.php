<?php $errors=$r->get('errors');?>
<div class="main_account">
  ���������� ��� ��������:
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/cart/order';?>>
    <table>
      <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
      <tr><td>���:</td><td><input type="text" name="name"></td></tr>
      <tr><td>�������:</td><td><input type="text" name="phone"></td></tr>
      <tr><td>�����:</td><td><textarea name="address"></textarea></td></tr>
      <tr><td>���. ����������:</td><td><textarea name="notes"></textarea></td></tr>
      <tr><td><input type="submit" name="check_address" value="����������"></td><td></td></tr>
    </table>
  </form>
  <?php if($errors['email']) echo '�� ���������� ������ email!<br>'; ?>
  <?php if($errors['name']) echo '�� ���������� ������ �����!<br>'; ?>
  <?php if($errors['phone']) echo '�� ���������� ������ ��������!<br>'; ?>
  <?php if($errors['address']) echo '�� ���������� ������ ������!<br>'; ?>
  <?php if($errors['notes']) echo '�� ���������� ������ �������������� ����������!<br>'; ?>
  <?php if($errors['emptyEmail']) echo 'Email ���������� ��� ���������� !<br>'; ?>
  <?php if($errors['emptyName']) echo '��� ����������� ��� ���������� !<br>'; ?>
  <?php if($errors['emptyPhone']) echo '������� ���������� ��� ���������� !<br>'; ?>
  <?php if($errors['emptyAddress']) echo '����� ���������� ��� ���������� !<br>'; ?>
</div>