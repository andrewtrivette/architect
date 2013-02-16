<?php
class Sanitize {
	public $result;
	
	function __construct($string = "test") {
		$sanitize = preg_replace("[^A-Za-z0-9-\s.,<>\/]", "", $string);
		$sanitize = str_replace("\n", '', $sanitize);
		$sanitize = str_replace("\r", '', $sanitize);
		$sanitize = str_replace("  ", ' ', $sanitize);
		$html = strip_tags(trim($sanitize), '<p><b><strong><i><em><table><td><tr><th><ul><ol><li><abbr><a><br><blockquote><center><dd><dt><dl><embed><object><hr><img><param><sub><sup><small><fieldset><legend>');
		$encoded = base64_encode(htmlentities($html));
		return $this->result = $encoded;
	}

	function string_sanitize ($string) {
		$sanitize = preg_replace("[^A-Za-z0-9\s.,<>\/-]", "", $string);
		$sanitize = str_replace("\n", '', $sanitize);
		$sanitize = str_replace("\r", '', $sanitize);
		$sanitize = str_replace("  ", ' ', $sanitize);
		$html = strip_tags(trim($sanitize), '<p><b><strong><i><em><table><td><tr><th><ul><ol><li><abbr><a><br><blockquote><center><dd><dt><dl><embed><object><hr><img><param><sub><sup><small><fieldset><legend>');
		$encoded = utf8_encode(htmlentities($html));
		return $this->result = $encoded;
	}
	
	function __toString() {
		return $this->result;
	}
}
?>