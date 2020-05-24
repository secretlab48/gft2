<?php global $gft; ?>

                <footer class="footer" role="contentinfo">
                    <!--<?php
                    echo
                    '';

                    ?>-->

                    <?php echo gft_het_cta_block(); ?>

                    <div class="footer-box container">
                        <div class="footer-item-box">
                            <div class="footer-logo-box">

                                <div class="footer-logo-2">
                                    <?php echo $gft['logo2']; ?>
                                </div>

                                <div class="footer-logo-1">
                                    <?php echo $gft['logo1']; ?>
                                </div>


                            </div>
                            <div class="logo-description">Gesellschaft für Telekommunikation und Alarmauswertung mbH</div>
                        </div>
                        <div class="footer-item-box">
                            <div class="footer-menu-title">Sicherheitsdienstleistungen</div>
                            <?php wp_nav_menu( array( 'menu' => 'footer-category-menu-1', 'container' => false, 'menu_class' => 'footer-menu fm-1', 'walker' => new Bottom_Walker_Nav_Menu() ) ); ?>
                        </div>
                        <div class="footer-item-box">
                            <div class="footer-menu-title">Sicherheitslösungen</div>
                            <?php wp_nav_menu( array( 'menu' => 'footer-category-menu-2', 'container' => false, 'menu_class' => 'footer-menu fm-2', 'walker' => new Bottom_Walker_Nav_Menu() ) ); ?>
                        </div>

                        <div class="footer-item-box">
                            <div class="footer-menu-title">Über GFT</div>
                            <?php wp_nav_menu( array( 'menu' => 'footer-pages-menu', 'container' => false, 'menu_class' => 'footer-menu fm-3', 'walker' => new Bottom_Walker_Nav_Menu() ) ); ?>
                        </div>
                    </div>

                    <div class="footer-bottom">
                        <div class="footer-bottom-content container p0">
                            <div class="copyrights">© GFT Sicherheit. Alle Rechte vorbehalten.</div>
                            <?php wp_nav_menu( array( 'menu' => 'footer-bottom-menu', 'container' => false, 'menu_class' => 'footer-bottom-menu' ) ); ?>
                        </div>
                    </div>

                </footer>



                <?php wp_footer(); ?>

            </div> <!-- site-wrapper -->

        </div> <!-- site-container -->

	</body>
</html>
