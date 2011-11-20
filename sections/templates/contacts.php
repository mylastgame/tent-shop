<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<?php header("Content-Type: text/html; charset=windows-1251"); ?>
<title>Tentorium Shop</title>
<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.SITE_NAME.'/require/css/main.css' ?>">
</head>
<body>
<div id="container">
<!-- Left Panel -->
<div class="left_panel">
<div class="logo_img"><img src="http://tent-shop.z4.ru/img/site/logo.png"></div>
<!-- Load CatalogNavigation module -->
<?php if($response->getModuleResponse('ModuleCatalogNavigation')): ?>
<?php $r = $response->getModuleResponse('ModuleCatalogNavigation'); ?>
<?php require_once SITE_ROOT.$r->getTemplate(); ?>
<?php endif; ?>
<!-- Center -->
</div><div class="main">
<?php require_once(SITE_ROOT.'/require/templates/head.php'); ?>
<!-- Load SectionsNavigation module -->
<?php if($response->getModuleResponse('ModuleSectionsNavigation')): ?>
<?php $r = $response->getModuleResponse('ModuleSectionsNavigation'); ?>
<?php require_once SITE_ROOT.$r->getTemplate(); ?>
<?php endif; ?>
<!-- Load Main Content module -->
<?php if($response->getModuleResponse('ModuleContacts')): ?>
<?php $r = $response->getModuleResponse('ModuleContacts'); ?>
<?php require_once SITE_ROOT.$r->getTemplate(); ?>
<?php endif; ?>
<!-- Right panel-->
</div><div class="right_panel">
<!-- CartFrame modul-->
<?php if($response->getModuleResponse('ModuleCartFrame')): ?>
<?php $r = $response->getModuleResponse('ModuleCartFrame'); ?>
<?php require_once SITE_ROOT.$r->getTemplate(); ?>
<?php endif; ?>
<div class="border_line">
  &nbsp
</div>
<!-- LoginFrame modul-->
<?php if($response->getModuleResponse('ModuleLoginFrame')): ?>
<?php $r = $response->getModuleResponse('ModuleLoginFrame'); ?>
<?php require_once SITE_ROOT.$r->getTemplate(); ?>
<?php endif; ?>
<div class="border_line">
  &nbsp
</div>
<img src="http://<?=SITE_NAME?>/img/site/123.jpg">
</div>
<!-- Bottom -->
<div id="bottom">
Tentorium shop 2011
</div>
</div>
</body>
</html>

