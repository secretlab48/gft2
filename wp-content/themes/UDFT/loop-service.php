<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php
        echo gft_get_archive_service( $post );
        ?>

    </article>
    <!-- /article -->

<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article>
        <h2><?php _e( 'Sorry, nothing to display.', 'gft' ); ?></h2>
    </article>
    <!-- /article -->

<?php endif; ?>
