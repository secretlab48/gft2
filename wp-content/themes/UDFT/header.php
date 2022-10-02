<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

                            <a class="ht-link fa fa-phone" href="tel:<?php echo preg_replace( '/\s|\+|\(|\)/', '', $gft['site-phone'] ); ?>">Telefonnummer : <?php echo $gft['site-phone'] ?></a>
                            <a class="ht-link fa fa-envelope" href="mailto:<?php echo $gft['site-email'] ?>">E-Mail : <?php echo $gft['site-email'] ?></a>
                            <button class="ht-button lead-form-trigger">Jetzt Termin Vereinbaren</button>

                        </div>

                        <div class="metr"></div>

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

                        <?php
                            if ( is_front_page() ) {
                                echo do_shortcode('[smartslider3 slider=2]');
                            }
                            else if ( is_singular( 'page' ) || is_singular( 'service' ) ) {
                                $img = get_the_post_thumbnail_url( $post, 'full' );
                                if ($img) {
                                    $style = ' style="background : linear-gradient( rgba(35, 55, 108, 0.45), rgba(35, 55, 108, 0.45) ), url(' . $img . ') no-repeat 50% 50%;"';
                                } else $style = ' style="background-color : #23376c;"';
                                echo
                                    '<div class="page-regular-content"' . $style .'>
                                         <h1>' . get_the_title( $post->ID ) . '</h1>
                                         <h2 class="page-excerpt">' . get_the_excerpt( $post ) . '</h2>
                                    </div>';
                            }
                            else if ( is_singular( 'post' ) ) {
                                $img = get_field( 'top_background', $post->ID );
                                if ( $img && is_array( $img ) ) {
                                    $style = ' style="background : linear-gradient( rgba(35, 55, 108, 0.45), rgba(35, 55, 108, 0.45) ), url(' . $img['url'] . ') no-repeat 50% 50%;"';
                                } else $style = ' style="background-color : #23376c;"';
                                echo
                                    '<div class="page-regular-content"' . $style .'>
                                         <h1>' . get_the_title( $post->ID ) . '</h1>
                                         <h2 class="page-excerpt">' . get_the_excerpt() . '</h2>
                                     </div>';
                            }
                            else if ( is_archive( 'service' ) ) {
                                if ( is_tax( 'service_cat' ) ) {
                                    global $wp_query;

                                    $term_name = get_query_var('service_cat');
                                    if ( $term_name == '' ) {
                                        $term_name = get_query_var('term');
                                    }
                                    $term = get_term_by( 'slug', $term_name, 'service_cat' );
                                    $term_img = get_term_meta( $term->term_id, 'category-image-id', true );
                                    if ( $term_img != '' ) {
                                        $img = wp_get_attachment_url( $term_img, 'full' );
                                        $style = ' style="background : linear-gradient( rgba(35, 55, 108, 0.45), rgba(35, 55, 108, 0.45) ), url(' . $img . ') no-repeat 50% 50%;"';
                                    }
                                    else {
                                        $style = '';
                                    }

                                    echo
                                        '<div class="page-regular-content service-cat-archive" ' . $style . '>
                                         <h1>' . $term->name . '</h1>
                                         <h2 class="page-excerpt">' . $term->description . '</h2>
                                    </div>';
                                }
                                else {
                                    echo
                                    '<h1>our servises</h1>
                                     <h2 class="page-excerpt">our super seo h2</h2>';
                                }
                            }
                            else if ( is_404() ) {
                                echo
                                    '<div class="page-regular-content not-found">
                                         <h1>page 404</h1>
                                     </div>';
                            }
                        ?>

                    </div>

                    <?php
                        if ( !is_front_page() ) {
                            echo '<div class="bc-container"><div class="bc-box container p0">';
                            bcn_display();
                            echo '</div></div>';
                        }
                    ?>


                </header>

                <?php /*echo gft_get_form_map_block();*/ ?>

