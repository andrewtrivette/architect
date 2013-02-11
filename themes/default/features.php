<?php
arch_add_info('designer', 'Andrew Trivette');
arch_add_info('designer_url', 'http://andrewtrivette.com');

arch_register('arch_head_after', 'theme_css');
function theme_css() {
	echo arch_css_link( THEME.'/css/style.css' );
	echo arch_css_link( THEME.'/css/960_12_col.css' );
	echo arch_css_link( THEME.'/css/mobile.css' );
}
arch_register('arch_head_after', 'theme_js');
function theme_js() {
	echo arch_js_link( THEME.'/js/script.js');
}

?>