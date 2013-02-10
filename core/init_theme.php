<?php session_start();
if ($_REQUEST['logout']) {
	session_destroy();
	session_start();
}
//error_reporting(0);

include 'configure.inc';
$type = (isset($_REQUEST['type'])) ? $_REQUEST['type']:'pages';
$page_title = ucwords( str_replace( '_', ' ', basename( $page ) ) );
arch_add_info('page_title', $page_title );
include 'themes/'.$settings['theme'].'/features.php';

foreach ($settings as $name => $value) {
	define(strtoupper($name), $value, true);
}

function __autoload($class_name) {
	if ( file_exists('plugins/'.$class_name . '.php') ) {
    	require_once 'plugins/'.$class_name . '.php';
	} else {
		require_once 'modules/'.$class_name . '.php';
	}
}

include 'themes/'.THEME.'/'.$type.'.php';
?>