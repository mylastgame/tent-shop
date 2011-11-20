<?php
require_once './require/require.php';

$system = System::getInstance();
$system->handleRequest();
$system->getResponce();
$system->display();
?>