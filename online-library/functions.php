<?php
/**
 * Online Library functions and definitions
 *
 * @package Online Library
 */

if ( ! function_exists( 'online_library_setup' ) ) :
function online_library_setup() {
	
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

    load_theme_textdomain( 'online-library', get_template_directory() . '/languages' );
    
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
			
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

    add_theme_support('woocommerce');

	// Enqueue editor styles.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	if (! defined('ONLINE_LIBRARY_VERSION')) {
		// Replace the version number of the theme on each release.
		define('ONLINE_LIBRARY_VERSION', wp_get_theme()->get('Version'));
	}

	require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

	require get_parent_theme_file_path( '/inc/admin/theme-upsell.php' );

    require get_parent_theme_file_path( '/inc/customizer/customizer.php' );
}
endif; // online_library_setup
add_action( 'after_setup_theme', 'online_library_setup' );

function online_library_scripts() {
    wp_enqueue_style( 'online-library-basic-style', get_stylesheet_uri() );

	wp_enqueue_script( 'online-library-wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

	wp_enqueue_style( 'online-library-animate-css', get_template_directory_uri().'/assets/css/animate.css' );

    //font-awesome
	wp_enqueue_style( 'online-library-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.css', array(), '6.7.0' );

    wp_style_add_data( 'online-library-basic-style', 'rtl', 'replace' );

    //homepage slider
	wp_enqueue_style( 'online-library-owl.carousel-style', get_template_directory_uri().'/assets/css/owl.carousel.css', array(), ONLINE_LIBRARY_VERSION );
	wp_enqueue_script( 'online-library-owl.carousel-js', get_template_directory_uri(). '/assets/js/owl.carousel.js', array('jquery') ,ONLINE_LIBRARY_VERSION,true);

	// script.js
	wp_enqueue_script('online-library-main-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), ONLINE_LIBRARY_VERSION, true);

}
add_action( 'wp_enqueue_scripts', 'online_library_scripts' );

function online_library_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('online-library-welcome-notice', get_template_directory_uri() . '/inc/dashboard/online-library-welcome-notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('online-library-welcome-notice', 'online_library_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('online_library_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('online_library_welcome_nonce'), // Nonce for dismissal
        'redirect_url' => admin_url('themes.php?page=online-library-guide-page')
    ));
}
add_action('admin_enqueue_scripts', 'online_library_enqueue_admin_script');

function online_library_admin_theme_style() {
   wp_enqueue_style('online-library-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
   wp_enqueue_style('online-library-admin-upsell-style', esc_url(get_template_directory_uri()) . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'online_library_admin_theme_style');

// Block Patterns.
require get_template_directory() . '/block-patterns.php';
require get_template_directory() . '/custom-setting.php';
require_once get_template_directory() . '/inc/dashboard/welcome-notice.php';

/**
 * Redirect to Pro upsell page after theme activation
 */
add_action('after_switch_theme', 'online_library_redirect_after_activation');
function online_library_redirect_after_activation() {
    if ( ! get_option( 'online_library_activation_redirect', false ) ) {
        update_option( 'online_library_activation_redirect', true );
        wp_safe_redirect( admin_url( 'themes.php?page=online-library-pro' ) );
        exit;
    }
}
require get_template_directory() .'/inc/TGM/tgm.php';


add_action( 'admin_bar_menu', 'online_library_add_upgrade_button', 100 );

function online_library_add_upgrade_button( $online_library_wp_admin_bar ) {

    $online_library_theme_name = wp_get_theme()->get( 'Name' );

    $online_library_args = array(
        'id'    => 'online_library_upgrade',
        'title' => '<span style="color:#fff;font-weight:600;">
            🚀 Upgrade to ' . esc_html( $online_library_theme_name ) . ' Pro - 20% OFF 
            <span style="background:#ff5722;color:#fff;padding:2px 8px;border-radius:3px;margin-left:6px;">
                Buy Now
            </span>
        </span>',
        'href'  => esc_url( ONLINE_LIBRARY_BUY_PRO ),
        'meta'  => array(
            'class'  => 'online-library-upgrade-btn',
            'title'  => 'Upgrade to Pro',
            'target' => '_blank'
        )
    );

    $online_library_wp_admin_bar->add_node( $online_library_args );
}