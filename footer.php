<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jeodotheme
 */
?>

</main></div></div><?php 
// 1. CHECK FOR ELEMENTOR THEME BUILDER FOOTER
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
    // Elementor Pro will render the footer here if a template is assigned.
} else {
    // 2. FALLBACK: Render the custom WordPress footer with dynamic areas
?>
<footer id="colophon" class="site-footer">
    <div class="container footer-widgets">
        
        <div class="footer-col footer-col-1">
            <?php 
        if ( is_active_sidebar( 'footer-col-1' ) ) {
        dynamic_sidebar( 'footer-col-1' );
}        else {
        // Instructional fallback message if no widget is set
        ?>
    <h4><?php echo esc_html__( 'Contact Setup', 'jeodotheme' ); ?></h4>
    <p><?php echo esc_html__( 'To customize this column, please go to Appearance > Widgets and add a Custom HTML or Text widget to the "Footer Column 1" area.', 'jeodotheme' ); ?></p>
    <?php
}
            ?>
        </div>
        
        <?php 
        // *** COLUMN 2: MENU AREA ***
        // ONLY RENDER THE COLUMN IF A MENU IS ASSIGNED
        if ( has_nav_menu( 'footer-menu-1' ) ) :
        ?>
        <div class="footer-col footer-col-2">
            <h4><?php echo esc_html__( 'Quick Links', 'jeodotheme' ); ?></h4>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-menu-1', 
                'depth'          => 1,
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'footer-menu-list', 
            ) );
            ?>
        </div>
        <?php 
        endif; 
        ?>

        <?php
        // *** COLUMN 3: MENU AREA ***
        // ONLY RENDER THE COLUMN IF A MENU IS ASSIGNED
        if ( has_nav_menu( 'footer-menu-2' ) ) :
        ?>
        <div class="footer-col footer-col-3">
            <h4><?php echo esc_html__( 'Information', 'jeodotheme' ); ?></h4>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-menu-2', 
                'depth'          => 1,
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'footer-menu-list',
            ) );
            ?>
        </div>
        <?php 
        endif; 
        ?>
        
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html( get_theme_mod( 'jeodo_footer_copyright', '© All Rights Reserved' ) ); ?></p>
            <div class="site-info">
                <?php
                // *** FOOTER LEGAL MENU (BOTTOM BAR) ***
                // ONLY RENDER THE MENU IF IT IS ASSIGNED
                if ( has_nav_menu( 'footer-legal-menu' ) ) {
                    wp_nav_menu( array(
                       'theme_location' => 'footer-legal-menu', 
                       'depth'          => 1,
                       'container'      => false,
                       'fallback_cb'    => false,
                       'menu_class'     => 'footer-legal-menu-list',
                    ) );
                }
                ?>
            </div>
        </div>
    </div>
</footer>
<?php } // End Elementor fallback ?>

</div><?php wp_footer(); ?>

</body>
</html>