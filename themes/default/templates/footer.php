<nav class="menu">
<?php arch_module('Menu', array( 'type' => $content->type, 'id' => $content->id ) ); ?>
</nav>
<br />&copy;<?php echo (date("Y") > YEAR) ? YEAR.'-'.date("Y"):YEAR; ?> 
<?php 
echo COMPANY. ' | Design by: ';
echo (defined('DESIGNER_URL')) ? '<a href="'.DESIGNER_URL.'" target="_blank">'.DESIGNER.'</a>':DESIGNER; 
?>