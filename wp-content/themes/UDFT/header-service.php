<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php

    global $post, $gft;
    wp_head();

    ?>

</head>
<body <?php body_class(); ?>>

<!--<div id="preloader"></div>-->
<div class="site-container">

    <div class="site-wrapper">


        <header class="header" role="banner">

            <div class="header-top-container">

                <div class="header-top-box container p0">

                    <a class="ht-link fa fa-phone" href="tel:<?php echo preg_replace( '/\s|\+|-|\(|\)/', '', $gft['site-phone'] ); ?>">Telefon : <?php echo $gft['site-phone'] ?></a>
                    <a class="ht-link fa fa-envelope" href="mailto:<?php echo $gft['site-email'] ?>">Email : <?php echo $gft['site-email'] ?></a>
                    <button class="ht-button lead-form-trigger">Jetzt Termin Vereinbaren</button>

                </div>

            </div>

            <div class="header-content-container">

                <div class="header-content-box container p0">

                    <div class="header-content">

                        <div class="top-menu-content-box">

                            <div class="top-logo-box left">
                                <span class="top-logo-link"><img src="<?php echo get_stylesheet_directory_uri() . '/img/zsd-logo.png'; ?>"></span>
                            </div>

                            <nav class="nav top-nav" role="navigation">
                                <?php wp_nav_menu( array( 'menu' => 'top-menu', 'container' => false, 'menu_class' => 'top-menu', 'walker' => new True_Walker_Nav_Menu() ) ); ?>
                                <div class="close-nav"></div>
                            </nav>

                            <div class="top-logo-box right">
                                <a class="top-logo-link" href="<?php echo site_url(); ?>"><?php echo $gft['logo1']; ?></a>
                            </div>

                        </div>

                        <div class="menu-manage"><span></span><span></span><span></span></div>

                    </div>

                </div>

            </div>

            <div class="top-media-box">

                <div class="page-regular-content service-archive">
                    <h1>our servises</h1>
                    <h2 class="page-excerpt">our super seo h2</h2>
                </div>

            </div>

            <?php
            if ( !is_front_page() ) {
                echo '<div class="bc-container"><div class="bc-box container p0">';
                bcn_display();
                echo '</div></div>';
            }
            ?>


        </header>