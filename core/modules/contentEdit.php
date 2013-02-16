<?php
class contentEdit {
	public $content;
	public $id;
		
	function __construct($content) {
		self::form($content);
	}
	
	function content($content) {
		$this->content = '<textarea name="content_'.$content->id.'[content]" id="cleditor" rows="'.( $content->lineNumbers()*2.5 ).'" class="editor">'.htmlspecialchars($content->content()).'</textarea>'.PHP_EOL;
		return $this->content;
	}
	
	function name($name) {
		$this->name = '<input type="text" name="content_'.self::fileName($name).'[name]" class="name" value="'.self::properName($name).'" />';
		return $this->name;
	}
	
	function form($content) {
		$this->result = '<form action="" method="post" class="content_editor">';
		$this->result .= '<p><b>Content</b>:<br />'.self::content($content).'</p>';
		$this->result .= '<p><b>Page Name:</b> '.self::name($content->id).'</p>';
		$this->result .= '</form>';
		return $this->result;
	}
	
	function fileName($name) {
		return strtolower( str_replace( ' ', '_', $name ) );
	}
	
	function properName($name) {
		return ucwords( str_replace( '_', ' ', $name ) );
	}
		
	function __toString() {
		return $this->result;
		
	}
}
?>