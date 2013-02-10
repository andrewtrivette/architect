<?php 
$args = array( 
	'folder' => 'content', 
	'attribute' => '.menu', 
	'filetype' => 'html', 
	'url' => 'page/', 
	'depth' => '1'
);
echo arch_module('Menu', $args ); ?>
<br />&copy;<?php echo (date("Y") > YEAR) ? YEAR.'-'.date("Y"):YEAR; ?> 
<?php 
echo COMPANY. ' | Design by: ';
echo (defined('DESIGNER_URL')) ? '<a href="'.DESIGNER_URL.'" target="_blank">'.DESIGNER.'</a>':DESIGNER; 
?>