<div class="main_account">
  <p class="small_title">���������� � ����� �������.</p>
  <table id="orders">
    <tr><td class="orders">ID:</td><td class="orders">����� ������:</td><td class="orders">����:</td><td class="orders">���������:</td><td></td></tr>
  <?php foreach ($r->get('orders') as $order):?>
    <?php echo '<tr><td class="orders">'.$order->get('id').
               '</td><td class="orders">'.$order->get('total_price').
               '�</td><td class="orders">'.date('d.m.y', $order->get('date')).
               '</td><td class="orders">'.$order->get('state').
               '</td><td class="orders"><a href=http://'.SITE_NAME.'/account/orders/'.$order->get('id').'>���������</a></td></tr>';?>
  <?php endforeach;?>
  </table>
  <p id="account_nav">
  <a href=<?php echo 'http://'.SITE_NAME.'/account/';?>>�����</a> |
  <a href=<?php echo 'http://'.SITE_NAME.'/account/logout/';?>>�����</a></p>
</div>