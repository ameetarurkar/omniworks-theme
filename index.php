<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<div id="content" class="site-content">
    <main id="primary" class="site-main">
        <?php
        if (is_home() && !is_front_page()) :
            ?>
            <header class="page-header">
                <div class="container">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php omniworks_breadcrumbs(); ?>
                </div>
            </header>
            <?php
        endif;

        if (have_posts()) :
            ?>
            <div class="container">
                <div class="posts-grid">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', get_post_type());

                    endwhile;
                    ?>
                </div><!-- .posts-grid -->

                <?php
                omniworks_pagination();
                ?>
            </div><!-- .container -->

        <?php
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #content -->

<?php
get_footer();