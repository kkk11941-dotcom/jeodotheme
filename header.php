<?php
/**
 * The header for our theme
 * Update: User Icon links to the custom Login Page
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
        <div class="container">
            
            <div class="header-top-row">
                <div class="banner-box"><a href="#">COMPANY LOGO</a></div>
                <div class="banner-box"><a href="#">COMPANY LOGO</a></div>
                <div class="banner-box"><a href="#">COMPANY LOGO</a></div>
            </div>

            <div class="header-mid-row">
                
                <div class="mid-logo-center">
                    <div class="banner-box main-logo-box">
                        <a href="<?php echo home_url(); ?>">COMPANY LOGO</a>
                    </div>
                </div>

                <div class="header-utils-right">
                    <span class="date-display">
                        <?php echo date_i18n( 'Y년 n월 j일' ); ?>
                    </span>
                    
                    <?php if ( is_user_logged_in() ) : ?>
                         <a href="<?php echo home_url('/account'); ?>" class="icon-link" aria-label="My Account">
                            <i class="fa-regular fa-user"></i>
                         </a>
<<<<<<< HEAD
              <?php else : ?>
                    <a href="<?php echo home_url('/login'); ?>" class="icon-link" aria-label="Login">
                        <i class="fa-regular fa-user"></i>
                    </a>
                <?php endif; ?>

=======
                    <?php else : ?>
                         <a href="<?php echo home_url('/login'); ?>" class="icon-link" aria-label="Login">
                            <i class="fa-regular fa-user"></i>
                         </a>
                    <?php endif; ?>
>>>>>>> 5b72f94d7ebfd46f0b6f4a8a32d53866045ffa8e

                    <button class="icon-btn search-toggle"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>

<<<<<<< HEAD
            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container'      => false, 
                    )
                );
                ?>
            </nav>

=======
<nav id="site-navigation" class="main-navigation">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'menu-1', // This must match the name in functions.php
            'menu_id'        => 'primary-menu',
            'container'      => false, 
        )
    );
    ?>
</nav>
>>>>>>> 5b72f94d7ebfd46f0b6f4a8a32d53866045ffa8e
        </div>
	</header>