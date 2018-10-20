        </div><!-- END contentWrapper -->


        <!-- Footer -->
        <footer class="footer flexRow">
            <div class="flexSpacer"></div>

            <!-- Copyright infos -->
            <p class="" >Copyright &copy; 2016 - <?php echo date( 'Y' ); ?><a class="footerHomeLink" href="<?php echo esc_url( home_url() ); ?>" class="site-name"><?php bloginfo( 'name' ); ?></a></p>

            <!-- Social icons -->
            <div class="section-inner accountBtnBox normalMenu mini">
                <a class="accountBtn" target="_blank" href="https://www.instagram.com/_unlink/" title="Link to instagram!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/instache-logo.svg" alt="">
				</a>

				<a class="accountBtn" target="_blank" href="https://www.facebook.com/Rémi-Rémi-135772170533399/" title="Link to facebook!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/fache-logo.svg" alt="">
				</a>

				<a class="accountBtn gith" target="_blank" href="https://www.github.com/radiium/" title="Link to github!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/gitgit-logo.svg" alt="">
				</a>
            </div>
            <div class="flexSpacer"></div>

        </footer>

        <!-- WP footer's scripts -->
        <div class="footerScripts">
            <?php wp_footer(); ?>
        </div>

    </div><!-- END wrapper -->

</body>
</html>
