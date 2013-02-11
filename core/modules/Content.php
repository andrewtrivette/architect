<?php
class Content {
	
	public $id;
	public $type;
	public $slug;
	public $filename;
	public $name;
	public $path;
	public $content;
	public $metadata;
	
	public function __construct( $page ) {
		$this->id = basename($page['id']);
		$this->path = $page['id'];
		$this->type = $page['type'];
		$this->slug = $this->type.'/'.$this->path;
		$this->filename = 'content/'.$this->slug.'.html';
		$this->metadata = self::getMetadata();
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
	
	public function getMetadata() {
		$edited = filemtime( $this->filename );
		$metadata['edited'] = date('F j, Y g:ia', $edited);
		$file = pathinfo( $this->filename );
		$metadata['extension'] = $file['extension'];
		return $metadata;
	}

}
?>