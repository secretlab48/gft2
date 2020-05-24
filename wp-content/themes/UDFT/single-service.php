<?php

global $post;

get_header( );

the_post();
$icon = get_field( 'regular_icon', $post->ID );
$images = get_field( 'images', $post->ID );
$sidebar = $sidebar_class = $imgs = '';
if ( is_array( $images ) && count( $images ) > 0 ) {
    foreach ( $images as $i => $image ) {
        $imgs .=
            '<div class="single-service-img-box">' .
                '<img src="' . $image['image']['sizes']['service-inner'] . '">' .
            '</div>';
    }
    $sidebar =
        '<div class="single-service-sidebar">' . $imgs . '</div>';
    $sidebar_class = ' has-sidebar';
}
$a = 1;

?>

<main role="main">

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
        <div class="single-service-post container p0">
            <div class="single-service-heading-box">
                <div class="single-service-heading">
                     <div class="service-icon"><?php echo $icon; ?></div>
                     <h3><?php the_title(); ?></h3>
                </div>
            </div>
            <div class="single-service-content-box <?php echo $sidebar_class; ?>">
                <?php echo $sidebar; ?>
                <div class="single-service-content">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </div>
    </article>

</main>


<?php

get_footer();

