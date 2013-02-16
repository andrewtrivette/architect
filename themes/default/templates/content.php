<div class="grid_12"><?php arch_module('Breadcrumb', array('separator' => '')); ?></div>
<div class="clear"></div>
<div class="grid_6"><h1><?php echo $content->name; ?></h1></div>
<div class="grid_6"><small>Last Edited: <?php echo $content->metadata['edited']; ?></small></div>
<div class="clear"></div>
<?php echo $content->content; ?>
<p>&nbsp;</p>
<div class="grid_12"><?php arch_module('Breadcrumb', array('separator' => '')); ?></div>

