<?php
/**
 * The template for displaying all pages
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<div id="content" class="site-content">
    <main id="primary" class="site-main">
        <header class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php omniworks_breadcrumbs(); ?>
            </div>
        </header>

        <div class="container">
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->
</div><!-- #content -->

<?php
get_footer();