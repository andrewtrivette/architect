<?
class dynList {
	public $list_result;
	
	function __construct($folder, $list_type, $sort, $attribute, $filetype, $url) {
		// List('content/products', 'ul', 'DESC', '.product_desc', 'html', 'page/products/');
		$select = glob($folder.'/*.'.$filetype);
		if ($sort == 'DESC') {
			rsort($select);
		}
		$css = substr($attribute, 0, 1);
		if ($css == '#') {
			$selector = 'id="'.substr($attribute, 1).'"';
		} elseif ($css == '.') {
			$selector = 'class="'.substr($attribute, 1).'"';
		}
		switch ($list_type) {
			case 'ul':
			case 'ol':
				$list = '<'.$list_type.' '.$selector.'>'.PHP_EOL;
				foreach ($select as $item) {
					$root = basename($item, '.'.$filetype);
					$list .= (!empty($url)) ? '<li><a href="'.$url.$root.'" title="'.self::title_format($root).'">'.self::title_format($root).'</a></li>':'<li>'.self::title_format($root).'</li>'.PHP_EOL;
				}
				$list .= '</'.$list_type.'>'.PHP_EOL;
				break;
			case 'block':
				foreach ($select as $item) {
					$root = basename($item, '.'.$filetype);
					$list .= (!empty($url)) ? '<div '.$selector.'><a href="'.$url.$root.'" title="'.self::title_format($root).'"><span>'.self::title_format($root).'</span></a></div>'.PHP_EOL:'<div class="'.$class.'"><span>'.self::title_format($root).'</span></div>'.PHP_EOL;
				}
				break;
			case 'image':
				foreach ($select as $item) {
					$root = basename($item, '.'.$filetype);
					$list .= (!empty($url)) ? '<div '.$selector.'><a href="'.$url.$root.'" title="'.self::title_format($root).'"><img src="images/'.$item.'.jpg" alt="'.self::title_format($root).'" /><br /><span>'.self::title_format($root).'</span></a></div>'.PHP_EOL:'<div class="'.$class.'"><img src="images/'.$item.'.jpg" alt="'.self::title_format($root).'" /><br /><span>'.self::title_format($root).'</span></div>'.PHP_EOL;
				}
				break;
		}
		return $this->list_result = $list;
	}
	
	function title_format($string) {
		$title = ucwords(str_replace('_', ' ', $string));
		return $title;
	}
	
	public function __toString() {
        return $this->list_result;
    }
}
?>