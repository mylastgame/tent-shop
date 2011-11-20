<?php
require_once '/var/www/vhosts/tent-shop.z4.ru/system/DB.class.php';
require_once '/var/www/vhosts/tent-shop.z4.ru/require/require.php';
echo DB::getInstance()->select_query('SELECT MAX(id) FROM products', 'single');
?>
