<div class="main_account">
  <form method="POST" action="<?php echo 'http://'.SITE_NAME.'/cart/'?>">
  <table id="orders">
    <tr><td class="orders">�����</td><td class="orders">����</td><td class="orders">����������</td><td class="orders">�������</td><tr>
    <?php foreach($r->get('cartSet')->getPurchases() as $purchase):?>
      <?php echo '<tr><td class="orders">'.$purchase['product']->get('name').'</td><td class="orders">'.$purchase['product']->get('price').'�</td>'?>
      <?php echo '<td class="orders"><input type=text size="1" value='.$purchase['amount'].' name=amount['.$purchase['product']->get('id').']></td>'?>
      <td class="orders"><input type="checkbox" name="delete[<?php echo $purchase['product']->get('id')?>]"></td></tr>
    <?php endforeach;?>
  </table>
  ����� �����: <?php echo $r->get('cartSet')->getTotalPrice();?>
  <p class="tb_padding">
    <input type="submit" value="��������" name="change_cart">
    <input type="submit" value="�������� �������" name="clear_cart">
  </form>
  </p>
  <p><a href=<?php echo 'http://'.SITE_NAME.'/cart/order/'?>>�������� �����</a></p>
</div>
