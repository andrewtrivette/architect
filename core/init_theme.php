<?php session_start();
if (isset($_REQUEST['logout'])) {
	session_destroy();
	session_start();
}
//error_reporting(0);

include 'configure.inc';
$type = (isset($_REQUEST['type'])) ? $_REQUEST['type']:'pages';
$page = (isset($_REQUEST['page'])) ? $_REQUEST['page']:'home';
$page_title = ucwords( str_replace( '_', ' ', basename( $page ) ) );
arch_add_info('page_title', $page_title );
include 'themes/'.$settings['theme'].'/features.php';

arch_set_constants($settings);

function __autoload($class_name) {
	if ( file_exists('plugins/'.$class_name . '.php') ) {
    	require_once 'plugins/'.$class_name . '.php';
	} else {
		require_once 'modules/'.$class_name . '.php';
	}
}
$page = array('type' => 'page', 'id' => 'home');
$data = ( isset( $_REQUEST['id'] ) ) ? $_REQUEST:$page;
$content = new Content( $data );
include 'themes/'.THEME.'/'.$content->type.'.php';
?>