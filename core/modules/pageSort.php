<?php
class pageSort {
	public $result;
	
	function __construct() {
	
	}
	
	function display($select) {
		
		function recurse($directory) {
			$dir = glob($directory.'/*');
			$menu1 = ''; 
			foreach ($dir as $folder) {
				$path = pathinfo($folder);
				$name = basename($folder);
				$id = basename($folder, $path['extension']);
				if(is_dir($folder)) {   
					 $menu1 .= "\t".'<li class="folder" id="'.$name.'"><div class="label"><img src="images/folder.png" /></div><input type="text" size="30" maxlength="40" name="data[]" value="'.ucwords(str_replace('_', ' ', $name)).'" />'.PHP_EOL;
					 $menu1 .= '<ul id="folder'.rand().'" class="connected"><li class="spacer"></li>'.PHP_EOL;
					 //$menu1 .= '<p>'.ucwords(str_replace('_', ' ', $root)).'</p>';
					 $menu1 .= recurse($folder);
					 $menu1 .= '</ul></li>'.PHP_EOL;
				} else {
					 
					 $menu1 .= "\t".'<li class="page" id="'.$name.'"><div class="ajax"><span class="editing"><img src="images/arrow_right.png" align="right" style="margin-left:5px;" /></span>Edit<span class="editing">ing </span></div><div class="label"><img src="images/page.png" align="left" /></div><input type="hidden" name="data[]" value="'.$name.'" size="40" maxlength="50" />'.$name.'</li>'.PHP_EOL;
				}
			}
			return $menu1;
		}
		
		$menu = recurse($select);	
		return $this->result = $menu;
	}
	
	function save() {
		global $page;
		global $s;
		global $filename;
		global $response;
		unset($s->menu);
		$menu = $s->addChild('menu', '');
		
		function recursive_nodes($node, $parent_node) {
			global $s;
			foreach ($node as $key => $value) {
				$id_temp = new Sanitize();
				$id = $id_temp->string_sanitize($key);
				
				if (is_array($value)) {
					$folder = $parent_node->addChild('folder', '');
					$folder->addAttribute('id', $id);
					$folder->addAttribute('name', $id);
					recursive_nodes($value, $folder);
				} else {
					if ($value != '') {
					$content_temp = new Sanitize();
					$content = $content_temp->string_sanitize($value);
					$page1 = $s->xpath('//pages/page[@id = "'.$id.'"]');
					if ((string)$page1[0]->title == '') {
						$new_page = $s->pages->addChild('page', '');
						$new_page->addAttribute('id', $id);
						$new_page->addChild('title', $content);
					}
					$page1[0]->title = $value;
					$page = $parent_node->addChild('page', '');
					$page->addAttribute('id', $id);
					$page->addAttribute('name', $content);
					}
				}
			}
		}
		recursive_nodes($_REQUEST['data'], $menu);
	
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($s->asXML());
		if (!file_put_contents($filename, $dom->saveXML())) {
			$response = '<div class="error">There was a problem saving your changes</div>';
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