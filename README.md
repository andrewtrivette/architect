architect
============

A minimal, easily extendable flat-file framework. 
Inspired by the structure of Wordpress, Architect includes an easy to understand theming system, a hook and action system for themes and plugins, and many helper modules for common tasks.

TODO:
- Complete a simple Admin Panel for managing content
- Handle 404 errors, using a levenshtein algorithm for reduced errors
- Create a search helper module
- Create a demo blog template
- Create a system for including metadata with each file(category, author name, tags, etc)

Every developer builds their sites a little differently. Using a flat-file framework makes it easy to customize your own "preset" configuration that you can drop onto a server with zero configuration! 

Focus on the things that make each site unique instead of configuring a site from scratch every time!

Included as plugins:
- The 12 column 960grid system
- Michel Fortin's Markdown converter


Each theme can be broken down into multiple template parts. The default theme has several including 'head', 'header', 'content', 'sidebar', 'footer', 'foot', etc. 
Use the **arch_template()** function to load them from the theme's _templates_ folder. When you call **arch_template()**, several things happen. Let's use the **header** template part as an example. When I call **arch_template('header')**, a hook called **arch_header_before** is executed, then the **header.php** file is included from the _templates_ folder, and filters the content based on a filter called **arch_header_filter**, then returns the result, and executes another hook called **arch_header_after**. The hooks and filter names are created dynamically every time **arch_template()** is called.

This is the basic loading order of files in the framework

	/index.php
	
		-> /core/load_arch.php
		
			-> /core/core.php  /* loads functions used throughout the theme */

			-> /core/init_plugins.php
			
			-> /core/init_theme.php
			
				-> /configure.inc  /* Contains site defaults */
			
				-> /themes/THEME/features.php  /* Sets theme defaults, and options */
				
				-> /themes/THEME/TYPE.php  /* Loads the theme page based on type */
		
			
			
		
