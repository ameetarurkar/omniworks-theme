<?php
/**
 * The template for displaying case study single posts
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php omniworks_breadcrumbs(); ?>
        </div>
    </header>

    <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="case-study-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

            <?php omniworks_case_study_meta(); ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'omniworks-clone'),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                // Show categories and tags if they exist
                $case_study_categories = get_the_terms(get_the_ID(), 'case_study_category');
                if ($case_study_categories && !is_wp_error($case_study_categories)) {
                    echo '<div class="case-study-categories">';
                    echo '<strong>' . __('Categories:', 'omniworks-clone') . '</strong> ';
                    $categories = array();
                    foreach ($case_study_categories as $category) {
                        $categories[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                    }
                    echo implode(', ', $categories);
                    echo '</div>';
                }
                ?>
                
                <div class="case-study-navigation">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post || $next_post) :
                    ?>
                        <div class="case-study-navigation-links">
                            <?php if ($prev_post) : ?>
                                <div class="previous-case-study">
                                    <span class="nav-subtitle"><?php _e('Previous Case Study', 'omniworks-clone'); ?></span>
                                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="nav-link">
                                        <span class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($next_post) : ?>
                                <div class="next-case-study">
                                    <span class="nav-subtitle"><?php _e('Next Case Study', 'omniworks-clone'); ?></span>
                                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="nav-link">
                                        <span class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // Related Case Studies
        $related_args = array(
            'post_type' => 'case_study',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand',
        );

        // If there are categories, get related by category
        if (!empty($case_study_categories) && !is_wp_error($case_study_categories)) {
            $category_ids = array();
            foreach ($case_study_categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $related_args['tax_query'] = array(
                array(
                    'taxonomy' => 'case_study_category',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ),
            );
        }

        $related_case_studies = new WP_Query($related_args);

        if ($related_case_studies->have_posts()) :
        ?>
            <div class="related-case-studies">
                <h2><?php _e('Related Case Studies', 'omniworks-clone'); ?></h2>
                
                <div class="case-studies-grid">
                    <?php
                    while ($related_case_studies->have_posts()) :
                        $related_case_studies->the_post();
                        get_template_part('template-parts/content', 'case_study');
                    endwhile;
                    
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
