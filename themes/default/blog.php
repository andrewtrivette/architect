<?php arch_init(); ?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 lt7 lt8 lt9"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 lt8 lt9"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 lt9"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->
    <head>
    <?php arch_template('head'); ?>
    </head>
    <body class="<?php echo arch_page_class(); ?>">
        <div class="main_wrapper">
            <header class="banner">
                <?php arch_template('header'); ?>
                <nav class="menu clearfix" role="navigation">
				<?php 
				arch_menu( array( 'folder' => 'content', 'attribute' => '', 'filetype' => 'html', 'url' => 'page/', 'depth' => '1' ) ); ?>
                </nav>
            </header><!-- .banner -->
            <article class="copy with_sidebar">
                <?php arch_template('content'); ?>
            </article><!-- .copy -->
            <aside class="sidebar">
            	<?php arch_template('sidebar');
				//includes sidebar.php from the theme, and executes hooks for arch_sidebar_before, and arch_sidebar_after ?>
            </aside>
            <footer class="footer">
                <?php arch_template('footer'); ?>
            </footer>
        </div><!-- .main_wrapper -->
    <?php arch_template('foot'); ?>
    </body>
</html>