<div class="categories">
<p class="title">опндсйрш</p>
<?php foreach($r->get('categories') as $category): ?>
<p class="category"><a href="<?php echo $category->getUrl(); ?>"><?php echo $category->get('name');?></a></p>
<?php endforeach;?>
</div>