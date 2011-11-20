<?php $order = $r->get('order');?>
<div class="main_account">
  <p class="small_title">���������� � ������ ID:<?php echo $order->get('id')?></p>
  <p class="tb_padding">���� ������: <?php echo date('d.m.y', $order->get('date'));?><br>
  ��������� ������: <?php echo $order->get('state');?></p>
  <p>������ �������:</p>
  <table id="orders">
    <tr><td class="orders">��������</td><td class="orders">����</td><td class="orders">����������</td></tr>
    <?php foreach($r->get('cartSet')->getPurchases() as $purchase):?>
     <tr><td class="orders"><?php echo $purchase['product']->get('name');?></td>
     <td class="orders"><?php echo $purchase['product']->get('price');?>�.</td>
     <td class="orders"><?php echo $purchase['amount'];?></td></tr>
    <?php endforeach;?>
  </table>
  ����� ����� ������: <?php echo $order->get('total_price');?>�.
  <p class="tb_padding">���������� �� ��������:</p>
  ���: <?php echo $order->get('name');?><br>
  email: <?php echo $order->get('email');?><br>
  �������: <?php echo $order->get('phone');?><br>
  �����: <?php echo $order->get('address');?><br>
  ���. ����������: <?php echo $order->get('notes');?><br>
  <p id="account_nav"><a href="http://<?php echo SITE_NAME?>/account/orders/">�����</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>�����</a>
  </p>
</div>