<?php
    get_header( );
?>

<main role="main" class="standard-box">


    <article id="post-404" class="page-404">

        <div class="container not-found-box p0">

            <!--<img class="not-found-img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/error-icon.jpg">-->
            <p>Die von Ihnen gewünschte Seite konnte leider nicht gefunden werden.</p>
            <a href="<? echo site_url(); ?>">Zur Startseite</a>

            <?php /*get_search_form();*/ ?>

        </div>

    </article>


</main>

<?php
    get_footer();
?>