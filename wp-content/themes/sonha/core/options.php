<?php
/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

if ( ! class_exists( 'Redux' ) ) {
	return null;
}

// This is your option name where all the Redux data is stored.
// global $sonha_redux_data;
$opt_name = 'sonha_theme_options';

// Label displayed for theme options menu
$label_theme_options = 'Theme Options';

$google_api_key = 'AIzaSyC3sI9CJL4vlqzVxHCJK6DqEyWAUvrzX3o';

/**
 * GLOBAL ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: @link https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 */

/**
 * ---> BEGIN ARGUMENTS
 */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// REQUIRED!!  Change these values as you need/desire.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	'menu_title'                => esc_html__( $label_theme_options, TEXT_DOMAIN),
	'page_title'                => esc_html__( $label_theme_options, TEXT_DOMAIN ),
	'google_api_key' 			=> $google_api_key,

	// Use a asynchronous font on the front end or font string.
	'async_typography'          => true,

	// Disable this in case you want to create your own google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Choose an icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Choose an priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Set a different name for your global variable other than the opt_name.
	'global_variable'           => '',

	// Show the time the page took to load, etc.
	'dev_mode'                  => true,

	// Enable basic customizer support.
	'customizer'                => true,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => null,

	// For a full list of options, visit: @link http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel.
	'page_slug'                 => '_options',

	// On load save the defaults to DB before user clicks save or not.
	'save_defaults'             => true,

	// If true, shows the default value next to each field that is not the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default. Suggested: *.
	'default_mark'              => '',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// CAREFUL -> These options are for advanced use only.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head.
	'output_tag'                => true,

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',

	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
	'use_cdn'                   => true,
	'compiler'                  => true,

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'light',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
	'id'    => 'redux-docs',
	'href'  => '//devs.redux.io/',
	'title' => esc_html__( 'Documentation', TEXT_DOMAIN ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => esc_html__( 'Support', TEXT_DOMAIN ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-extensions',
	'href'  => 'redux.io/extensions',
	'title' => esc_html__( 'Extensions', TEXT_DOMAIN ),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
	'url'   => '//github.com/ReduxFramework/ReduxFramework',
	'title' => 'Visit us on GitHub',
	'icon'  => 'el el-github',
);
$args['share_icons'][] = array(
	'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
	'title' => esc_html__( 'Like us on Facebook', TEXT_DOMAIN ),
	'icon'  => 'el el-facebook',
);
$args['share_icons'][] = array(
	'url'   => '//twitter.com/reduxframework',
	'title' => esc_html__( 'Follow us on Twitter', TEXT_DOMAIN ),
	'icon'  => 'el el-twitter',
);
$args['share_icons'][] = array(
	'url'   => '//www.linkedin.com/company/redux-framework',
	'title' => esc_html__( 'FInd us on LinkedIn', TEXT_DOMAIN ),
	'icon'  => 'el el-linkedin',
);

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}
	$args['intro_text'] = '<p>' . sprintf( __( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $s', TEXT_DOMAIN ) . '</p>', '<strong>' . $v . '</strong>' );
} else {
	$args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', TEXT_DOMAIN ) . '</p>';
}

// Add content after the form.
$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', TEXT_DOMAIN ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> BEGIN HELP TABS
 */

$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', TEXT_DOMAIN ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', TEXT_DOMAIN ) . '</p>',
	),

	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', TEXT_DOMAIN ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', TEXT_DOMAIN ) . '</p>',
	),
);

Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', TEXT_DOMAIN ) . '</p>';
Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> BEGIN SECTIONS
 *
 */

/* As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for. */

/* -> START Basic Fields. */

$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
);

/**
 * Setting <Header>: logo
 */
$section = array(
	'title'  => esc_html__( 'Header', TEXT_DOMAIN ),
	'id'     => 'header',
	'desc'   => esc_html__( 'All settings for header on this theme.', TEXT_DOMAIN ),
	'icon'   => 'el el-home', //Ref: http://elusiveicons.com/icons/
	'fields' => array(
		array(
			'id'       => 'logo_enable',
			'type'     => 'switch',
			'compiler' => true,
			'on' 	   => 'Enable',
			'off' 	   => 'Disable',
			'title'    => esc_html__( 'Enable Logo Image', TEXT_DOMAIN ),
			'desc'     => esc_html__( 'Do you want to enable logo image?', TEXT_DOMAIN ),
			'subtitle' => esc_html__( 'Toggle logo image.', TEXT_DOMAIN ),
			'hint'     => array(
				'content' => wp_kses( __( 'When you click on <strong>Enable</strong>, logo will be shown.<br/>Otherwise, it won\'t be shown.', TEXT_DOMAIN ), $kses_exceptions ),
			),
			'default'  => true,
		),
		array(
			'id'       => 'logo',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Image', TEXT_DOMAIN ),
			'desc'     => esc_html__( 'Image that you want to use as logo.', TEXT_DOMAIN ),
			'hint'     => array(
				'content' => wp_kses( __( 'Click on the <strong>Upload</strong> button bellow in order to upload a image as logo.', TEXT_DOMAIN ), $kses_exceptions ),
			),
		),
	),
);

Redux::set_section( $opt_name, $section );

/**
 * Setting <Typography>: fonts, colors
 */
$section = array(
	'title'  => esc_html__( 'Typography', TEXT_DOMAIN ),
	'id'     => 'typography',
	'desc'   => esc_html__( 'All settings for typography on this theme.', TEXT_DOMAIN ),
	'icon'   => 'el el-font',
	'fields' => array(
		array(
			'id'       => 'typography',
			'type'     => 'typography',
			'title'    => esc_html__( 'Main Typography', TEXT_DOMAIN ),
			'output' 		 => ['body'],
			'text-transform' => true,
			'default' 		 => array(
				'font-size'   => 14,
				'font-family' => 'Helvetica Neue, Arial, sans-serif',
				'color'  	  => '#333333',
			),
		),
	),
);

Redux::set_section( $opt_name, $section );

$section = array(
	'title' => __( 'Advanced', TEXT_DOMAIN ),
	'id'    => 'advanced',
	'desc'  => __( 'All advance settings on this theme.', TEXT_DOMAIN ),
	'icon'  => 'el el-cogs',
);

Redux::set_section( $opt_name, $section );

$section = array(
	'title'      => esc_html__( 'Slogan', TEXT_DOMAIN ),
	'desc'       => esc_html__( 'This is a slogan for your site.', TEXT_DOMAIN ),
	'id'         => 'slogan_section',
	'icon'  	 => 'el el-smiley-alt',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'slogan',
			'type'     => 'text',
			'title'    => esc_html__( 'Slogan Content', TEXT_DOMAIN ),
			'desc'     => esc_html__( 'Enter a your slogan.', TEXT_DOMAIN ),
			'default'  => 'Your slogan here',
		),
	),
);

Redux::set_section( $opt_name, $section );

$section = array(
	'title'      => esc_html__( 'Currency', TEXT_DOMAIN ),
	'desc'       => __( 'This is a currency setting for payment.<br /> More details, please vist: ', TEXT_DOMAIN ) . '<a href="https://www.xe.com" target="_blank">https://www.xe.com</a>',
	'id'         => 'currency_section',
	'icon'       => 'el el-eur',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'currency',
			'type'     => 'text',
			'title'    => esc_html__( 'Set Currency', TEXT_DOMAIN ),
			'desc'     => esc_html__( 'Enter your currency.', TEXT_DOMAIN ),
			'default'  => 'USD',
		),
	),
);

Redux::set_section( $opt_name, $section );

/*
 * <--- END SECTIONS
 */
