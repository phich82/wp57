<?php
/**
 * Theme functions
 */
if (!function_exists('sonha_theme_setup')) {
    function sonha_theme_setup() {
        /**
         * Setup textdomain
         */
        load_theme_textdomain(TEXT_DOMAIN, THEME_URL.'/'.LANG_FOLDER);
        /**
         * Add Automatically rss link to head tag
         */
        add_theme_support('automatic-feed-links');
        /**
         * Add post thumbnail
         */
        add_theme_support('post-thumbnails');
        /**
         * Add post format
         */
        add_theme_support('post-formats', [
            'image', 'video', 'gallery', 'quote', 'link'
        ]);
        /**
         * Add automatically title tag
         */
        add_theme_support('title-tag');
        /**
         * Add custom background
         */
        add_theme_support('custom-background', ['default-color' => '#e8e8e8']);
        /**
         * Add menu: in menu settings admin
         */
        // register_nav_menu('primary-menu', __('Primary Menu', TEXT_DOMAIN));
    }
    add_action('init', 'sonha_theme_setup');
}