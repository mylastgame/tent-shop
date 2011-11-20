<div class="border_line">&nbsp</div>
<div class="SectionsNavigation">  
  <?php foreach($r->get('sections') as $section):?>
  <?php if($section->get('display') == 1):?>  
    <?php if($section->get('id') == $r->get('current_section')->get('id')):?>
      <?php echo '<img src="'.SITE_IMG_URL.'nav_back.png"><p class="SectionsNavigation"><a href="'.$section->getUrl().'">'.$section->get('title').'</a></p>';?>
      <?php continue;?>
    <?php endif; ?>
    <?php echo '<img src="'.SITE_IMG_URL.'nav_back.png"><p class="SectionsNavigation"><a href="'.$section->getUrl().'">'.$section->get('title').'</a></p>';?>
  <?php endif; ?>
  <?php endforeach; ?>
</div>
<div class="border_line">&nbsp</div>