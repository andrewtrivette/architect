<?php
$hooks = array();

function arch_add_info($args) {
	global $settings;
	$json = json_decode($args, true);
	//echo $args;
	$info = &$settings;
	foreach($json as $key => $value) {
		$info[$key] = $value;
	}
}

function arch_set_constants($settings) {
	foreach ($settings as $name => $value) {
		define(strtoupper($name), $value, true);
	}
}

function arch_execute($hook) {
	global $hooks;
	$active = (isset($hooks[$hook])) ? $hooks[$hook]:'';
	if ( !empty($active) ) {
		foreach ($active as $callback => $args) {
			call_user_func_array($callback, $args);	
		}
	}
}

function arch_register($hook, $callback, $args = array()) {
	global $hooks;
	$hooks[$hook][$callback] = $args;
}

function arch_include( $filename ) {
	if ( is_file( $filename ) ) {
		ob_start();
		global $content;
		include $filename;
		return ob_get_clean();
	}
	return $filename;
}

function arch_filter($hook, $content) {
	global $hooks;
	$active = (isset($hooks[$hook])) ? $hooks[$hook]:'';
	$html = '';
	if ( !empty($active) ) {
		foreach ($active as $callback => $args) {
			$html .= call_user_func($callback, $content);	
		}
	} else {
		$html = $content;
	}
	return $html;
}
function arch_template($part, $path = 'templates/') {
	global $content;
	arch_execute('arch_'.$part.'_before');
	$include = arch_include( 'themes/'.THEME.'/'.$path.$part.'.php' );
	echo arch_filter('arch_'.$part.'_filter', $include);
	arch_execute('arch_'.$part.'_after');	
}

function arch_module($module, $args = array() ) {
	global $content;
	$hook = strtolower($module);
	arch_execute('arch_'.$hook.'_before');
	echo arch_filter('arch_'.$hook.'_filter', new $module( $args, $content ) );
	arch_execute('arch_'.$hook.'_after');
}

function arch_page_class() {
	return 'page';	
}

function arch_css_link($link) {
	if ( stristr( $link, '//' ) ) {
		return '<link rel="stylesheet" href="'.$link.'">'.PHP_EOL;
	} else {
		return '<link rel="stylesheet" href="'.BASE_URL.$link.'">'.PHP_EOL;
	}
}

function arch_js_link($link) {
	if ( stristr( $link, '//' ) ) {
		return '<script type="text/javascript" src="'.$link.'"></script>'.PHP_EOL;
	} else {
		return '<script type="text/javascript" src="'.BASE_URL.'themes/'.$link.'"></script>'.PHP_EOL;
	}
}
?>