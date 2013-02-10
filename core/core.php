<?php
$hooks = array();

function arch_add_info($name, $value) {
	global $settings;
	$info = &$settings;
	$info[$name] = $value;
}

function arch_execute($hook) {
	global $hooks;
	$active = $hooks[$hook];
	if ( !empty($active) ) {
		foreach ($active as $callback => $args) {
			call_user_func_array($callback, $args);	
		}
	}
}

function arch_register($hook, $callback, $args = '') {
	global $hooks;
	$hooks[$hook][$callback] = $args;
}

function arch_template($part, $path = 'templates/') {
	arch_execute('arch_'.$part.'_before');
	include 'themes/'.THEME.'/'.$path.$part.'.php';
	arch_execute('arch_'.$part.'_after');	
}

function arch_module($module, $args ) {
	$hook = strtolower($module);
	arch_execute('arch_'.$hook.'_before');
	echo new $module( $args );
	arch_execute('arch_'.$hook.'_after');
}

function arch_page_class() {
	return 'page';	
}

function arch_css_link($link) {
	return '<link rel="stylesheet" href="'.BASE_URL.'themes/'.$link.'">'.PHP_EOL;
}

function arch_js_link($link) {
	return '<script type="text/javascript" src="'.BASE_URL.'themes/'.$link.'"></script>'.PHP_EOL;
}
?>