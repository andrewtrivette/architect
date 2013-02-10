<?
class Menu {
	public $result;
	
	function __construct($args) {
		extract( $args );
		$page = $_REQUEST['page'];
		// Menu('content', '.menu', 'html', 'page/', '1');
		$css = substr($attribute, 0, 1);
		if ($css == '#') {
			$selector = ' id="'.substr($attribute, 1).'"';
		} elseif ($css == '.') {
			$selector = ' class="'.substr($attribute, 1).'"';
		} else {
			$selector = '';
		}
		$select = glob($folder.'/*.'.$filetype);
		
		$menu = '<ul'.$selector.'>'.PHP_EOL;
		$menu .= ($page != 'home') ? '<li><a href="page/home" title="Home">Home</a></li>'.PHP_EOL:'<li><span>Home</span></li>'.PHP_EOL;
			foreach ($select as $item) {
				$root = basename($item, '.'.$filetype);
				if ($root != "home") {
					$menu .= ($root != $page) ? '<li><a href="'.$url.$root.'" title="'.self::title_format($root).'">'.self::title_format($root).'</a>':'<li><span>'.self::title_format($root).'</span>';
				}
			
			if ($depth == '2' && is_dir($folder.'/'.$root)) {
				$menu .= '<ul>'.PHP_EOL;
				foreach (glob($folder.'/'.$root.'/*.'.$filetype) as $sub_item) {
					$sub_root = basename($sub_item, '.'.$filetype);
					$menu .= ($root.'/'.$sub_root != $page) ? '<li><a href="'.$url.$root.'/'.$sub_root.'" title="'.self::title_format($sub_root).'">'.self::title_format($sub_root).'</a></li>'.PHP_EOL:'<li>'.self::title_format($sub_root).'</li>'.PHP_EOL;
				}
				$menu .= '</ul>'.PHP_EOL;
			}
			$menu .= '</li>'.PHP_EOL;
		}	
		$menu .= '</ul>'.PHP_EOL;
		return $this->result = $menu;
	}
	
	function title_format($string) {
		$title = ucwords(str_replace('_', ' ', $string));
		return $title;
	}
	
	function __toString() {
		return $this->result;
	}
}
?>