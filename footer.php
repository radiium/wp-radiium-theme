
        <!-- Footer -->
        <div class="footerWrapper">

            <div class="navFooter">
                <!-- Social icons -->
                <div class="socialBtnWrapper">
                    <a class="socialBtn" target="_blank" href="https://www.instagram.com/_unlink/" title="Link to instagram!">
                    <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/instache-logo.svg" alt="">
                    </a>

                    <a class="socialBtn" target="_blank" href="https://www.facebook.com/Rémi-Rémi-135772170533399/" title="Link to facebook!">
                    <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/fache-logo.svg" alt="">
                    </a>

                    <a class="socialBtn gith" target="_blank" href="https://www.github.com/radiium/" title="Link to github!">
                    <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/gitgit-logo.svg" alt="">
                    </a>
                </div>

                <!-- Copyright infos -->
                <p class="copyright" >
                    <span>&copy;&nbsp;</span>
                    <span><?php bloginfo( 'name' ); ?>,&nbsp;</span>
                    <span><?php echo date( 'Y' ); ?></span>
                </p>
            </div>
        </div>

        <!-- WP footer's scripts -->
        <div class="footerScripts">
            <?php wp_footer(); ?>
        </div>

    </div><!-- END wrapper -->

</body>
</html>
