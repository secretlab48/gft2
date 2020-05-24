<?php

/**
 * Template Name: News Page Template
 * The template for display News Page
 *
 */

global $post;

$page = $start_date = $end_date = $search_word = null;
$ppp = 3;
$date_query = array();
$args = array();

if ( isset( $_GET['page'] ) && strlen( $_GET['page'] ) > 0 ) $page = $_GET['page'];
$current_page = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
if ( isset( $_GET['start_date'] ) && strlen( $_GET['start_date'] ) > 0 ) {
    $start_date = strtotime( $_GET['start_date'] );
    $date_after = date( 'F d Y', $start_date );
    $date_query['after'] = $date_after;
    $date_query['inclusive'] = true;
}
if ( isset( $_GET['end_date'] ) && strlen( $_GET['end_date'] ) > 0 ) {
    $end_date = strtotime( $_GET['end_date'] );
    $date_before = date( 'F d Y', $end_date );
    $date_query['before'] = $date_before;
    $date_query['inclusive'] = true;
}
if ( count( $date_query ) > 0 ) { $args['date_query'] = $date_query; }
if ( isset( $_GET['search_word'] ) && strlen( $_GET['search_word'] ) > 0 ) {
    $search_word = $_GET['search_word'];
    $args['s'] = $search_word;
}
$args['post_type'] = 'post';
$args['posts_per_page'] = $ppp;
$args['offset'] = ( $current_page - 1 ) * $ppp;

$query = new WP_Query( $args );
$news = $query->posts;
$count_posts = $query->found_posts;

get_header( 'page' );
?>

    <main role="main">

        <section class="news-content-section">
            <div class="container">
                <?php

                    if ( count( $news ) > 0 ) {
                        echo '<div class="news-content">';
                        foreach( $news as $new ) {
                            echo gft_get_single_new( $new );
                        }
                        echo '</div>';
                        $qs = preg_replace( '/page\/[0-9]+\//', '', $_SERVER['QUERY_STRING'] );
                        echo gft_get_pagination( array( 'page' => $current_page, 'q' => $count_posts, 'ppp' => $ppp, 'base' => site_url() . '/' . strtolower( get_the_title( $post ) ), 'qs' => preg_replace( '/page\/[0-9]+\//', '', $_SERVER['QUERY_STRING'] ) ) );
                    }
                    else {
                        echo UDFT::get_template_part( '404' );
                    }

                ?>
            </div>
        </section>


    </main>

<?php get_footer(); ?>