<?php
/**
 * The template for displaying search results pages
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Search Results for: %s', 'omniworks-clone'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
            <?php omniworks_breadcrumbs(); ?>
        </div>
    </header><!-- .page-header -->

    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="search-results-count">
                <?php
                $found_posts = $wp_query->found_posts;
                printf(
                    esc_html(_n('Found %s result', 'Found %s results', $found_posts, 'omniworks-clone')),
                    number_format_i18n($found_posts)
                );
                ?>
            </div>

            <div class="search-results-list">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    ?>
                    <div class="search-result">
                        <h2 class="search-result-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="search-result-meta">
                            <?php
                            $post_type = get_post_type();
                            $post_type_obj = get_post_type_object($post_type);
                            
                            if ($post_type_obj) {
                                echo '<span class="search-result-type">' . esc_html($post_type_obj->labels->singular_name) . '</span>';
                            }
                            
                            if ('post' === $post_type) {
                                echo ' | ';
                                omniworks_posted_on();
                            }
                            ?>
                        </div>
                        
                        <div class="search-result-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="btn-tertiary"><?php _e('Read More', 'omniworks-clone'); ?></a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>

            <?php
            omniworks_pagination();

        else :

            ?>
            <div class="no-results">
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'omniworks-clone'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php

        endif;
        ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
