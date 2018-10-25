<?php

    if ( ! function_exists( 'get_radiium_post_links' ) ) {
        function get_radiium_post_links() {
            $output = '';
            $postsID = get_posts(array( 'fields' => 'ids', 'posts_per_page'  => -1 ));
            foreach ($postsID as $id) {
                $link = get_permalink( $id );
                $title = get_the_title( $id );

                $output .=  '<div class="navItem">';
                $output .=  '<div> <a href="'.$link.'">'.$title.'</a></div>';
                $output .=  '</div>';
            }
            return $output;
        }
    }


    if ( ! function_exists( 'get_radiium_pages_links' ) ) {
        function get_radiium_pages_links() {
            $output = '';
            $locations = get_nav_menu_locations();
            $menu = get_term( $locations['radiiumMenu'], 'nav_menu' );
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            echo '<pre>';
            // print_r($menu_items);
            echo '</pre>';
            foreach ($menu_items as $test) {
                $output .=  '<div class="navItem">';
                $output .=  '<a href="'.$test->url.'">'.$test->title.'</a>';
                $output .=  '</div>';
            }
            return $output;
        }
    }

    if ( ! function_exists( 'get_radiium_menu' ) ) {
        function get_radiium_menu() {
            $output = '';

            $categories = get_categories();
            $nav = array();
            foreach ($categories as $cat) {
                # code...
                $posts = get_posts( array( 'category' => $cat->term_id ) );

                echo '<div class="navSection">';
                echo '<div class="navSectionTitle">'.$cat->name.'</div>';

                foreach ($posts as $p) {
                    // echo $p->post_title;

                    echo '<div class="navItem">';
                    echo '<div> <a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a></div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
    }


    ?>

<div class="navContent">
    oidnf
    <?php
    // get_radiium_menu();

    echo '<pre>';
    print_f(wp_get_nav_menu_items());
    echo '</pre>coucou';


    wp_nav_menu();
    ?>

    <div class="navSection">
    <div class="navSectionTitle">Artwork</div>
    <div class="navSectionContent">
        <?php echo get_radiium_post_links(); ?>
    </div>
    </div>

    <div class="navSection">
    <div class="navSectionTitle">Pages</div>
    <div class="navSectionContent">
        <?php echo get_radiium_pages_links(); ?>
    </div>
    </div>
</div>
