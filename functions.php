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
 */
function jeodotheme_setup() {
    /*
     * Make theme available for translation.
     */
    load_theme_textdomain( 'jeodotheme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // *** IMPORTANT: REGISTER ALL MENU LOCATIONS HERE ***
    register_nav_menus(
        array(
            'menu-1'            => esc_html__( 'Primary Menu', 'jeodotheme' ), // Existing Primary Menu
            'footer-menu-1'     => esc_html__( 'Footer Column 2 (Links)', 'jeodotheme' ), // Menu for Footer Col 2
            'footer-menu-2'     => esc_html__( 'Footer Column 3 (Links)', 'jeodotheme' ), // Menu for Footer Col 3
            'footer-legal-menu' => esc_html__( 'Footer Legal Menu (Bottom Bar)', 'jeodotheme' ), // New Menu for bottom links
        )
    );
    // *** END MENU REGISTRATION ***

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
 */
function jeodotheme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'jeodotheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jeodotheme_content_width', 0 );


/**
 * Register widget areas.
 */
function jeodotheme_widgets_init() {
    // Primary Sidebar
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
    
    // *** FOOTER WIDGET AREA (for Footer Column 1) ***
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1 (Contact/Social)', 'jeodotheme' ),
        'id'            => 'footer-col-1', // Matches the ID used in footer.php
        'description'   => esc_html__( 'Use this area for Contact Info, Social Icons, or general text.', 'jeodotheme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    // *** END FOOTER WIDGET AREA ***
}
add_action( 'widgets_init', 'jeodotheme_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function jeodotheme_scripts() {
    wp_enqueue_style( 'jeodotheme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'jeodotheme-style', 'rtl', 'replace' );

    // Enqueue header styles
    wp_enqueue_style( 'header-style', get_template_directory_uri() . '/styles/header.css', array(), _S_VERSION );

    // Enqueue footer styles
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/styles/footer.css', array(), _S_VERSION );
    
    // Enqueue news layout styles
    wp_enqueue_style( 'news-layout-style', get_template_directory_uri() . '/styles/news-layout.css', array(), _S_VERSION );

    wp_enqueue_script( 'jeodotheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    
    // Enqueue header script
    wp_enqueue_script( 'header-script', get_template_directory_uri() . '/js/header.js', array('jquery'), _S_VERSION, true );
    
    // Enqueue AJAX pagination script (only on home page)
    if ( is_home() || is_front_page() ) {
        wp_enqueue_script( 'ajax-pagination', get_template_directory_uri() . '/js/ajax-pagination.js', array('jquery'), _S_VERSION, true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'jeodotheme_scripts' );

/**
 * Customizer additions.
 */
function jeodo_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'jeodo_footer_copyright', array(
        'default'           => '© 사용 내역 및 실',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage', // Use postMessage for live preview if you want
    ) );

    $wp_customize->add_control( 'jeodo_footer_copyright_control', array(
        'label'    => __( 'Footer Copyright Text', 'jeodotheme' ),
        'section'  => 'title_tagline', // Placing in Site Identity for simplicity
        'settings' => 'jeodo_footer_copyright',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'jeodo_customize_register' );


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

// Note: Your original file included this, but the logic was moved into the function above.
// If you have a separate file for customizer, you should keep the require here.
// require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Set posts per page for main blog page
 */
function jeodotheme_posts_per_page( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_home() ) {
        $query->set( 'posts_per_page', 2 );
    }
}
add_action( 'pre_get_posts', 'jeodotheme_posts_per_page' );

// Add this to your jeodo_customize_register function in functions.php:
function jeodo_contact_customize_register( $wp_customize ) {
    // ... (Your existing social link registrations)

    // Add settings for Contact Details
    $wp_customize->add_setting( 'jeodo_contact_address', array(
        'default'           => 'Example Street, City, Country',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jeodo_contact_address_control', array(
        'label'    => __( 'Contact Address', 'jeodotheme' ),
        'section'  => 'jeodo_social_settings', // Use your Social Section
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jeodo_contact_email', array(
        'default'           => 'online@email.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'jeodo_contact_email_control', array(
        'label'    => __( 'Contact Email', 'jeodotheme' ),
        'section'  => 'jeodo_social_settings',
        'type'     => 'email',
    ) );
}
add_action( 'customize_register', 'jeodo_contact_customize_register', 20 );

function jeodo_contact_social_customize_register( $wp_customize ) {
    // 1. Add a dedicated section
    $wp_customize->add_section( 'jeodo_contact_social', array(
        'title'    => __( 'Footer Contact & Social', 'jeodotheme' ),
        'priority' => 120,
    ) );

    // 2. Register Contact Text Fields
    $wp_customize->add_setting( 'jeodo_contact_address', array(
        'default'           => 'Example Street, City, Country',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jeodo_contact_address_control', array(
        'label'    => __( 'Contact Address', 'jeodotheme' ),
        'section'  => 'jeodo_contact_social',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jeodo_contact_email', array(
        'default'           => 'online@email.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'jeodo_contact_email_control', array(
        'label'    => __( 'Contact Email', 'jeodotheme' ),
        'section'  => 'jeodo_contact_social',
        'type'     => 'email',
    ) );

    // 3. Register Social Media URL Fields (Example for Facebook/Instagram)
    $wp_customize->add_setting( 'jeodo_social_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'jeodo_social_facebook_control', array(
        'label'    => __( 'Facebook URL', 'jeodotheme' ),
        'section'  => 'jeodo_contact_social',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'jeodo_social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'jeodo_social_instagram_control', array(
        'label'    => __( 'Instagram URL', 'jeodotheme' ),
        'section'  => 'jeodo_contact_social',
        'type'     => 'url',
    ) );
    // ... (Repeat for messenger, kakao, youtube)
}
add_action( 'customize_register', 'jeodo_contact_social_customize_register' );
