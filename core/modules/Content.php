<?php
class Content {
	
	public $id;
	public $type;
	public $slug;
	public $filename;
	public $name;
	public $content;
	public $metadata;
	
	public function __construct( $page ) {
		$this->id = $page['id'];
		$this->type = $page['type'];
		$this->slug = $page['type'].'/'.$page['id'];
		$this->filename = 'content/'.$this->type.'/'.$this->id.'.html';
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