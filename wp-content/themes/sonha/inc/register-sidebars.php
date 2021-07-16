<?php

if (!function_exists('sonha_register_sidebars')) {
    function sonha_register_sidebars() {
        register_sidebar([
            'name' => __('Primary Sidebar', TEXT_DOMAIN),
            'id' => PRIMARY_SIDEBAR,
            'description' => __('Primary sidebar', TEXT_DOMAIN),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
        ]);
        register_sidebar([
            'name'         => __('Main Sidebar', TEXT_DOMAIN),
            'id'           => MAIN_SIDEBAR,
            'description'  => __('Default Sidebar'),
            'class'        => MAIN_SIDEBAR,
            'before_title' => '<h3 class = "widget-title">',
            'after_title'  => '</h3>',
        ]);
        // sidebar for footer
        register_sidebar([
            'name'         => __('Footer Sidebar', TEXT_DOMAIN),
            'id'           => FOOTER_SIDEBAR,
            'description'  => __('Footer Sidebar'),
            'class'        => FOOTER_SIDEBAR,
            'before_title' => '<h3 class = "widget-title">',
            'after_title'  => '</h3>',
        ]);
    }
    add_action('widgets_init', 'sonha_register_sidebars');
}