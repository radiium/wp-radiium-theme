<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>



<?php
/*
wp_nav_menu( array(
    'theme_location' => 'radiiumMenu',
    'menu_id' => 'menuRow',
    'menu_class' => 'flexCol'
) );
*/

class MV_Cleaner_Walker_Nav_Menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        /*
        echo '<pre>';
        // print_r($classes);
        echo '</pre>';
        */

        // $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : array();
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<div' . $id . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= '<div class="navLink">';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</div>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    function end_el(&$output, $item, $depth) {
        $output .= "</div>\n";
    }
}
?>

<body <?php body_class(); ?>>

    <!-- BEGIN wrapper -->
    <div class="wrapper">


        <!-- Navigation -->
        <div class="navWrapper">
            <div class="navigation">


                <!-- Nav header -->
                <div class="navBar">
                    <!-- Site logo -->
                    <div class="navLogo flexCol">
                        <a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home">
                        <div class="name"><?php bloginfo( 'name' ) ?></div>
                        <div class="description"><?php bloginfo( 'description' ) ?></div>
                        </a>
                    </div>
                    <!-- Toogle Mobil nav button -->
                    <div class="navTogglelBtn">
                        <img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/plus.png" alt="">
                    </div>
                </div>


                <!-- Nav items -->
                <div class="navItems">
                    <div class="navContent">
                        <?php
                        wp_nav_menu( array(
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'walker' => new MV_Cleaner_Walker_Nav_Menu() )
                        );
                        ?>
                    </div>

                    <div class="navFooter">
                        <!-- Social icons -->
                        <div class="socialBtnWrapper">
                            <a class="socialBtn" target="_blank" href="https://www.instagram.com/_unlink/" title="Link to instagram!">
                            <img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/instache-logo.svg" alt="">
                            </a>

                            <a class="socialBtn" target="_blank" href="https://www.facebook.com/Rémi-Rémi-135772170533399/" title="Link to facebook!">
                            <img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/fache-logo.svg" alt="">
                            </a>

                            <a class="socialBtn gith" target="_blank" href="https://www.github.com/radiium/" title="Link to github!">
                            <img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/gitgit-logo.svg" alt="">
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

            </div>
        </div>
