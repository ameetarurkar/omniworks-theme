<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Omniworks_Clone
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'omniworks-clone'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    $omniworks_description = get_bloginfo('description', 'display');
                    if ($omniworks_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $omniworks_description; ?></p>
                    <?php endif;
                endif;
                ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger-icon"></span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'omniworks-clone'); ?></span>
                </button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                        'fallback_cb'    => false,
                    )
                );
                ?>
                <div class="header-cta">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary"><?php _e('Get in touch', 'omniworks-clone'); ?></a>
                </div>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- #masthead -->