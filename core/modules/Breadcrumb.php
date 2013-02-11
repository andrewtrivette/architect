<?
class Breadcrumb {
	public $result;
	
	function __construct($args = array(), $content) {
		extract( $args );
		$page = $content->id;
		$type = $content->type;
		$separator = ( isset( $separator ) ) ? $separator:'>';
		$attribute = ( isset( $attribute ) ) ? $attribute:'.breadcrumb';
		$css = substr($attribute, 0, 1);
		if ($css == '#') {
			$selector = 'id="'.substr($attribute, 1).'"';
		} elseif ($css == '.') {
			$selector = 'class="'.substr($attribute, 1).'"';
		}
		
		$links = explode('/', $page);
		$current_page = array_pop($links);
		$breadcrumb = '<div '.$selector.'><a href="'.$type.'/home">Home</a> '.$separator.' ';
		$url = '';
		foreach ($links as $item) {
			$url .= '/'.$item;
			$breadcrumb .= '<a href="'.$type.'/'.$url.'">'.self::title_format($item).'</a> '.$separator.' ';
		}
		$breadcrumb .= '<span class="current_page">'.self::title_format($current_page).'</span></div>'.PHP_EOL;
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