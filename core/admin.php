<?php
function arch_admin() {
	
	$authenticate = new Authenticate();
	
	echo $authenticate->result;
	
	if ( $authenticate->authenticate == 'false' ) { return; }
	
		
	
	
	
}
?>