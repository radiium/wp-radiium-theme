<?php
    function radiium_get_the_tags() {
        $tags = get_the_tags();
        $html = '<div class="postTags">';
        $html .= '<div>Tags: &nbsp;</div>';

        foreach ( $tags as $tag ) {
            $html .= '<div>'.$tag->name.'&nbsp;</div>';
        }
        $html .= '</div>';
        echo $html;
    }
?>

<div id="post-<?php the_ID(); ?>" class="singlePostWrapper">
    <div class="singlePostContainer">

        <!-- Gallery infos -->
        <div class="singlePostInfos flexCol">

            <!-- Return to home button -->
            <div class="returnBtn singlePostInfosItem" title="Return">
                <a class="" href="<?php echo esc_url( home_url() ); ?>">
                <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/arrow_return.png" alt="">
                </a>
            </div>

            <!-- Post Title -->
            <div class="singlePostInfosTitle singlePostInfosItem"><?php the_title_attribute(); ?></div>

            <!-- Post Title -->
            <div class="singlePostInfosTags singlePostInfosItem"><?php radiium_get_the_tags(); ?></div>


            <!-- Post text -->
            <div class="singlePostInfosText singlePostInfosItem">
                <?php
                    $content_shortcode = preg_replace( '/\[gallery(.*?)\]/s' , '' , get_the_content() );
                    $content = do_shortcode($content_shortcode);
                    echo $content;
                    // add_filter('the_content', 'remove_shortcode_from');
                    // the_content();
                    // remove_filter('the_content', 'remove_shortcode_from');
                ?>
            </div>
        </div>

        <!-- Post Gallery -->
        <?php
        echo get_post_gallery();
        ?>

    </div>
</div>


<!-- Photoswipe viewer -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>


