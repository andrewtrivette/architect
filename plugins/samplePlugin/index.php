<?php
//arch_register('arch_content_filter', 'samplePlugin_run');

function samplePlugin_run($data) {
	return strip_tags($data);
}
?>