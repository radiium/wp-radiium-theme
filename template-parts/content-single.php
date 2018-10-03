

<div id="post-<?php the_ID(); ?>" class="singlePostWrapper">
    <div class="singlePostContainer">

        <!-- Gallery infos -->
        <div class="singlePostInfos">
            <div class="singlePostInfosHeader flexRow">
                <div class="returnBtn">
                    <a class="footerHomeLink" href="<?php echo esc_url( home_url() ); ?>">
                    <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/arrow_return.png" alt="">
                    </a>
                </div>
                <div class="title flexSpacer"><?php the_title_attribute(); ?></div>
            </div>

            <!-- Post text -->
            <div class="singlePostInfosText">
                <?php
                add_filter('the_content', 'remove_shortcode_from');
                the_content();
                remove_filter('the_content', 'remove_shortcode_from');
                ?>
            </div>
        </div>

        <!-- Post Gallery -->
        <?php
        echo get_post_gallery();
        ?>

    </div>

    <!-- Scroll control -->
    <div class="controlWrapper">
        <div class="prevBtn postNavBtn flexRow">
            <img class="prevBtnIco" src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/arrow_left.png" alt="">
            <!--
                <span class="prevBtnText">Prev</span>
            -->
        </div>

        <div class="nextBtn postNavBtn flexRow">
            <!--
                <span class="nextBtnText">Next</span>
            -->
            <img class="nextBtnIco" src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/arrow_right.png" alt="">
        </div>
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


