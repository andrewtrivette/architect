<?php arch_module('Breadcrumb'); ?>

<h1><?php echo $content->name(); ?></h1>

<?php echo $content->content(); ?>

<small>Last Edited: <?php echo $content->metadata['edited']; ?></small>