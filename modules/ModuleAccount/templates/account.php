<?php $customer = $r->get('customer');?>
<div class="main_account">
  ���������� � ������������:
  <table>
    <tr><td>Email:</td><td><?php echo $customer->get('email') ?></td></tr>
    <tr><td>���:</td><td><?php echo $customer->get('name') ?></td></tr>
    <tr><td>�������:</td><td><?php echo $customer->get('phone') ?></td></tr>
    <tr><td>����� ��������:</td><td><?php echo $customer->get('address') ?></td></tr>
    <tr><td>�������������� ���������:</td><td><?php echo $customer->get('notes') ?></td></tr>
  </table>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/change/';?>>�������� ������</a> | 
  <a href=<?php echo 'http://'.SITE_NAME.'/account/orders/';?>>���������� � �������</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>�����</a></p>
</div>
