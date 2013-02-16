<?php
arch_add_info('{"designer" : "Andrew Trivette", "designer_url" : "http://andrewtrivette.com" }');

arch_register('arch_head_after', 'theme_css');
function theme_css() {
	echo arch_css_link( 'themes/'.THEME.'/css/style.css' );
	echo arch_css_link( 'themes/'.THEME.'/css/mobile.css' );
}

arch_register('arch_head_after', 'theme_js');
function theme_js() {
	echo arch_js_link( THEME.'/js/script.js');
}

arch_register('arch_foot_before', 'foot_js');
function foot_js() {
	echo arch_js_link('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
	echo arch_js_link('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js');
}
?>