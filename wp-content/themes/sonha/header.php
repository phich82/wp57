<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="http://gmgp.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback'); ?>" />
    <!-- Inserting more codes here -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="container">
        <div class="logo">
            <div class="site-name">
                <?php
                global $sonha_theme_options;
                if ($sonha_theme_options['logo_enable'] == 0) {
                    printf(
                        '<h%s><a href="%s" title="%s">%s</a></h%s>',
                        is_home() ? '1' : '3',
                        get_bloginfo('url'),
                        get_bloginfo('description'),
                        get_bloginfo('sitename'),
                        is_home() ? '1' : '3',
                    );
                } else {
                    $logo_url = $sonha_theme_options['logo']['thumbnail'] ?: $sonha_theme_options['logo']['url'];
                    echo '<img src="'.$logo_url.'" />';
                }
                ?>
            </div>
            <div class="site-description">
                <?php bloginfo('description'); ?>
            </div>
        </div>
        <div class="site-menu">
            <?php
            wp_nav_menu([
                'theme_location' => MAIN_MENU,
                // 'container' => 'nav',
                // 'container_class' => 'primary-menu',
                // 'items_wrap' => '<ul id="%s" class="%s sf-menu">%s</ul>',
                'container' => false,
                'fallback_cb' => false,
                'depth' => 5,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'menu_class' => 'navbar-nav dropdown',
                'walker' => new Sonha_Custom_Nav_Walker(), // custom wp menu
            ]);
            ?>

            <?php get_search_form(); ?>
        </div>