<div class="main_index">
<p id="catalog_string">Каталог:</p>
<?php foreach($r->get('categories') as $category):?>
  <?php echo '<p class="catalog_category"><img src="'.$category->getImg().'"><br><a href='.$category->getUrl().'>'.$category->get('name').'</a></p>'; ?>
<?php endforeach;?>
</div>