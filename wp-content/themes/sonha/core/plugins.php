<?php

/**
 * Requiring installation for specified plugins
 *
 * @return void
 */
function sonha_plugin_activation() {
    // Plugins required installed
    $plugins = [
        // redux-framework plugin
        [
            'name' => 'Redux Framework',
            'slug' => 'redux-framework', // name of path of plugin
            'required' => true, // force installation
        ],
    ];

    // Setup TGM
    $configs = [
        'menu' => 'tp_plugin_install', // name of path of plugin
        'has_notice' => true, // show notice for requiring plugin installation
        'dismissiable' => false, // turn notice off or not
        'is_automatic' => true, // automatically activate after installed
    ];

    // Register Plugins
    tgmpa($plugins, $configs);
}

// Force installing plugins specified
add_action('tgmpa_register', 'sonha_plugin_activation');