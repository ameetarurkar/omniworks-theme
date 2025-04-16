<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'omniworks-clone'); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'omniworks-clone'); ?></p>

                <?php get_search_form(); ?>

                <div class="error-suggestions">
                    <h2><?php esc_html_e('Here are some helpful links:', 'omniworks-clone'); ?></h2>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'omniworks-clone'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Services', 'omniworks-clone'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/case-studies/')); ?>"><?php esc_html_e('Case Studies', 'omniworks-clone'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About Us', 'omniworks-clone'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact', 'omniworks-clone'); ?></a></li>
                    </ul>
                </div>
            </div><!-- .page-content -->
        </div><!-- .container -->
    </section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();
