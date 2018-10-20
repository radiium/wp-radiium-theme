<?php get_header(); ?>

<div class="notFountWrapper">
    <div class="notFountImg">
        <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/snow.gif" alt="">
    </div>

    <div class="notFountInfos">
        <div class="notFountTitle">404</div>
        <div class="notFountMessage">
        <p>The requested file</p>
        <p>was not found. Oh no...</p>
        <p class="returnLink"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="works">Return at /home</a></p>


        </div>
    </div>
</div>

<?php get_footer(); ?>
