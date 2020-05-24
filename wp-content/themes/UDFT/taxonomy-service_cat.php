<?php get_header( ); ?>

    <main role="main">
        <!-- section -->
        <section class="service-archive-box container p0">

            <?php get_template_part('loop-service'); ?>

            <?php get_template_part('pagination'); ?>

        </section>
        <!-- /section -->
    </main>

<?php get_footer(); ?>