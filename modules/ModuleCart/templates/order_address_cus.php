<?php $errors=$r->get('errors');?>
<?php $customer=$r->get('customer');?>
<div class="main_account">
  ���������� ��� ��������:
  <form method="POST" action=<?php echo 'http://'.SITE_NAME.'/cart/order';?>>
    <table>
      <tr><td>Email:</td><td><input type="text" name="email" value="<?php echo $customer->get('email');?>"></td></tr>
      <tr><td>���:</td><td><input type="text" name="name" value="<?php echo $customer->get('name'); ?>"></td></tr>
      <tr><td>�������:</td><td><input type="text" name="phone" value="<?php echo $customer->get('phone'); ?>"></td></tr>
      <tr><td>�����:</td><td><textarea name="address"><?php echo $customer->get('address'); ?></textarea></td></tr>
      <tr><td>���. ����������:</td><td><textarea name="notes"><?php echo $customer->get('notes'); ?></textarea></td></tr>
      <tr><td><input type="submit" name="check_address" value="����������"></td><td></td></tr>
    </table>
  </form>
  <?php if($errors['email']) echo '�� ���������� ������ email!<br>'; ?>
  <?php if($errors['name']) echo '�� ���������� ������ �����!<br>'; ?>
  <?php if($errors['phone']) echo '�� ���������� ������ ��������!<br>'; ?>
  <?php if($errors['address']) echo '�� ���������� ������ ������!<br>'; ?>
  <?php if($errors['notes']) echo '�� ���������� ������ �������������� ����������!<br>'; ?>
  <?php if($errors['email']) echo 'Email ���������� ��� ���������� !<br>'; ?>
  <?php if($errors['name']) echo '��� ����������� ��� ���������� !<br>'; ?>
  <?php if($errors['phone']) echo '������� ���������� ��� ���������� !<br>'; ?>
  <?php if($errors['address']) echo '����� ���������� ��� ���������� !<br>'; ?>
</div>