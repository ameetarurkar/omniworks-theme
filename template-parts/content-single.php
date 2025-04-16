<?php
/**
 * Template part for displaying single posts
 *
 * @package Omniworks_Clone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="post-meta">
            <?php 
            omniworks_posted_on();
            echo ' · ';
            omniworks_posted_by();
            ?>
        </div>
        
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <?php omniworks_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'omniworks-clone'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'omniworks-clone'),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php omniworks_entry_footer(); ?>
        
        <div class="post-navigation-container">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'omniworks-clone') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'omniworks-clone') . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div><!-- .post-navigation-container -->
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
