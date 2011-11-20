<?php
$customer = $r->get('customer');
?>
<div class="LoginFrame">
Здравствуйте, <?php echo $customer->get('name');?>
</div>
