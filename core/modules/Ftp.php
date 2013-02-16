<?php
class Ftp {

	public $result;
	public $ftp_loc;
	
	function __construct() { //tested
		//Connect
		$s = simplexml_load_file('../modules/sites.inc');
		$ftp_info = $s->xpath("//site[@id = '".$_SESSION['name']."']");
		
		$this->ftp_loc = ftp_connect($ftp_info[0]->ftp_url);
		$ftp_login = ftp_login($this->ftp_loc, $ftp_info[0]->ftp_user, $ftp_info[0]->ftp_pass);
		if ($ftp_info[0]->ftp_user != '') {
		ftp_chdir($this->ftp_loc, $ftp_info[0]->ftp_root);
		}
		if ((!$this->ftp_loc) || (!$ftp_login)) {
			return 'Failed to connect to '.$ftp_info[0]->ftp_name.' for user: '.$ftp_info[0]->ftp_user;
		} else {
			return 'Login Successful!';
		}
	}
	
	public function download($file) { //tested
		$dir = ftp_pwd($this->ftp_loc);
		if(!is_dir("users/".$_SESSION['info']['user_id'].$dir)) {
			$dir_list = explode('/', $dir);
			foreach ($dir_list as $list) {
				$list_full .= $list.'/';
				mkdir("users/".$_SESSION['info']['user_id'].$list_full, 0777);
			}
		}
		if (ftp_get($this->ftp_loc, "users/".$_SESSION['info']['user_id'].$dir.'/'.$file, $file, FTP_BINARY)) {
    		return $dir.'/'.$file.' Downloaded Successfully!';
		}
	}
	
	public function upload($file) { //tested
		$dir = ftp_pwd($this->ftp_loc);
		if(ftp_put($this->ftp_loc, $file, "users/".$_SESSION['info']['user_id'].'.txt', FTP_BINARY)) {
			return $file.' Uploaded Successfully!';
		}
	}
	
	public function new_file($filename) { //tested
		$dir = ftp_pwd($this->ftp_loc);
		$file = "users/".$_SESSION['info']['user_id'].'txt';
		if(!file_exists($file)) {
			file_put_contents($file, 'New File');
			self::upload($filename);
			unlink($file);
			return $filename.' Created Successfully!';
		} else {
			return 'File Already Exists';
		}
	}
	
	public function change_dir($new_dir) { //tested
		if (ftp_chdir($this->ftp_loc, $new_dir)) {
			return $new_dir;
		}
	}
	
	public function ftp_is_dir($dir) {
  		if (ftp_chdir($this->ftp_loc, basename($dir))) {
    		ftp_chdir($this->ftp_loc, '..');
    		return true;
  		} else {
    		return false;
  		}
	}

	public function file_list($class) {  //tested
		$list = ftp_nlist($this->ftp_loc, '.');
		$files = '<ul class="'.$class.'">'.PHP_EOL;
		sort($list);
		foreach ($list as $item) {
			if ($item != '.' AND $item != '..') {
				if (self::ftp_is_dir($item)) {
					$folders .= '<li><a href="file_browser.php?name='.$_SESSION['name'].'&dir='.$_SESSION['dir'].'/'.$item.'">'.$item.'</a></li>'.PHP_EOL;
				} else {
					$file .= '<li>|_<a href="page/edit?name='.$_SESSION['name'].'&dir='.$_SESSION['dir'].'&file='.$item.'" target="_parent">'.$item.'</a></li>'.PHP_EOL;
				}
			}
		}
		$files .= $folders.$file;
		$files .= '</ul>'.PHP_EOL;
		return $files;
	}
	
	public function __toString() {
        return $this->result;
    }
}
?>