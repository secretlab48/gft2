<?php get_header( ); ?>

	<main role="main">

		<!--<section>-->

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
                <div class="container page-container p0">

                    <?php the_content(); ?>

                    <?php comments_template( '', true ); ?>

                    <br class="clear">

                </div>

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

		<!-- /section -->
	</main>

<?php get_footer(); ?>
