This is main template!
<div id='index'>
<?php if($response->get_module_response('Index')): ?>
<?php $r = $response->get_module_response('Index'); ?>
<?php require_once SITE_ROOT.$r->get_template(); ?>
<?php endif; ?>
</div>

<div id='404'>
<?php if($response->get_module_response('404')): ?>
<?php $r = $response->get_module_response('404'); ?>
<?php require_once SITE_ROOT.$r->get_template(); ?>
<?php endif; ?>
</div>

<div id='CatalogNavigation'>
  This is CatalogNavigation
<?php if($response->get_module_response('CatalogNavigation')): ?>
<?php $r = $response->get_module_response('CatalogNavigation'); ?>
<?php require_once SITE_ROOT.$r->get_template(); ?>
<?php endif; ?>
</div>

<div id='LoginFrame'>
  This is LoginFrame
<?php if($response->get_module_response('LoginFrame')): ?>
<?php $r = $response->get_module_response('LoginFrame'); ?>
<?php require_once SITE_ROOT.$r->get_template(); ?>
<?php endif; ?>
</div>

<?php ?>
<?php ?>
<?php ?>
<?php ?>

