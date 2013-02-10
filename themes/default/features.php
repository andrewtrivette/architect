<?php
arch_add_info('title', 'ArchitectCMS');
arch_add_info('company', 'ArchitectCMS');
arch_add_info('designer', 'Andrew Trivette');
arch_add_info('designer_url', 'http://andrewtrivette.com');
arch_add_info('description', 'ArchitectCMS is a remote content management system designed and provided by Andrew Trivette Design');
arch_add_info('email', 'andrew.trivette@gmail.com');
arch_add_info('ganalytics', 'UA-1097544-');
arch_add_info('year', '2007');

arch_register('arch_head_after', 'theme_css');
function theme_css() {
	echo arch_css_link( THEME.'/css/style.css' );
	echo arch_css_link( THEME.'/css/mobile.css' );
}
arch_register('arch_head_after', 'theme_js');
function theme_js() {
	echo arch_js_link( THEME.'/js/script.js');
}

?>