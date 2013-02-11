architect
============

A minimal, easily extendable flat-file framework that is only 54kbs! 
Inspired by the structure of Wordpress, Architect includes an easy to understand theming system, a hook and action system for themes and plugins, and many helper modules for common tasks.

The goal is to build a simple framework that includes an easy-to-use admin panel, and takes advantage of the simplicity of a flat-file website.

Every developer builds their sites a little differently. Using a flat-file framework makes it easy to customize your own "preset" configuration that you can drop onto a server with zero configuration! 

Focus on the things that make each site unique instead of configuring a site from scratch every time!

Includes the 12 column 960grid system.

Each theme can be broken down into multiple template parts. The default theme has several including 'head', 'header', 'content', 'sidebar', 'footer', 'foot', etc. Use the **arch_template()** function to load them from the theme's templates folder. When you call **arch_template()**, several things happen. Let's use the **header** template part as an example. When I call **arch_template('header')**, a hook called **arch_header_before** is executed, then the **header.php** file in the templates folder, and filters the content based on a filter called **arch_header_filter**, then returns the result, and executes another hook called **arch_header_after**. The hooks and filters are generated dynamically for each template part.

The same dynamic filter and hooks are created for **arch_module()** function.

This is the basic loading order of files in the framework

	/index.php
	
		-> /core/load_arch.php
		
			-> /core/core.php  /* loads functions used throughout the theme */
			
			-> /core/init_theme.php
			
				-> /configure.inc  /* Loads site defaults */
			
				-> /themes/THEME/features.php  /* Sets theme defaults, and options */
				
				-> /* Sets __autoload(), and defines constants */
				
				-> /themes/THEME/TYPE.php  /* Loads the theme page based on type */
		
			
			
		
