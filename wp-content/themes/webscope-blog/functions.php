<?php
/**
 * Webscope Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Webscope_Blog
 */


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load widgets
 */

require get_template_directory() . '/inc/mc_widget.php';

require get_template_directory() . '/inc/yt_widget.php';

require get_template_directory() . '/inc/sn_widget.php';


/**
 * Load banner shortcode
 */
require get_template_directory() . '/inc/ws_banner.php';


/**
 * Load Mailchimp after post
 */

require get_template_directory() . '/inc/mc_after_post.php';


/**
 * Load MailChimp
 */
require get_template_directory() . '/inc/mailchimp.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Register custom navigation walker
require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' );


if ( ! function_exists( 'webscope_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function webscope_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Webscope Blog, use a find and replace
		 * to change 'webscope-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'webscope-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );


		add_image_size( 'slider', 1200, 600, array( 'center', 'bottom' ) );
		add_image_size( 'official', 1200, 800, array( 'center', 'center' ) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'webscope-blog' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'webscope_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


		// Set up the WordPress core custom background feature.
		add_theme_support( 'post-formats', array( 'video', 'image' ) );
	}
endif;
add_action( 'after_setup_theme', 'webscope_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function webscope_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'webscope_blog_content_width', 1200 );
}

add_action( 'after_setup_theme', 'webscope_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function webscope_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'webscope-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'webscope-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'webscope_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function webscope_blog_scripts() {
	wp_enqueue_style( 'webscope-blog-style', get_stylesheet_uri() );

	//load benzo main script and style files
	wp_enqueue_script( 'webscope-blog-script', get_template_directory_uri() . '/dist/bundle.js', array( 'jquery' ), true );
	wp_localize_script( 'webscope-blog-script', 'ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


	wp_enqueue_script( 'webscope-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'webscope_blog_scripts' );


/**
 * Submit email registration
 */

add_action( 'wp_ajax_webscope_mailchimp_submit', 'webscope_mailchimp_submit_callback' );
add_action( 'wp_ajax_nopriv_webscope_mailchimp_submit', 'webscope_mailchimp_submit_callback' );

function webscope_mailchimp_submit_callback(){

	$userEmail = $_POST['email'];
	$firstName = $_POST['firstName'];

	write_log($userEmail);
	write_log($firstName);

	echo sendContactToMailchimp($userEmail, $firstName);

	wp_die();
}




/* ACF Settings */
add_filter( 'acf/settings/path', 'benzo_acf_settings_path' );
add_filter( 'acf/settings/dir', 'benzo_acf_settings_dir' );
//add_filter( 'acf/settings/show_admin', '__return_false' );
include_once( get_template_directory() . '/inc/acf/acf.php' );


function benzo_acf_settings_path( $path ) {
	$path = get_template_directory() . '/inc/acf/';

	return $path;
}

function benzo_acf_settings_dir( $dir ) {
	$dir = get_template_directory_uri() . '/inc/acf/';

	return $dir;
}

/* Logging Function */
if (!function_exists('write_log')) {
	function write_log ( $log )  {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}
}
