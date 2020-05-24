<?php get_header( ); global $post, $gft; ?>

<main role="main">
    <!-- section -->
    <section>

        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="single-post-container container">
                    <div class="single-post-content-container">
                        <div class="single-post-content-box">
                            <h3><?php echo get_field( 'subtitle', $post ); ?></h3>
                            <?php the_content(); ?>
                        </div>
                        <div class="single-post-sidebar-box">
                            <div class="single-post-sidebar">
                                <?php echo gft_get_similiar_posts( $post ); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
            <!-- /article -->

        <?php endwhile; ?>

        <?php else: ?>

            <!-- article -->
            <article>

                <h1><?php _e( 'Sorry, nothing to display.', 'gft' ); ?></h1>

            </article>
            <!-- /article -->

        <?php endif; ?>

    </section>
    <!-- /section -->
</main>

<?php get_footer(); ?>
