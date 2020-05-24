<?php get_header(); ?>

    <main role="main">
        <!-- section -->
        <section>

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="single-post-container container">
                        <div class="single-post-content">
                            <span class="date"><?php the_time('d. m. Y'); ?></span>

                            <?php the_content(); ?>

                            <?php the_tags( __( 'Tags: ', 'gft' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

                            <p><?php _e( 'Categorised in: ', 'gft' ); the_category(', '); // Separated by commas ?></p>
                        </div>
                        <div class="single-post-thumb">
                            <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail( 'post-small' ); ?>
                                </a>
                            <?php endif; ?>
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