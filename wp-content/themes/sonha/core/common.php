<?php

/**
 * Set content width
 */
if (!isset($CONTENT_WIDTH)) {
    $CONTENT_WIDTH = 620;
}

if (!function_exists('dd')) {
    function dd() {
        foreach (func_get_args() as $value) {
            echo '<pre>';
            echo json_encode($value, JSON_PRETTY_PRINT);
            echo '</pre>';
        }
        exit;
    }
}

/**
 * Register styles or scripts
 *
 * @param  array $stylescripts [
 *      $handle => [$src, $deps = [], $ver = false, $media = 'all'] // for style
 *      or
 *      $handle => [$src, $deps = [], $ver = false, $in_footer = false] // for script
 * ]
 * @param  string $themeUri
 * @param  string $style ['style' | 'script']
 * @return void
 */
function sonha_register_stylescript($stylescripts = [], $themeUri = '', $style = 'style') {
    $themeUri = $themeUri ?: get_template_directory_uri();

    if (!is_array($stylescripts)) {
        $stylescripts = [$stylescripts];
    }

    $wp_register = "wp_register_{$style}";
    $wp_enqueue = "wp_enqueue_{$style}";

    // $args: [$src, $deps = [], $ver = false, $media = 'all']
    foreach ($stylescripts as $handle => $args) {
        if (!is_array($args)) {
            $args = [$args];
        }
        // Automatically add THEME_URI prefix to src path
        if (!empty($args)) {
            $url = $args[0];
            if (!preg_match('#^https?://.+#', $url)) {
                $url = rtrim($themeUri, '/') . '/' . ltrim($args[0], '/');
            }
            $args[0] = $url;
        }
        // Register style or script
        $wp_register($handle, ...$args);
        $wp_enqueue($handle);
    }
}

/**
 * Register styles
 *
 * @param  array $styles [
 *      $handle => [$src, $deps = [], $ver = false, $media = 'all']
 * ]
 * @param  string $themeUri
 * @return void
 */
function sonha_load_styles($styles = [], $themeUri = '') {
    sonha_register_stylescript($styles, $themeUri);
}

/**
 * Register scripts
 *
 * @param  array $scripts
 * @param  mixed $themeUri
 * @return void
 */
function sonha_load_scripts($scripts = [], $themeUri = '') {
    sonha_register_stylescript($scripts, $themeUri, 'script');
}

/**
 * Import <style> tag in <head> tag
 *
 * @param  string $style
 * @return void
 */
function sonha_include_style($style) {
    add_action('wp_head', function () use ($style) {
        echo $style;
    });
    do_action('wp_head');
}

/**
 * Import style (*.css) file in <head> tag
 *
 * @param  string $style_path
 * @return void
 */
function sonha_include_css($style_paths = []) {
    global $wp_version;
    if (!is_array($style_paths)) {
        $style_paths = [$style_paths];
    }
    foreach ($style_paths as $style_path) {
        add_action('wp_head', function () use ($style_path, $wp_version) {
            echo sprintf(
                '<link rel="stylesheet" href="%s?ver=%s" type="text/css">',
                $style_path,
                $wp_version,
            );
        });
    }
    if (!empty($style_paths)) {
        do_action('wp_head');
    }
}

/**
 * Import script (*.js) file in <head> tag
 *
 * @param  string $style_path
 * @return void
 */
function sonha_include_js($script_paths = []) {
    global $wp_version;
    if (!is_array($script_paths)) {
        $script_paths = [$script_paths];
    }
    foreach ($script_paths as $script_path) {
        add_action('wp_footer', function () use ($script_path, $wp_version) {
            echo sprintf(
                '<script type="text/javascript" src="%s?ver=%s"></script>',
                $script_path,
                $wp_version,
            );
        });
    }
    if (!empty($script_paths)) {
        do_action('wp_footer');
    }
}

/**
 * Include file
 *
 * @param  string $file
 * @param  array $params
 * @return void
 */
function sonha_include($file, $params = []) {
    extract($params);
    include($file);
}

/**
 * Get query parameters
 *
 * @param  array $paramsAppended
 * @return array
 */
function sonha_query_params($paramsAppended = []) {
    global $query_string;
    wp_parse_str($query_string, $paramsQuery);
    return $paramsQuery + $paramsAppended;
}

/**
 * Check it is searching
 *
 * @return bool
 */
function sonha_is_searching() {
    global $query_string;
    wp_parse_str($query_string, $paramsQuery);
    return array_key_exists('s', $paramsQuery);
}