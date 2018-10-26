<?php get_header(); ?>

<div class="notFountWrapper">
    <div class="notFountImg">
        <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/snow.gif" alt="">
    </div>

    <div class="notFountInfos">
        <div class="notFountTitle">404</div>
        <div class="notFountMessage">
            <p><?php _e('The requested file', 'radiium') ?></p>
            <p><?php _e('was not found. Oh no...', 'radiium') ?></p>
            <p class="returnLink"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="works"><?php _e('Return at /home', 'radiium') ?></a></p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
