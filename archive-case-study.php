<?php
/**
 * The template for displaying case study archives
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main case-studies-archive">
    <header class="page-header">
        <div class="container">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            <div class="archive-description">
                <p><?php _e('Explore our portfolio of successful projects and discover how we\'ve helped our clients achieve their goals.', 'omniworks-clone'); ?></p>
            </div>
            <?php omniworks_breadcrumbs(); ?>
        </div>
    </header>

    <div class="container">
        <?php if (have_posts()) : ?>
            <?php
            // Get case study categories if any
            $case_study_categories = get_terms(array(
                'taxonomy' => 'case_study_category',
                'hide_empty' => true,
            ));

            if (!empty($case_study_categories) && !is_wp_error($case_study_categories)) :
            ?>
                <div class="case-study-filter">
                    <ul>
                        <li class="active" data-filter="*"><?php _e('All', 'omniworks-clone'); ?></li>
                        <?php foreach ($case_study_categories as $category) : ?>
                            <li data-filter=".case-study-category-<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="case-studies-grid">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    
                    // Get case study categories for filtering
                    $case_study_classes = '';
                    $post_categories = get_the_terms(get_the_ID(), 'case_study_category');
                    
                    if (!empty($post_categories) && !is_wp_error($post_categories)) {
                        foreach ($post_categories as $category) {
                            $case_study_classes .= ' case-study-category-' . $category->slug;
                        }
                    }
                    ?>
                    
                    <div class="case-study-item<?php echo esc_attr($case_study_classes); ?>">
                        <?php get_template_part('template-parts/content', 'case_study'); ?>
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
        <div class="case-studies-cta-section">
            <div class="case-studies-cta-content">
                <h2><?php _e('Ready to start your project?', 'omniworks-clone'); ?></h2>
                <p><?php _e('Contact us today to discuss how we can help you achieve your business goals with custom software solutions.', 'omniworks-clone'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary"><?php _e('Get in touch', 'omniworks-clone'); ?></a>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
