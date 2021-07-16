<?php

if (!function_exists('sonha_register_menus')) {
    function sonha_register_menus() {
        // register_nav_menu(MAIN_MENU , __('Primary Menu', TEXT_DOMAIN));
        register_nav_menus([
            MAIN_MENU => __('Primary Menu', TEXT_DOMAIN),
            'submenu' => __('Submenu', TEXT_DOMAIN),
        ]);
    }
    add_action('after_setup_theme', 'sonha_register_menus', 0);
}
