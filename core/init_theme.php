<?php session_start();
if (isset($_REQUEST['logout'])) {
	session_destroy();
	session_start();
}
//error_reporting(0);
$constants = file_get_contents('configure.inc');
arch_add_info($constants);

@include THEME.'/features.php';

$user = new Authenticate();
$user->isLoggedIn = false; //Overrides the Authenticate login

$data = ( isset( $_REQUEST['id'] ) ) ? $_REQUEST:array('type' => 'page', 'id' => 'home');
$content = new Content( $data, $user );

include THEME.'/'.$content->type.'.php';
?>