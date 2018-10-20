<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- BEGIN wrapper -->
    <div class="wrapper">


    <!-- Header -->
    <div class="headerWrapper">
        <header class="header flexRow">

            <!-- Logo -->
            <div class="logo flexCol">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <div class="name"><?php bloginfo( 'name' ); ?></div>
                <div class="description"><?php bloginfo( 'description' ); ?></div>
                </a>
            </div>
            <div class="flexSpacer"></div>


            <!-- Desktop nav -->
            <div class="menuDesktop flexSpacer">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'radiiumMenu',
                    'menu_id' => 'menuRow',
                    'menu_class' => 'flexRow'
                ) );
                ?>
            </div>

            <!-- Toogle Mobil nav button -->
            <div class="menuMobilBtn menuMobilItem">
                <img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/plus.png" alt="">
            </div>

        </header>

        <!-- Mobil nav -->
        <div class="menuMobil menuMobilItem flexCol">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'radiiumMenu',
                'menu_id' => 'menuCol',
                'menu_class' => 'flexCol'
            ) );
            ?>

            <!-- Social icons -->
            <div class="section-inner accountBtnBox headerAccountBtnBox normalMenu">
                <a class="accountBtn" target="_blank" href="https://www.instagram.com/_unlink/" title="Link to instagram!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/instache-logo.svg" alt="">
				</a>

				<a class="accountBtn" target="_blank" href="https://www.facebook.com/Rémi-Rémi-135772170533399/" title="Link to facebook!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/fache-logo.svg'" alt="">
				</a>

				<a class="accountBtn gith" target="_blank" href="https://www.github.com/radiium/" title="Link to github!">
				<img src="<?php echo get_site_url() ?>/wp-content/uploads/assets/gitgit-logo.svg" alt="">
				</a>
            </div>

            <!-- Copyright infos -->
            <p class="" >Copyright &copy; 2016 - <?php echo date( 'Y' ); ?>&nbsp;&nbsp;&nbsp;<a class="footerHomeLink" href="<?php echo esc_url( home_url() ); ?>" class="site-name"><?php bloginfo( 'name' ); ?></a></p>

        </div>

    </div><!-- END Navigation -->

    <!-- BEGIN contentWrapper -->
    <div class="contentWrapper">
