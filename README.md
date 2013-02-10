architectcms
============

A minimal, easily extendable framework that is only 54kbs! 
Includes an easy to understand theming system, a hook and action system for themes and plugins, and many helper modules for common tasks.

This is the basic loading order of files in the framwork
-> /index.php
->
  /core/load_arch.php
	
	-> /core/core.php  /* loads functions used throughout the theme */
	
	-> /core/init_theme.php
	
		-> /configure.inc  /* Loads site defaults */
	
		-> /themes/THEME/features.php  /* Sets theme defaults, and options */
		
		-> /* Sets __autoload(), and defines constants */
		
		-> /themes/THEME/TYPE.php  /* Loads the theme page based on type */
		
			
			
		
