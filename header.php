<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="description" content="Visual art and others experiences">

    <!-- Social site recognition -->
    <meta property="og:title" content="Rémi Poncet - visual art" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="https://radiium.space/" />
    <meta property="og:image" content="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/plus.png" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- BEGIN wrapper -->
    <div class="wrapper">

        <!-- Return on top button  display: none; opacity: 0; -->
        <div id="toTop">
            <div class="toTopIco">^</div>
        </div>

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

                    <!-- Menu items-->
                    <div class="navContent">
                        <?php wp_nav_menu( array('container' => '') ); ?>
                    </div>

                    <!-- Toogle Mobil nav button -->
                    <div class="navTogglelBtn">
                        <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/plus.png" alt="">
                    </div>
                </div>

                <!-- Nav items -->
                <div class="navItemsMobil">
                    <div class="navContent flexSpacer">
                        <?php wp_nav_menu(); ?>
                    </div>

                    <div class="navFooter">

                        <!-- Social icons -->
                        <div class="socialBtnWrapper">
                            <a class="socialBtn" target="_blank" href="https://www.instagram.com/_unlink/" title="Link to instagram!">
                            <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/instache-logo.svg" alt="">
                            </a>

                            <a class="socialBtn" target="_blank" href="https://www.facebook.com/Rémi-Rémi-135772170533399/" title="Link to facebook!">
                            <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/fache-logo.svg" alt="">
                            </a>

                            <a class="socialBtn gith" target="_blank" href="https://www.github.com/radiium/" title="Link to github!">
                            <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/gitgit-logo.svg" alt="">
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
