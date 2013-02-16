<?php
class Content {
	
	public $id; //page name
	public $type; //page type
	public $slug; //url fragment page type / page name
	public $filename; //slug with .html file extension
	public $name; //proper formatted name
	public $path;
	public $content;
	public $metadata;
	
	public function __construct( $page, $authenticate ) {
		$this->id = basename($page['id']);
		$this->path = $page['id'];
		$this->type = $page['type'];
		$this->slug = $this->type.'/'.$this->path;
		$this->filename = 'content/'.$this->slug.'.html';
		$this->metadata = self::getMetadata();
		if ( $authenticate->authenticate == true ) {
			$this->content = self::editor();
		} else {
			$this->content = self::content();
		}
	}
	
	public function children( $id ) {
		
	}
	
	public function name() {
		$this->name = ucwords( str_replace( '_', ' ', $this->id ) );
		return $this->name;
	}
	
	public function content() {
		if ( is_file( $this->filename ) ) {
			ob_start();
			include $this->filename;
			return ob_get_clean();
		}
		return $filename;
	}
	
	public function lineNumbers() {
		return substr_count( $this->content(), "\n" );
	}
	
	public function editor() {
		$editor = new contentEdit($this);
		return $editor;
	}
	
	public function getMetadata() {
		$edited = filemtime( $this->filename );
		$metadata['edited'] = date('F j, Y g:ia', $edited);
		$file = pathinfo( $this->filename );
		$metadata['extension'] = $file['extension'];
		return $metadata;
	}
	
	public function __toString() {
		return $this->content;
	}

}
?>