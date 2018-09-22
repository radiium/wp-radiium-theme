
<?php get_header(); ?>

<?php

if ( have_posts() ) :

    // All articles page
    if ( is_front_page() ) :

        echo '<div class="postsGridWrapper">';
        echo '<div class="postsGrid">';
        while ( have_posts()) : the_post();

            echo '<div class="postItem">';
            ?>

            <a class="postItemLink" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                <div class="postItemThumb">
                    <?php
                    $thumb = has_post_thumbnail() ? the_post_thumbnail( 'large' ) : '<div class="postItemThumbReplace"></div>';
                    echo $thumb;
                    ?>
                    <div class="overlay absoluteHW flexCol"></div>
                    <div class="postTitle absoluteHW flexCol"><?php the_title() ?></div>
                </div>
            </a>

            <?php
            echo '</div>';

        endwhile;
        echo '</div>';
        echo '</div>';

    // Single pages
    elseif ( ! is_front_page() && is_single()) :
        while ( have_posts()) : the_post();

            // Single attachment page
            if (get_post_type() == 'attachment') {
                get_template_part( 'template-parts/content', 'single-attachment' );

            // Single post page
            } else {
                get_template_part( 'template-parts/content', 'single' );
            }
        endwhile;

    // Other page(s)
    else :

        $pagename = get_query_var('pagename');
        if ( !$pagename && $id > 0 ) {
            // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
            $post = $wp_query->get_queried_object();
            $pagename = $post->post_name;
        }

        while ( have_posts()) : the_post();
            if ($pagename == 'contact') {
                get_template_part( 'template-parts/content', 'contact' );
            } else {
                the_content();
            }
        endwhile;
    endif;

endif;
?>

<?php get_footer(); ?>