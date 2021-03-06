<?php

// define ('WPLANG', 'fr_FR');
define ('WPLANG', 'en_EN');


/**
 *  Init radiium theme
 */
if ( ! function_exists( 'radiium_setup' ) ) {
    function radiium_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'radiiumMenu' => esc_html( 'Primary', 'radiium' ),
        ) );
        add_theme_support( 'custom-background', apply_filters( 'radiium_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
        ) ) );
        add_theme_support( 'custom-logo', array(
			'height'      => 100,
	        'width'       => 400,
			'flex-width'  => true,
            'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' )
        ) );
        load_theme_textdomain( 'radiium', get_template_directory() . '/languages' );
    }

    add_action( 'after_setup_theme', 'radiium_setup' );
}


/**
 *  Load custom Scripts and Styles
 */
if ( ! function_exists( 'radiium_scripts' ) ) {
	function radiium_scripts() {

        // Load Shufflejs script
        if( is_front_page() ) {
            // wp_enqueue_script( 'hull', get_template_directory_uri() . '/assets/vendor/hull.js');

            wp_enqueue_script( 'shuffle-js', get_template_directory_uri() . '/assets/vendor/Shuffle-5.2.1/shuffle.min.js' );
            wp_enqueue_script( 'polydiv', get_template_directory_uri() . '/assets/scripts/polydiv.min.js' );
            wp_enqueue_script( 'radiium-content', get_template_directory_uri() . '/assets/scripts/radiium.content.min.js', array('jquery') );
        }

        // Load Photoswipe scripts and default styles only on single post
        if ( is_single() ) {
            wp_enqueue_style( 'photoswipe-css', get_template_directory_uri() . '/assets/vendor/PhotoSwipe-4.1.2/photoswipe.min.css' );
            wp_enqueue_style( 'photoswipe-default-skin-css', get_template_directory_uri() . '/assets/vendor/PhotoSwipe-4.1.2/default-skin/default-skin.min.css' );
            wp_enqueue_script( 'photoswipe-js', get_template_directory_uri() . '/assets/vendor/PhotoSwipe-4.1.2/photoswipe-ui-default.min.js' );
            wp_enqueue_script( 'photoswipe-ui-default-js', get_template_directory_uri() . '/assets/vendor/PhotoSwipe-4.1.2/photoswipe.min.js' );
            wp_enqueue_script( 'scroll-reveal-js', get_template_directory_uri() . '/assets/vendor/scrollReveal/scroll-reveal.min.js');
            wp_enqueue_script( 'radiium-content-post', get_template_directory_uri() . '/assets/scripts/radiium.content-post.min.js', array('jquery') );
        }

        // Main script ans style
        wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/assets/vendor/Imagesloaded-4.1.4/imagesloaded.pkgd.min.js' );
        wp_enqueue_style( 'radiium-theme-style', get_stylesheet_uri() );
        wp_enqueue_script( 'radiium-main', get_template_directory_uri() . '/assets/scripts/radiium.main.min.js', array('jquery') );
	}
    add_action( 'wp_enqueue_scripts', 'radiium_scripts' );
}


/**
 *
 *  Customisation
 *
 */

/**
 *  Override wordpress gallery
 *
 *  Add special attributes for modal gallery
 * (see => http://photoswipe.com/)
 */
if ( ! function_exists( 'customFormatGallery' ) ) {
	function customFormatGallery( $string, $attr ) {

        $posts_order_string = $attr['ids'];
        $posts_order = explode( ',', $posts_order_string );

        $posts = get_posts( array(
              'include' => $posts_order,
              'post_type' => 'attachment',
              'orderby' => 'post__in'
        ) );

        if ( $attr['orderby'] == 'rand' ) {
            shuffle( $posts );
        }

        $i = 0;
        $output = '<div class="singlePostContent" itemscope itemtype="http://schema.org/ImageGallery">';

        foreach( $posts as $imagePost ) {
            $srcMed = wp_get_attachment_image_src( $imagePost->ID, 'mediium' )[0];
            $imgFull = wp_get_attachment_image_src( $imagePost->ID, 'full' );

            // Caption and alt text
            $radiium_title = get_post_meta($imagePost->ID, 'radiium_title', true);
            $radiium_tech = get_post_meta($imagePost->ID, 'radiium_tech', true);
            $radiium_format = get_post_meta($imagePost->ID, 'radiium_format', true);
            $radiium_year = get_post_meta($imagePost->ID, 'radiium_year', true);
            $alt = $radiium_title.' - '.$radiium_tech.' - '.$radiium_format.'- '.$radiium_year;

            $output .=
            '<figure id="galItem-'.$i.'"class="galItem">'.
            '   <a class="galItemThumb" href="'.$imgFull[0].'" itemprop="contentUrl" data-size="'.$imgFull[1].'x'.$imgFull[2].'">'.
            '       <img src="'.$srcMed.'" alt="'.$alt.'" itemprop="thumbnail" draggable="false" />'.
            '   </a>'.
            '   <figcaption class="galItemInfos" itemprop="caption description">';
                if ( $radiium_title != '' ) {
                    $output .= '<div class="galItemTitle">'.$radiium_title.'</div>';
                }
                $meta = array();
                if ( $radiium_tech != '' ) {
                    array_push($meta, $radiium_tech);
                }
                if ( $radiium_format != '' ) {
                    array_push($meta, $radiium_format);
                }
                if ( $radiium_year != '' ) {
                    array_push($meta, $radiium_year);
                }
                if (count($meta) > 0) {
                    $output .=  '<div class="galItemMeta">'.join(', ', $meta).'</div>';
                }

            $output .= '</figcaption></figure>';
            $i++;
        }
        $output .= "</div>";

        return $output;
    }
    add_filter('post_gallery', 'customFormatGallery', 10, 2);
}


/**
 *  Filter shortcode from content
 *  (For get post content without the gallery)
 */
if ( ! function_exists( 'remove_shortcode_from' ) ) {
    function remove_shortcode_from($content) {
        $content = strip_shortcodes( $content );
        return $content;
    }
}


/**
 *  Add custom media fields
 *  (For images caption)
 *
 *      * fields:
 *      ---------
 *      - radiium_title  : Title
 *      - radiium_tech   : Artistic technique
 *      - radiium_format : real dimension of the work
 *      - radiium_year   : year of creation
 */
if ( ! function_exists( 'radiium_add_media_custom_field' ) ) {
    function radiium_add_media_custom_field( $form_fields, $post ) {

        $radiium_title = get_post_meta( $post->ID, 'radiium_title', true );
        $form_fields['radiium_title'] = array(
            'value' => $radiium_title ? $radiium_title : '',
            'label' => __( 'Title', 'radiium' ),
            'helps' => __( 'Enter title', 'radiium' ),
            'input'  => 'text'
        );

        $radiium_tech = get_post_meta( $post->ID, 'radiium_tech', true );
        $form_fields['radiium_tech'] = array(
            'value' => $radiium_tech ? $radiium_tech : '',
            'label' => __( 'Technical', 'radiium' ),
            'helps' => __( 'Enter technical', 'radiium' ),
            'input'  => 'text'
        );

        $radiium_format = get_post_meta( $post->ID, 'radiium_format', true );
        $form_fields['radiium_format'] = array(
            'value' => $radiium_format ? $radiium_format : '',
            'label' => __( 'Format', 'radiium' ),
            'helps' => __( 'Enter format', 'radiium' ),
            'input'  => 'text'
        );

        $radiium_year = get_post_meta( $post->ID, 'radiium_year', true );
        $form_fields['radiium_year'] = array(
            'value' => $radiium_year ? $radiium_year : '',
            'label' => __( 'Year', 'radiium' ),
            'helps' => __( 'Enter year', 'radiium' ),
            'input'  => 'text'
        );
        return $form_fields;
    }
    add_filter( 'attachment_fields_to_edit', 'radiium_add_media_custom_field', null, 2 );
}



/**
 *  Save custom fields
 */
if ( ! function_exists( 'radiium_save_attachment' ) ) {
    function radiium_save_attachment( $attachment_id ) {

        if ( isset( $_REQUEST['attachments'][ $attachment_id ]['radiium_title'] ) ) {
            $radiium_title = $_REQUEST['attachments'][ $attachment_id ]['radiium_title'];
            update_post_meta( $attachment_id, 'radiium_title', $radiium_title );
        }

        if ( isset( $_REQUEST['attachments'][ $attachment_id ]['radiium_tech'] ) ) {
            $radiium_tech = $_REQUEST['attachments'][ $attachment_id ]['radiium_tech'];
            update_post_meta( $attachment_id, 'radiium_tech', $radiium_tech );
        }

        if ( isset( $_REQUEST['attachments'][ $attachment_id ]['radiium_format'] ) ) {
            $radiium_format = $_REQUEST['attachments'][ $attachment_id ]['radiium_format'];
            update_post_meta( $attachment_id, 'radiium_format', $radiium_format );
        }

        if ( isset( $_REQUEST['attachments'][ $attachment_id ]['radiium_year'] ) ) {
            $radiium_year = $_REQUEST['attachments'][ $attachment_id ]['radiium_year'];
            update_post_meta( $attachment_id, 'radiium_year', $radiium_year );
        }
    }
    add_action( 'edit_attachment', 'radiium_save_attachment' );
}



/**
 *  Custom image shortcode
 *
 *  example: [radiium_image id="" class="" type=""]
 */
if ( !function_exists('radiium_image_shortcode' ) ) {
    function radiium_image_shortcode($atts, $content = null) {
        $args = array(
            'id' => '',
            'class' => ''
        );
        extract(shortcode_atts($args, $atts));
        $img = wp_get_attachment_image_src( $atts['id'], 'full' );
        $html = '<img class="'.$atts['class'].'" src="'.$img[0].'" alt="" />';

        return $html;
    }
    add_shortcode('radiium_image', 'radiium_image_shortcode');
}

/**
 *  Custom text bloc shortcode
 *
 *  example: [bloc fr="" en=""]
 */
if ( !function_exists('radiium_text_block_shortcode' ) ) {
    function radiium_text_bloc_shortcode( $atts ) {

        // Attributes
        $atts = shortcode_atts(
            array(
                'fr' => '',
                'en' => '',
            ),
            $atts
        );

        $frFlagSrc = get_site_url().'/wp-content/themes/radiium/assets/images/fr-flag.png';
        $enFlagSrc = get_site_url().'/wp-content/themes/radiium/assets/images/en-flag.png';

        $html = '';
        $html .= '<div class="textBloc">';
        $html .= '  <div class="tabMenu">';
        $html .= '      <img src="'.$frFlagSrc.'" alt="" class="tabMenuItem1 tabMenuItem active" />';
        $html .= '      <img src="'.$enFlagSrc.'" alt="" class="tabMenuItem2 tabMenuItem"/>';
        $html .= '  </div>';
        $html .= '  <div id="tabContent1" class="tabContent">'.$atts['fr'].'</div>';
        $html .= '  <div id="tabContent2" class="tabContent" style="display: none;">'.$atts['en'].'</div>';
        $html .= '</div>';

        return $html;

    }
    add_shortcode( 'bloc', 'radiium_text_bloc_shortcode' );
}


/**
 *  Remove useless wordpress stuff in head tag
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

?>