<?php
class Authenticate {
	
	public $authenticate;
	public $result;
	
	function __construct() {
		
		$username = ( isset( $_SESSION['login']['username'] ) ) ? $_SESSION['login']['username']:'';
		$password = ( isset( $_SESSION['login']['password'] ) ) ? md5($_SESSION['login']['password']):'';
		
		$user = USER;
		$pass = PASS;
		
		$this->authenticate = false;
		$this->result = '';

		if ( $username != '' AND $password != '' ) {

			if ( $password == $pass AND $username == $user ) {
			
				$this->result .= '<div class="logout"><a href="'.BASE_URL.'?logout=true" title="Logout" class="button">Logout</a></div>';
				$this->authenticate = true;
			
			} elseif ( !empty( $_POST['login']['username'] ) ) {
				
				if ( isset( $_SESSION['tries'] ) ) { 
					$_SESSION['tries']++;
				} else {
					$_SESSION['tries'] = 1;
				}
				$this->result .= '<h2>Login Incorrect. Login Attempt '.$_SESSION['tries'].' of 3</h2>';
			}
			
		}
			
		if ( $this->authenticate != true ) {
			
			$this->result .= new Form( array( 'template' => 'login', 'file' => 'core/form.xml' ) );
			
			if ( isset( $_SESSION['tries'] ) AND $_SESSION['tries'] >= 3 ) {
				
				$this->result = '<h2>You have exceeded the maximum number of login attempts.</h2>';
			
			}
		}
		
	}
	
	public function __toString() {
        return $this->result;
    }
}
?>