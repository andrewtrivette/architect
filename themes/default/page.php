<?php arch_execute('arch_init'); ?>
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
    <div class="l-main_wrapper">
        <header class="l-banner">
            <?php arch_template('header'); ?>
            <nav class="l-menu clearfix" role="navigation">
				<?php arch_module('Menu', array( 'type' => $content->type, 'id' => $content->id, 'depth' => 2 ) ); ?>
            </nav>
        </header><!-- .banner -->
        <article class="l-copy container_12 clearfix">
            <?php arch_template('content'); ?>
        </article><!-- .copy -->
        <footer class="l-footer clearfix">
            <?php arch_template('footer'); ?>
        </footer>
    </div><!-- .main_wrapper -->
<?php arch_template('foot'); ?>
</body>
</html>