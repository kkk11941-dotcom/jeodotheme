<?php
/**
 * jeodotheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jeodotheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jeodotheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on jeodotheme, use a find and replace
		* to change 'jeodotheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jeodotheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'jeodotheme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'jeodotheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'jeodotheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jeodotheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jeodotheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jeodotheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jeodotheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jeodotheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jeodotheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jeodotheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jeodotheme_scripts() {
	wp_enqueue_style( 'jeodotheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'jeodotheme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jeodotheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jeodotheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Create default Login page when the theme is activated
 */
function jeodo_create_default_pages() {
  
	// Page Slug -> [ title, Template File ]
	$pages = array(
		'login' => array(
			'title' 	=> 'Login',
			'template'	=> 'page-login.php',
		),
		'register'	=> array(
			'title'		=> 'Register',
			'template'	=> 'page-register.php',
		),
		'account' => array(
			'title'		=> 'My Account',
			'template'	=> 'page-account.php',

		),
	),

	foreach (	$pages as $slug => $page_data	) {

		// Check if the page already exists
        $existing = get_page_by_path( $slug );

        if ( ! $existing ) {

            // Create the page
            $page_id = wp_insert_post( array(
                'post_title'     => $page_data['title'],
                'post_name'      => $slug,
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ) );

            // Assign template if creation successful
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
            }
        }

	}
}
add_action( 'after_switch_theme', 'jeodo_create_default_pages' );

/**
 * Redirect failed login to custom login page with error code
 */
function jeodo_custom_login_failed( $username ) {
    $referrer = wp_get_referer();
    $login_page = home_url('/login');

    // Determine the error type
    if ( isset( $_REQUEST['log'] ) ) {
        $user = get_user_by( 'login', $_REQUEST['log'] );
        if ( ! $user ) {
            $error_type = 'invalid_username';
        } else {
            $error_type = 'incorrect_password';
        }
    } else {
        $error_type = 'invalid_username';
    }

    wp_redirect( $login_page . '?login=' . $error_type );
    exit;
}
add_action( 'wp_login_failed', 'jeodo_custom_login_failed' );

/**
 * Redirect empty fields back to custom login page
 */
function jeodo_check_empty_fields( $user, $username, $password ) {
    if ( isset($_POST['log']) && empty($username) ) {
        wp_redirect( home_url('/login?login=empty_username') );
        exit;
    }

    if ( isset($_POST['pwd']) && empty($password) ) {
        wp_redirect( home_url('/login?login=empty_password') );
        exit;
    }

    return $user;
}
add_filter( 'authenticate', 'jeodo_check_empty_fields', 1, 3 );


