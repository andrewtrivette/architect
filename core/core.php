<?php
$hooks = array();

function __autoload($class_name) {
	if ( file_exists('plugins/'.$class_name . '.php') ) {
    	require_once 'plugins/'.$class_name . '.php';
	} else {
		require_once 'modules/'.$class_name . '.php';
	}
}

//Constants
function arch_add_info($args) {
	// Takes a JSON string and converts it to an array, and then defines a constant for each item
	$json = json_decode($args, true);
	//echo $args;
	$info = &$settings;
	foreach($json as $key => $value) {
		define( strtoupper($key),$value, true );
	}
}

function arch_show_hooks() {
	global $hooks;
	echo '<ul>';
	foreach ($hooks as $key => $value) {
		echo '<li><b>Hook: '.$key.'</b> - Function: '.print_r($value, false).'</li>';
	}
	echo '</ul>';
}
//Hooks and Actions
function arch_execute($hook) { 
	//Execute the functions associated with the specified hook
	global $hooks;
	$active = (isset($hooks[$hook])) ? $hooks[$hook]:'';
	if ( !empty($active) ) {
		foreach ($active as $callback => $args) {
			call_user_func_array($callback, $args);	
		}
	}
}

function arch_register($hook, $callback, $args = array()) {
	// Assigns the name of a function(callback) to the specified hook. These functions will be called by arch_execute()
	global $hooks;
	$hooks[$hook][$callback] = $args;
}

function arch_filter($hook, $content) {
	// Sames as arch_execute() except it passes some content to the callback functions 
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

//Templates
function arch_include( $filename ) {
	// Includes a file and returns it's contents
	if ( is_file( $filename ) ) {
		ob_start();
		global $content;
		include $filename;
		return ob_get_clean();
	}
	return $filename;
}

function arch_template($part, $path = 'templates/') {
	// Loads a template file, and executes dynamically named hook before and after the content. Before the content is returned it's filtered using another dynamically named hook and arch_filter()
	global $content;
	arch_execute('arch_'.$part.'_before');
	$include = arch_include( THEME.'/'.$path.$part.'.php' );
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

// External Files
function arch_css_link($link) {
	return '<link rel="stylesheet" href="'.$link.'">'.PHP_EOL;
}

function arch_js_link($link) {
	return '<script type="text/javascript" src="'.$link.'"></script>'.PHP_EOL;
}
?>