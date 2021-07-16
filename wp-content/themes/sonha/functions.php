<?php

// Start session on init hook.
add_action( 'init', function() {
    if (!session_id()) {
        session_start();
    }
});

/*===== Define constants =====*/
define('THEME_URI', get_theme_file_uri());// get_template_directory_uri());
define('THEME_URL', get_theme_file_path());// get_stylesheet_directory());
define('CORE_URL', THEME_URL.'/core');
define('INC_URL', THEME_URL.'/inc');
define('LANG_FOLDER', 'languages');
define('MAIN_MENU', 'primary-menu');
define('MAIN_SIDEBAR', 'main-sidebar');
define('PRIMARY_SIDEBAR', 'sonha-primary-sidebar');
define('FOOTER_SIDEBAR', 'sonha-footer-sidebar');
define('TEXT_DOMAIN', 'sonha');
/*===== End - Define constants =====*/

/*===== Loading core, inc files =====*/
require_once(CORE_URL.'/init.php');
require_once(INC_URL.'/init.php');
/*===== End - Loading core, inc files =====*/

/*===== Register hook & filter ======*/
/**
 * @hook filter
 *
 * Readmore content
 */
if (!function_exists('sonha_readmore'))  {
    function sonha_readmore() {
        return '<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__('...[Read More]', TEXT_DOMAIN).'</a>';
    }
}

function is_waiting_approval_comment() {
    return isset($_SESSION) &&
           isset($_SESSION['wait_approval_comment']) &&
           $_SESSION['wait_approval_comment'] === true;
}

function clear_waiting_approval_comment() {
    if (isset($_SESSION['wait_approval_comment'])) {
        unset($_SESSION['wait_approval_comment']);
    }
}

add_filter('excerpt_more', 'sonha_readmore');
// Track status of comment after submitted
add_filter( 'comment_post_redirect', function( $location, $comment ) {
    $_SESSION['wait_approval_comment'] = true;
    return $location;
}, 10, 2 );
/*===== End - Register hook & filter ======*/
