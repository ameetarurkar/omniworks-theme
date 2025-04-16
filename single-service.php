<?php
/**
 * The template for displaying service single posts
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
                <div class="service-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

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
                // Show categories if they exist
                $service_categories = get_the_terms(get_the_ID(), 'service_category');
                if ($service_categories && !is_wp_error($service_categories)) {
                    echo '<div class="service-categories">';
                    echo '<strong>' . __('Categories:', 'omniworks-clone') . '</strong> ';
                    $categories = array();
                    foreach ($service_categories as $category) {
                        $categories[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                    }
                    echo implode(', ', $categories);
                    echo '</div>';
                }
                ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // Related Services
        $related_args = array(
            'post_type' => 'service',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand',
        );

        // If there are categories, get related by category
        if (!empty($service_categories) && !is_wp_error($service_categories)) {
            $category_ids = array();
            foreach ($service_categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $related_args['tax_query'] = array(
                array(
                    'taxonomy' => 'service_category',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ),
            );
        }

        $related_services = new WP_Query($related_args);

        if ($related_services->have_posts()) :
        ?>
            <div class="related-services">
                <h2><?php _e('Related Services', 'omniworks-clone'); ?></h2>
                
                <div class="services-grid">
                    <?php
                    while ($related_services->have_posts()) :
                        $related_services->the_post();
                        get_template_part('template-parts/content', 'service');
                    endwhile;
                    
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        // CTA Section
        ?>
        <div class="service-cta-section">
            <div class="service-cta-content">
                <h2><?php _e('Ready to get started?', 'omniworks-clone'); ?></h2>
                <p><?php _e('Contact us today to discuss your project requirements.', 'omniworks-clone'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary"><?php _e('Get in touch', 'omniworks-clone'); ?></a>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
