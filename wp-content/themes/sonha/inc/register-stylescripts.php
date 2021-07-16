<?php

/**
 * Register styles and scripts
 */
function sonha_stylescripts() {
    sonha_load_styles([
        'reset-style'     => ['/assets/css/reset.css', 'all'],
        'main-style'      => ['/assets/css/style.css', 'all'],
        // SuperFish plugin
        'superfish-style' => ['/assets/css/superfish.css', 'all'],
        'zmdi-style' => ['https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css', 'all'],
    ]);
    sonha_load_scripts([
        // SuperFish plugin
        'superfish-script' => ['/assets/js/superfish.js', ['jquery']],
        // Custom script
        'custom-script'    => ['/assets/js/custom.js', ['jquery']],
    ]);

    // Add script for reply comment
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sonha_stylescripts');