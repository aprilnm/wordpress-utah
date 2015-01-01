<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <!--google  font family-->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,100,700,800,500' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52ea9bb42d5e1da6" async="async"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--scripts-->
        <?php wp_head(); ?>        
    </head>
    <body <?php body_class(); ?>>
        <header class="header-main">
            <?php if (get_bw_theme_options('top_widget')): ?>
                <div class="top-bar">
                    <div class="container">

                        <div class="pull-left">
                            <?php dynamic_sidebar('topleftbar'); ?>  
                        </div>

                        <div class="pull-right">
                            <?php dynamic_sidebar('toprightbar'); ?>
                        </div>
                    </div><!--container end-->
                </div><!--topbar end-->
            <?php endif; ?>
            <div class="navbar navbar-default sticky-nav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo site_url(); ?>">
                            <img src="<?php echo get_bw_theme_options('logo_img'); ?>" class="img-responsive" alt="logo">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">

                        <?php bizwrap_main_nav(); ?>


                    </div><!--/.nav-collapse -->
                </div><!--/.container-->
            </div><!--navigation end-->
        </header><!--header main end-->