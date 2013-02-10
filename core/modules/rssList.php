<?
class xmlInclude {
	
	public $xml_result;
	
	function __construct($template, $attribute) {
		$s = simplexml_load_file($template);
		$css = substr($attribute, 0, 1);
		if ($css == '#') {
			$selector = 'id="'.substr($attribute, 1).'"';
		} elseif ($css == '.') {
			$selector = 'class="'.substr($attribute, 1).'"';
		}
		$list = '<dl '.$selector.'>'.PHP_EOL;
		$list .= '<h3>'.$s->channel[0]->title.'</h3>'.PHP_EOL;
		foreach ($s->channel->item as $item) {
			$list .= '<dt>'.$item->title.'</dt>'.PHP_EOL;
			$list .= '<dd>'.$item->description.'</dd>'.PHP_EOL;
		}
		$list .= '</dl>'.PHP_EOL;
		$this->xml_result = $list;
	}
	
	function __toString() {
		return $this->xml_result;
	}
}
?>
