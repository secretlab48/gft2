<?php
/*
 *  Author: CA
 *  Custom functions, support, custom post types and more.
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*------------------------------------*\
	Functions
\*------------------------------------*/

global $udft;

require_once ( 'redux-config.php' );
require_once ( 'inc/functions.php' );
require_once ( 'inc/emails.php' );


add_filter( 'post_type_link', 'services_permalink', 1, 2 );

function services_permalink( $permalink, $post ){

    if( strpos( $permalink, '/service/') === false )
        return $permalink;

    $terms = get_the_terms( $post, 'service_cat' );

    if( ! is_wp_error( $terms ) && !empty( $terms ) && is_object( $terms[0] ) )
        $term_slug = array_pop($terms)->slug;
    else
        $term_slug = 'no-service_cat';

    $permalink = str_replace('news/', '', $permalink );
    return str_replace('/service/', '/' . $term_slug . '/', $permalink );
}


add_filter( 'term_link', 'gft_term_link', 99, 3 );

function gft_term_link( $termlink, $term, $taxonomy ) {

    if ( $taxonomy == 'service_cat' ) {
        $termlink = str_replace( 'services/', '', $termlink );
    }

    return $termlink;

}


add_action( 'init', 'udft::init' );


class UDFT
{

    static function init()
    {

        global $udft, $gft;

        $user = wp_get_current_user();
        $udft['user'] = array( 'id' => $user->ID, 'data' => $user->data, 'role' => isset( $user->roles[0] ) ?  $user->roles[0] : false );

        if (function_exists('add_theme_support')) {

            add_theme_support('menus');
            add_theme_support('widgets');

            add_theme_support('post-thumbnails');
            add_image_size('post-large', 740, 420, true);
            add_image_size('post-small', 380, 300, true);
            add_image_size('service-inner', 475, 310, true);

            load_theme_textdomain('gft', get_template_directory() . '/languages');
        }

        add_filter('widget_text', 'do_shortcode');

        wp_enqueue_style('bootstrap-template_css', get_template_directory_uri() . '/css/grid.css');
        if ( !is_admin() ) {
            wp_enqueue_style('main_custom_css', get_template_directory_uri() . '/css/custom.css');
        }
        wp_register_script('preloader_js', get_template_directory_uri() . '/js/preloader.js', array('jquery'), false, true);
        wp_enqueue_script('preloader_js');
        /*wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );*/
        //wp_enqueue_style('air-datepicker_css', get_template_directory_uri() . '/js/air-datepicker/datepicker.css');
        wp_enqueue_style('fontawesome_css', get_template_directory_uri() . '/css/font-awesome.css');
        /*wp_enqueue_style('slick_css', get_template_directory_uri() . '/inc/slick/slick.css');
        wp_enqueue_style('slick__theme_css', get_template_directory_uri() . '/inc/slick/slick-theme.css');*/

        /*wp_register_script('gsap_js', get_template_directory_uri() . '/js/gsap/minified/gsap.min.js', array('jquery'), false, true);
        wp_enqueue_script('gsap_js');
        wp_register_script('scrollMagic_js', get_template_directory_uri() . '/js/scrollMagic/ScrollMagic.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_js');
        wp_register_script('scrollMagic_jquery_js', get_template_directory_uri() . '/js/scrollMagic/plugins/jquery.ScrollMagic.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_jquery_js');
        wp_register_script('scrollMagic_gsap_js', get_template_directory_uri() . '/js/scrollMagic/plugins/animation.gsap.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_gsap_js');
        wp_register_script('scrollMagic_dev_js', get_template_directory_uri() . '/js/scrollMagic/plugins/debug.addIndicators.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_dev_js');
        wp_register_script('air-datepicker_js', get_template_directory_uri() . '/js/air-datepicker/datepicker.js', array('jquery'), false, true);
        wp_enqueue_script('air-datepicker_js');
        wp_register_script('slick_js', get_template_directory_uri() . '/inc/slick/slick.js', array('jquery'), false, true);
        wp_enqueue_script('slick_js');
        wp_register_script('mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), false, true);
        wp_enqueue_script('mousewheel_js');*/
        wp_enqueue_script('bf_resize_sensor_js', get_template_directory_uri() . '/js/ResizeSensor.js', array(
            'jquery'
        ));
        wp_enqueue_script('bf_sticky_sidebar_js', get_template_directory_uri() . '/js/sticky-sidebar.js', array(
            'jquery'
        ));
        wp_register_script('custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true);
        wp_enqueue_script('custom_js');


        add_action( 'wp_ajax_get_form_request', 'gft_get_form_request' );
        add_action( 'wp_ajax_nopriv_get_form_request', 'gft_get_form_request' );


        register_nav_menus(array(
            'header-location' => 'Top Memu',
            'footer-location' => 'Footer Menu'
        ));

        add_action('wp_enqueue_scripts', array('UDFT', 'add_ajax_data'), 99);


        register_taxonomy('service_cat', array( 'service' ), array(
            'label'                 => __( 'Service Taxonomy', 'gft' ),
            'labels'                => array(
                'name'              => __( 'Service Categoties', 'gft' ),
                'singular_name'     => __( 'Service Category', 'gft' ),
                'search_items'      => __( 'SearchService  Category', 'gft' ),
                'all_items'         => __( 'All Service Categories', 'gft' ),
                'parent_item'       => __( 'Parent Service Category', 'gft' ),
                'parent_item_colon' => __( 'Parent Service Category', 'gft' ),
                'edit_item'         => __( 'Edit Service Category', 'gft' ),
                'update_item'       => __( 'Update Service Category', 'gft' ),
                'add_new_item'      => __( 'Add Service Category', 'gft' ),
                'new_item_name'     => __( 'New Service Category', 'gft' ),
                'menu_name'         => __( 'Service Category', 'gft' ),
            ),
            'description'           => __( 'Service Categories', 'gft' ),
            'public'                => true,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_tagcloud'         => true,
            'hierarchical'          => true,
            'rewrite'               => array( 'slug'=> 'services', 'hierarchical' => false, 'with_front' => false, 'feed' => false ),
            'show_admin_column'     => true,
        ) );

        register_post_type('service', array(
            'labels'             => array(
                'name'               => 'Services',
                'singular_name'      => 'Service',
                'add_new'            => 'Add New Service',
                'add_new_item'       => 'Add Service Item',
                'edit_item'          => 'Edit Service',
                'new_item'           => 'New Service',
                'view_item'          => 'Browse Service',
                'search_items'       => 'Search Service',
                'not_found'          =>  'No services Found',
                'not_found_in_trash' => 'No Services in Trash',
                'parent_item_colon'  => '',
                'menu_name'          => 'Services'

            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title','editor','thumbnail','excerpt' )
        ) );

        add_post_type_support( 'page', 'excerpt' );

        add_rewrite_rule( '^(sicherheitsdienstleistungen|sicherheitslosungen)/([^/]+)/?', 'index.php?post_type=service&name=$matches[2]', 'top' );
        add_rewrite_rule( '^(sicherheitsdienstleistungen|sicherheitslosungen)/?$', 'index.php?taxonomy=service_cat&term=$matches[1]', 'top' );
        //add_rewrite_rule( '^resumes/([^/]+)/page/([0-9]+)/?', 'index.php?post_type=resume&taxonomy=resume_cat&term=$matches[1]&paged=$matches[2]', 'top' );
        //flush_rewrite_rules();


    }


    static function add_ajax_data()
    {

        wp_localize_script('jquery', 'ajaxdata',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );
    }


    static function get_template_part($template, $part_name = null, $mode = 'return')
    {

        if ($mode == 'return') {
            ob_start();
            get_template_part($template, $part_name);
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } else {
            get_template_part($template);
        }

    }

}


/* CUSTOM */

//remove_filter('the_content', 'wpautop');

add_filter( 'upload_mimes', 'gft_mime_types');

function gft_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;

}


add_action( 'admin_menu', 'remove_menus', 99 );
function remove_menus(){

    //remove_menu_page( 'redux_demo' );
    remove_menu_page( 'CF7DBPluginSubmissions' );


}


function block_wpadmin() {
    $file = basename($_SERVER['PHP_SELF']);
    if ( is_admin() && ( $file == 'plugins.php' || $file == 'themes.php' || $file == 'plugin-install.php' || $file == 'plugin-editor.php' || $file == 'theme-editor.php')){
        wp_redirect( admin_url() );
        exit();
    }
}

//add_action('init', 'block_wpadmin');



add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );

function filter_function_name( $num, $post ) {

    return 0;

}



add_action ( 'wp_head', function( ) {

    global $post, $gft;

    $key = 'AIzaSyBJH_df0u-I98JmaAWGZMqWsLMu8EvQL6Q';

    $out = '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJH_df0u-I98JmaAWGZMqWsLMu8EvQL6Q&language=de"></script>';
    $out = '';

    echo $out;

});


add_action( 'wp_footer', 'loads_wp_footer' );

function loads_wp_footer() {

    global $gft;

    $out =
        '<div class="modal-box">
            <div class="modal-content-box">
                <div class="modal-content">
                    <div class="form-messages">
                        <div class="modal-close"></div>
                        <div class="fm-content">
                            <div class="fm-title"></div>
                            <div class="lead-form-box">' . get_lead_form() . '</div>
                            <div class="fm-text"></div>
                            <a class="fm-btn site-button">ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    $phones = '';
    foreach( $gft['map-phones'] as $phone ) {
        $phones .= '<a href="tel:' . preg_replace( '/\{|\)|\s|\+|-/', '', $phone ). '">tel. ' . preg_replace( '/(\+49\s)|-/', '', $phone ) . '</a>';
    }

    $out .=
        '<div class="map-info-box">
             <div class="mib-title">' . $gft['map-title'] . '</div>
             <div class="mib-addres">' . $gft['map-addres'] . '</div>' .
             $phones .
             '<a href="mailto:' . $gft['map-email'] . '">' . $gft['map-email'] . '</a>
             <a href="' . $gft['map-link'] . '">' . $gft['map-link'] . '</a>
             <div class="link-box">
                 <div class="link-img"></div>
                 <a target="_blanc" href="https://www.google.com/maps/dir/?api=1&destination=' . preg_replace( array( '/\s/', '/<br>/' ), array( '+', '' ), $gft['map-addres'] ) . ( ( preg_match( '/germany/i', $gft['map-addres'] ) == 0 ) ? ',+Germany' : '' ) . '&travelmode=driving&lang=de">Routenplaner</a>
             </div>
         </div>';

    $out .= '<button class="to-top-button ajax-btn reverted"></button>';

    echo $out;

}



add_shortcode( 'gft_get_contact_form', 'gft_get_contact_form' );

function gft_get_contact_form() {

    $out =
                      '<form class="contact-form" method="POST">
                         <input type="hidden" name="form_title" value="main_form"> 
                         <!--<div class="f-title">Kundenbedarf</div>-->
                         <div class="f-subtitle">Interesse? Bitte füllen Sie das Formular aus!</div>
                         <div class="f-form-content">
                             <div class="f-inputs-box">
                                 <div class="f-input-box halfed left required">
                                     <input type="text" class="f-input" name="f-firstname" placeholder="Name">
                                     <div class="f-error"></div>
                                 </div>
                                 <div class="f-input-box halfed right">
                                     <input type="text" class="f-input" name="f-lastname" placeholder="Unternehmen">
                                     <div class="f-error"></div>
                                 </div>
                             </div>
                             <div class="f-inputs-box">
                                 <div class="f-input-box halfed left required">
                                     <input type="text" class="f-input" name="f-email" placeholder="Email">
                                     <div class="f-error"></div>
                                 </div>
                                 <div class="f-input-box halfed right required">
                                     <input type="text" class="f-input" name="f-phone" placeholder="Telefon">
                                     <div class="f-error"></div>
                                 </div>
                             </div>
                             <div class="doubled-input-box"> 
                                 <div class="f-input-box plz">
                                     <input type="text" class="f-input" name="f-plz" placeholder="PLZ">
                                     <div class="f-error"></div>
                                 </div>
                                 <div class="f-input-box ort">
                                     <input type="text" class="f-input" name="f-ort" placeholder="Ort">
                                     <div class="f-error"></div>
                                 </div>
                             </div>
                             <div class="f-input-box required">
                                 <textarea class="f-input" name="f-description" placeholder="Betreff Ihre Anfrage"></textarea>
                                 <div class="f-error"></div>
                             </div>
                             <div class="f-input-box datenshutz">
                                 <input class="f-input" type="checkbox" name="terms" value="approved"> <span class="f-label">Ich willige in die Verarbeitung und Nutzung meiner personenbezogenen Daten gemäß der <a href="/datenschutz">Datenschutzerklärung</a> ein. *</span>
                                 <div class="f-error"></div>
                             </div>
                             <button class="f-button ajax-btn">Anfrage senden</button>                                                                                       
                         </div>
                     </form>';

    return $out;

}




function get_lead_form() {

    $out =
        '<form class="lead-form" method="POST">
             <div class="lead-form-content">
                 <input type="hidden" name="form_title" value="lead_form">
                 <div class="f-input-box required">
                      <input type="text" class="f-input" name="f-name" placeholder="Name">
                      <div class="f-error"></div>
                 </div>
                 <div class="f-input-box required">
                      <input type="text" class="f-input" name="f-email" placeholder="Email">
                      <div class="f-error"></div>
                 </div>
                 <div class="f-input-box required">
                     <textarea class="f-input" name="f-description" placeholder="Betreff Ihre Anfrage"></textarea>
                     <div class="f-error"></div>
                 </div>
             </div>
             <button class="f-button ajax-btn">Anfrage senden</button> 
        </form>';

    return $out;

}


add_shortcode( 'gft_get_form_map_block', 'gft_get_form_map_block' );

function gft_get_form_map_block() {

    $out =
        '<div class="fm-block">
             <div class="fm-block-bg"></div>
             <div class="container p0">
                 <div class="form-box">' .
                     gft_get_contact_form() .
                 '</div>
             </div>
             <div class="map"></div> 
         </div>';

    return $out;

}



function gft_het_cta_block() {

    global $gft;

    $out =
        '<div class="cta-box">
             <div class="cta-content container p0">
                 <div class="cta-text">
                     <div class="cta-text-content">
                         <div class="cta-text-aligner">
                             <span>Wir freuen uns über Ihren Anruf <a href="tel:' . $gft['site-phone'] . '">' . preg_replace( array( '/\+49/' ), '', $gft['site-phone'] ) . '</a></span><!--Unsere Kunden vertrauen überall auf unsere voll akkreditierten und maßgeschneiderten Schutzlösungen.--></div>
                         </div>
                     </div>
                 <!--<button class="ajax-btn lead-form-trigger">Jetzt beraten lassen</button>-->
             </div>
         </div>';

    return $out;

}


function gft_get_archive_service ( $p = null, $btn = true ) {

    global $post;
    if ( is_int( $p ) ) { $p = get_post( $p ); }
    else { $p = $p; }

    $svg = get_field( 'regular_icon', $p->ID );
    $btn_html = $btn ? '<a class="service-btn btn" href="' . get_permalink( $p->ID ) . '">MEHR ERFAHREN</a>' : '';
    $title_html = $btn ? '<div class="service-title">' . get_the_title( $p ) . '</div>' : '<a class="service-title" href="' . get_permalink( $p->ID ) . '">' . get_the_title( $p ) . '</a>';

    $out =
        '<div class="service-item-content">
            <div class="service-icon">' . $svg . '</div>
            <div class="service-item-content-text">' .
                $title_html .
                '<div class="service-excerpt">' . get_the_excerpt( $p ) . '</div>
            </div>
        </div>' . $btn_html;

    return $out;

}


add_shortcode( 'gft_get_portfolio_block', 'gft_get_portfolio_block' );

function gft_get_portfolio_block() {

    $terms = get_terms( array( 'taxonomy' => 'service_cat', 'hide_empty' => false ) );
    $out = '<div class="page-h2"><h2>unser portfolio</h2></div><div class="services-box">';
    $services_html = ''; $has_image = false;
    foreach( $terms as $i => $term ) {
        $services = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( 'relation' => 'OR', array( 'taxonomy' => 'service_cat', 'field' => 'ID', 'terms' => array( $term->term_id ) ) ), 'meta_key' => 'sort_number', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
        $side = ( $i == 0 ) ? 'left' : 'right';
        if ( $i == 1 && !$has_image ) { $services_html .= '<div class="service-center-img"><img class="service-center-imgage" src="' . get_stylesheet_directory_uri() . '/img/gft-logo-2.svg"></div>'; $has_image = true; }
        $services_html .=
            '<div class="service-col ' . $side . '"><div class="service-term-name">' . $term->name . '</div>';
        foreach( $services->posts as $service ) {
            $services_html .=
                     '<div class="achive-service-item-box ' . $side . '">' .
                         gft_get_archive_service( $service, false ) .
                     '</div>';
        }
        $services_html .=
            '</div>';
    }
    $out .= $services_html . '</div>';

    return $out;

}

add_filter( 'pre_get_posts', function( $query ) {

    if( is_admin() ) { return $query; }

    $menu = false;
    if ( isset( $query->query ) && isset( $query->query['orderby'] ) && preg_match( '/menu/', $query->query['orderby'] ) ) {
        $menu = true;
    }

    if ( !$menu && is_main_query() && is_tax( 'service_cat' ) ) {

        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', 'sort_number' );
        $query->set( 'order', 'ASC' );

    }

    return $query;

} );




function gft_get_single_new( $p ) {

    global $post;
    $p = $p ? $p : $post;

    $out =
        '<div class="news-item-box">
            <article id="' . $p->ID . '" ' . join( ' ', get_post_class( join( ' ', array( 'single-new' ) ), $p->ID ) ) . '>
                <div class="news-item-content-box">
                    <div class="new-img-box">' . get_the_post_thumbnail( $p->ID, 'post-small' ) . '</div>
                    <h3>' . get_the_title( $p ) . '</h3>
                    <div class="news-item-content">' . get_the_excerpt( $p ) . '</div>
                </div>
                <a class="news-btn" href="' . get_permalink($p->ID) . '">Mehr lesen</a>
            </article>
        </div>';

    return $out;

}




function gft_get_pagination( $args = array( 'page' => null, 'q' => null, 'ppp' => 1, 'base' => null, 'qs' => '' ) )
{

    global $wp_query;

    $data = array(
        'page' => 1,
        'q'    => null,
        'ppp'  => 1,
        'base' => site_url(),
        'qs'   => ''
    );

    $data = shortcode_atts( $data, $args );
    $data['qs'] = strlen( $data['qs'] ) > 0 ? '?' . $data['qs'] : $data['qs'];

    $pages = ceil( $data['q'] / $data['ppp'] );
    $out =
        '<div class="pagination_wrapper ajax-pagination">
             <div class="pagination">';
    $prev = '';
    if ( $pages > 1 ) {
        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( $i == 1 ) {
                if ( $data['page'] != 1 ) {
                    $out .= '<a class="prev page-numbers" href="' . $data['base'] . '__prev__' . '"></a>';
                }

            }
            if ( $data['page'] == $i ) {
                $out .= '<span aria-current="page" class="page-numbers current">' . $i . '</span>';
                $prev = ( ( $i - 1 )  > 1 ) ? '/page/' . ( $i - 1 ) : '/page/1/' . $data['qs'];
                $next = ( ( $i + 1 ) < $data['q'] ) ? ( $i + 1 ) : $data['q'];
            }
            else {
                $out .= '<a class="page-numbers" href="' . $data['base'] . '/page/' . $i . '/' . $data['qs'] . '">' . $i . '</a>';
            }
            if ( $i == $pages ) {
                if ( $data['page'] < $pages ) {
                    $out .= '<a class="next page-numbers" href="' . $data['base'] . '/page/' . $next . '/' . $data['qs'] . '">' . '' . '</a>';
                }
            }
        }
    }

    $out .=
        '</div>
    </div>';

    $out = str_replace( '__prev__', $prev, $out );

    $a = 1;
    return $out;

}




function gft_get_form_request() {

    global $wpdb;

    $data = $_POST;
    //do_action_ref_array( 'cfdb_submit', array( &$data ) );
    $tableName = 'wp_cf7dbplugin_submits';
    $parametrizedQuery = "INSERT INTO `$tableName` (`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`) VALUES (%s, %s, %s, %s, %s)";
    $order = 0;
    $title = $data['form_title'];
    $time = time();
    $allowedNames = array( 'f-firstname' => array( 'name' => 'Name' ), 'f-name' => array( 'name' => 'Name' ), 'f-lastname' => array( 'name' => 'Untermehmen' ), 'f-phone' => array( 'name' => 'Telefon' ), 'f-email' => array( 'name' => 'Email' ), 'f-ort' => array( 'name' => 'Ort' ), 'f-description' => array( 'name' => 'Beschreibungsfeld' ), 'f-plz' => array( 'name' => 'PLZ' ) );
    $email_data = '';
    $emai_data_array = array();
    $recipients = array( 'secretlab48@gmail.com' );

    foreach ( $data as $name => $value ) {
        $nameClean = stripslashes($name);
        $value = is_array($value) ? implode($value, ', ') : $value;
        $valueClean = stripslashes($value);

        if ( array_key_exists( $nameClean, $allowedNames ) ) {
            /*$wpdb->query($wpdb->prepare($parametrizedQuery,
                $time,
                $title,
                $allowedNames[$nameClean]['name'],
                $valueClean,
                $order++));*/
            $email_data .= $allowedNames[$nameClean]['name'] . ' : ' . $valueClean . '<br>';
            $emai_data_array[$allowedNames[$nameClean]['name']] = $valueClean;
        }

    }

    $admins = get_users( array( 'role' => 'administrator' ) );
    foreach ( $admins as $admin ) {
        $recipients[] = $admin->user_email;
    }
    $recipients[] = 'info@gft-sicherheit.de';
    //$recipients[] = 'vadim.labets@agilest.org';

    $to = array( $emai_data_array['Email'] );
    $subject =   site_url() . ' -  your request is accepted';
    $body = get_email_header() . get_email_content( array( 'data' => $emai_data_array ) ) . get_email_footer();
    $headers = array();
    //$headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . 'GFT' . ' <' . 'info@gft-sicherheit.de' . '>' );

    $result = wp_mail( $to, $subject, $body, $headers );

    $result = wp_mail( $recipients, site_url() . ' - new Lead', $email_data );

    echo json_encode( array( 'result' => 1,'content' => 'Ihre Anfrage wird angenommen, wir werden uns innerhalb von 24 Stunden mit Ihnen in Verbindung setzen' ) );
    wp_die();

}



function gft_get_posts_for_select() {

    $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1 ) );

    $out = array();
    foreach( $posts->posts as $p ) {

       $out[$p->ID] = get_the_title( $p );

    }

    return $out;

}



add_shortcode( 'get_logos', 'gft_get_logos' );

function gft_get_logos() {

    global $gft;



    $out =
        '<div class="lb-logos-box">
             <div class="lb-img-box"> 
                 <div class="lb-logo lb-logo-1"> <img src="' . get_stylesheet_directory_uri() . '/img/logo-2.jpg"></div>
                 <div class="lb-logo lb-logo-2"><img src="' . get_stylesheet_directory_uri() . '/img/gft-logo-2.svg"></div>                
             </div>    
         </div>';
    //$out = $gft['logo1'];

    return $out;

}


function gft_get_similiar_posts( $p ) {

    $posts = get_posts( array( 'numberposts' => 3, 'exclude' => array( $p->ID ) ) );

    $out = '<div class="related-posts">';
    foreach( $posts as $p ) {
        $out .=
            '<div class="related-post-item">
                 <h3 class="rp-title">' . get_the_title( $p->ID ) . '</h3>
                 <div class="rp-excerpt">' . implode( ' ', array_slice( explode(' ', get_the_excerpt( $p->ID ) ), 0, 10 ) ) . '</div>
                 <a class="news-btn" href="' . get_permalink( $p->ID ) . '">Mehr erfahren</a>
             </div>';
    }
    $out .= '</div>';

    return $out;

}



function template_chooser($template)
{
    global $wp_query;
    $post_type = ( isset( $_GET['posttype'] ) && $_GET['posttype'] != '' ) ? $_GET['posttype'] : '';
    if( isset( $_GET['s'] ) && $post_type == 'downloads' )
    {
        return locate_template('dpbm-items-search.php');
    }
    return $template;
}

add_filter('template_include', 'template_chooser');



add_filter( 'pre_get_posts', function( $query ) {

    if ( !is_admin() && is_main_query() ) {
        if ( is_post_type_archive( array( 'service' ) ) ) {
            $query->set( 'posts_per_page', -1 );
        }
        if ( is_tax( 'service_cat' ) ) {
            $query->set( 'posts_per_page', -1 );
        }
    }

    return $query;

}, 9 );



function umlauts( $str ) {
    $search = array ("ä", "ö", "ü", "ß", "Ä", "Ö", "Ü");
    $replace = array ("&auml;", "&ouml;", "&uuml;", "&szlig;", "&Auml;", "&Ouml;", "&Uuml;");
    $res = str_replace($search, $replace, $str);
    return $res;
}


/*add_filter( 'wpseo_canonical', function ( $url ) {

    return str_replace( 'http://', 'https://www.', $url );

} );*/

function set_emails_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','set_emails_content_type' );



