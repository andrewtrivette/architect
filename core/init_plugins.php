<?php
foreach ( glob('plugins/*') as $plugin ) {
	include $plugin.'/index.php';
}

?>