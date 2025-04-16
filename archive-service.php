<?php
/**
 * The template for displaying service archives
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main services-archive">
    <header class="page-header">
        <div class="container">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            <div class="archive-description">
                <p><?php _e('Browse our range of professional services tailored to meet your business needs.', 'omniworks-clone'); ?></p>
            </div>
            <?php omniworks_breadcrumbs(); ?>
        </div>
    </header>

    <div class="container">
        <?php if (have_posts()) : ?>
            <?php
            // Get service categories if any
            $service_categories = get_terms(array(
                'taxonomy' => 'service_category',
                'hide_empty' => true,
            ));

            if (!empty($service_categories) && !is_wp_error($service_categories)) :
            ?>
                <div class="service-filter">
                    <ul>
                        <li class="active" data-filter="*"><?php _e('All', 'omniworks-clone'); ?></li>
                        <?php foreach ($service_categories as $category) : ?>
                            <li data-filter=".service-category-<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="services-grid">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    
                    // Get service categories for filtering
                    $service_classes = '';
                    $post_categories = get_the_terms(get_the_ID(), 'service_category');
                    
                    if (!empty($post_categories) && !is_wp_error($post_categories)) {
                        foreach ($post_categories as $category) {
                            $service_classes .= ' service-category-' . $category->slug;
                        }
                    }
                    ?>
                    
                    <div class="service-item<?php echo esc_attr($service_classes); ?>">
                        <?php get_template_part('template-parts/content', 'service'); ?>
                    </div>
                    
                <?php endwhile; ?>
            </div>

            <?php
            omniworks_pagination();

        else :

            get_template_part('template-parts/content', 'none');

        endif;
        ?>
        
        <!-- CTA Section -->
        <div class="services-cta-section">
            <div class="services-cta-content">
                <h2><?php _e('Can\'t find what you\'re looking for?', 'omniworks-clone'); ?></h2>
                <p><?php _e('Contact us today to discuss your specific requirements. We offer custom solutions tailored to your needs.', 'omniworks-clone'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary"><?php _e('Get in touch', 'omniworks-clone'); ?></a>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
