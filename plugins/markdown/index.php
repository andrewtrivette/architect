<?php
arch_register('arch_content_filter', 'markdown_filter');
include "markdown.php";
function markdown_filter($data) {
	return Markdown($data);
}
?>