<?
class Breadcrumb {
	public $result;
	
	function __construct($separator, $attribute) {
		// Breadcrumb('>', '.breadcrumb');
		global $page;
		$css = substr($attribute, 0, 1);
		if ($css == '#') {
			$selector = 'id="'.substr($attribute, 1).'"';
		} elseif ($css == '.') {
			$selector = 'class="'.substr($attribute, 1).'"';
		}
		
		$links = explode('/', $page);
		$current_page = array_pop($links);
		$breadcrumb = '<div '.$css.'><a href="page/home">Home</a> '.$separator.' ';
		foreach ($links as $item) {
			$url .= '/'.$item;
			$breadcrumb .= '<a href="page'.$url.'">'.self::title_format($item).'</a> '.$separator.' ';
		}
		$breadcrumb .= self::title_format($current_page).'</div>'.PHP_EOL;
		if ($page != 'home') {
			return $this->result = $breadcrumb;
		} else {
			return $this->result = '';
		}
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