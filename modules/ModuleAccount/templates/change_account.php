<?php
$customer = $r->get('customer');
$errors = $r->get('errors');
?>
<div class="main_account">
  ���������� � ������������:
  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/account/change';?>">
  <table>
    <tr><td>Email:</td><td><input type=text name=email value='<?php echo $customer->get('email');?>'></td></tr>
    <tr><td>���:</td><td><input type=text name=name value='<?php echo $customer->get('name') ?>'></td></tr>
    <tr><td>�������:</td><td><input type=text name=phone value='<?php echo $customer->get('phone') ?>'></td></tr>
    <tr><td>����� ��������:</td><td><textarea name="address"><?php echo $customer->get('address') ?></textarea></td></tr>
    <tr><td>�������������� ���������:</td><td><textarea name="notes"><?php echo $customer->get('notes') ?></textarea></td></tr>
    <tr><td><input type="submit" name="change" value="���������"></td><td></td></tr>
  </table>
  </form>
  <?php if($errors) :?>
    <?php if($errors['email']) echo '�� ���������� ������ email';?>
    <?php if($errors['name']) echo '�� ���������� ������ �����';?>
    <?php if($errors['phone']) echo '�� ���������� ������ ��������';?>
    <?php if($errors['address']) echo '�� ���������� ������ ������';?>
    <?php if($errors['notes']) echo '�� ���������� ������ �������������� ����������';?>
    <?php if($errors['password']) echo '�� ���������� ������ ������';?>
    <?php if($errors['emailExists']) echo '������� � ����� email ��� ����������';?>
  <?php endif;?>

  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/account/change';?>">
  ����� ������:<input type=password name=password>
  <input type="submit" name="change_password" value="�������� ������">
  </form>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/';?>>�����</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/orders/';?>>���������� � �������</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>�����</a></p>
</div>
