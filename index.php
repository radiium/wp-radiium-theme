
<?php get_header(); ?>


    <!-- BEGIN contentWrapper -->
    <div class="contentWrapper flexSpacer">
    <?php

    if ( have_posts() ) :

        // All articles page
        if ( is_front_page() ) :

            get_template_part( 'templates/content' );

        // Single pages
        elseif ( ! is_front_page() && is_single()) :
            while ( have_posts()) : the_post();

                // Single attachment page
                if (get_post_type() == 'attachment') {
                    get_template_part( 'templates/content', 'single-attachment' );

                // Single post page
                } else {
                    get_template_part( 'templates/content', 'single' );
                }
            endwhile;

        // Other page(s)
        else :
            while ( have_posts()) : the_post();
                the_content();
            endwhile;
        endif;

    endif;
    ?>
    </div><!-- END contentWrapper -->

<?php get_footer(); ?>