<?php
/**
 * Omniworks Clone Theme functions and definitions
 *
 * @package Omniworks_Clone
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function omniworks_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register main menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'omniworks-clone'),
        'footer' => __('Footer Menu', 'omniworks-clone'),
    ));

    // Add theme support for Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'omniworks_setup');

/**
 * Enqueue scripts and styles.
 */
function omniworks_scripts() {
    // Main stylesheet
    wp_enqueue_style('omniworks-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Google fonts - Montserrat and Open Sans (used by Omniworks)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
    
    // AOS Animation Library (for scroll animations like Omniworks uses)
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), null);
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true);
    
    // Custom JS
    wp_enqueue_script('omniworks-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('omniworks-animations', get_template_directory_uri() . '/js/animations.js', array('jquery', 'aos-js'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'omniworks_scripts');

/**
 * Updated scripts function
 */
function omniworks_updated_scripts() {
    // Main stylesheet
    wp_enqueue_style('omniworks-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Google fonts - Montserrat and Open Sans (used by Omniworks)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap', array(), null);
    
    // Font Awesome (updated implementation)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
    
    // AOS Animation Library (for scroll animations like Omniworks uses)
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), null);
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true);
    
    // Custom JS
    wp_enqueue_script('omniworks-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('omniworks-animations', get_template_directory_uri() . '/js/animations.js', array('jquery', 'aos-js'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
// Replace the existing function by using the same hook
remove_action('wp_enqueue_scripts', 'omniworks_scripts');
add_action('wp_enqueue_scripts', 'omniworks_updated_scripts');

/**
 * Register widget areas.
 */
function omniworks_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'omniworks-clone'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'omniworks-clone'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'omniworks-clone'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'omniworks-clone'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'omniworks-clone'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'omniworks-clone'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'omniworks_widgets_init');

/**
 * Register Custom Post Types
 */
function omniworks_custom_post_types() {
    // Register Case Studies Custom Post Type
    register_post_type('case_study', array(
        'labels' => array(
            'name' => __('Case Studies', 'omniworks-clone'),
            'singular_name' => __('Case Study', 'omniworks-clone'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'case-studies'),
    ));
    
    // Register Services Custom Post Type
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'omniworks-clone'),
            'singular_name' => __('Service', 'omniworks-clone'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-hammer',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'services'),
    ));
    
    // Register Team Members Custom Post Type
    register_post_type('team_member', array(
        'labels' => array(
            'name' => __('Team Members', 'omniworks-clone'),
            'singular_name' => __('Team Member', 'omniworks-clone'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'team'),
    ));
}
add_action('init', 'omniworks_custom_post_types');

/**
 * Register Custom Taxonomies
 */
function omniworks_custom_taxonomies() {
    // Register Service Categories
    register_taxonomy('service_category', 'service', array(
        'labels' => array(
            'name' => __('Service Categories', 'omniworks-clone'),
            'singular_name' => __('Service Category', 'omniworks-clone'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'service-category'),
    ));
    
    // Register Case Study Categories
    register_taxonomy('case_study_category', 'case_study', array(
        'labels' => array(
            'name' => __('Case Study Categories', 'omniworks-clone'),
            'singular_name' => __('Case Study Category', 'omniworks-clone'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'case-study-category'),
    ));
}
add_action('init', 'omniworks_custom_taxonomies');

/**
 * Custom Walker for the Primary Menu
 */
class Omniworks_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Meta Boxes
 */
function omniworks_register_meta_boxes() {
    // Team Member Position Meta Box
    add_meta_box(
        'team_member_position',
        __('Team Member Position', 'omniworks-clone'),
        'omniworks_team_member_position_callback',
        'team_member',
        'normal',
        'high'
    );
    
    // Case Study Details Meta Box
    add_meta_box(
        'case_study_details',
        __('Case Study Details', 'omniworks-clone'),
        'omniworks_case_study_details_callback',
        'case_study',
        'normal',
        'high'
    );
    
    // Service Icon Meta Box
    add_meta_box(
        'service_icon',
        __('Service Icon', 'omniworks-clone'),
        'omniworks_service_icon_callback',
        'service',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'omniworks_register_meta_boxes');

// Team Member Position Meta Box Callback
function omniworks_team_member_position_callback($post) {
    wp_nonce_field('omniworks_team_member_position_nonce', 'team_member_position_nonce');
    $position = get_post_meta($post->ID, '_team_member_position', true);
    ?>
    <p>
        <label for="team_member_position"><?php _e('Position', 'omniworks-clone'); ?></label>
        <input type="text" id="team_member_position" name="team_member_position" value="<?php echo esc_attr($position); ?>" class="widefat">
    </p>
    <?php
}

// Case Study Details Meta Box Callback
function omniworks_case_study_details_callback($post) {
    wp_nonce_field('omniworks_case_study_details_nonce', 'case_study_details_nonce');
    $client = get_post_meta($post->ID, '_case_study_client', true);
    $duration = get_post_meta($post->ID, '_case_study_duration', true);
    $technologies = get_post_meta($post->ID, '_case_study_technologies', true);
    ?>
    <p>
        <label for="case_study_client"><?php _e('Client', 'omniworks-clone'); ?></label>
        <input type="text" id="case_study_client" name="case_study_client" value="<?php echo esc_attr($client); ?>" class="widefat">
    </p>
    <p>
        <label for="case_study_duration"><?php _e('Project Duration', 'omniworks-clone'); ?></label>
        <input type="text" id="case_study_duration" name="case_study_duration" value="<?php echo esc_attr($duration); ?>" class="widefat">
    </p>
    <p>
        <label for="case_study_technologies"><?php _e('Technologies Used (comma separated)', 'omniworks-clone'); ?></label>
        <input type="text" id="case_study_technologies" name="case_study_technologies" value="<?php echo esc_attr($technologies); ?>" class="widefat">
    </p>
    <?php
}

// Service Icon Meta Box Callback
function omniworks_service_icon_callback($post) {
    wp_nonce_field('omniworks_service_icon_nonce', 'service_icon_nonce');
    $icon = get_post_meta($post->ID, '_service_icon', true);
    ?>
    <p>
        <label for="service_icon"><?php _e('Font Awesome Icon Class', 'omniworks-clone'); ?></label>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat">
        <span class="description"><?php _e('Enter a Font Awesome icon class (e.g., "fas fa-code").', 'omniworks-clone'); ?></span>
    </p>
    <?php
}

// Save Meta Box Data
function omniworks_save_meta_box_data($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['team_member_position_nonce']) && !isset($_POST['case_study_details_nonce']) && !isset($_POST['service_icon_nonce'])) {
        return;
    }
    
    // Verify the nonce before proceeding.
    if (isset($_POST['team_member_position_nonce']) && !wp_verify_nonce($_POST['team_member_position_nonce'], 'omniworks_team_member_position_nonce')) {
        return;
    }
    
    if (isset($_POST['case_study_details_nonce']) && !wp_verify_nonce($_POST['case_study_details_nonce'], 'omniworks_case_study_details_nonce')) {
        return;
    }
    
    if (isset($_POST['service_icon_nonce']) && !wp_verify_nonce($_POST['service_icon_nonce'], 'omniworks_service_icon_nonce')) {
        return;
    }
    
    // Check if this is an autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions.
    if (isset($_POST['post_type'])) {
        if ('team_member' === $_POST['post_type']) {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        } elseif ('case_study' === $_POST['post_type']) {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        } elseif ('service' === $_POST['post_type']) {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }
    }
    
    // Save the meta box data.
    if (isset($_POST['team_member_position'])) {
        update_post_meta($post_id, '_team_member_position', sanitize_text_field($_POST['team_member_position']));
    }
    
    if (isset($_POST['case_study_client'])) {
        update_post_meta($post_id, '_case_study_client', sanitize_text_field($_POST['case_study_client']));
    }
    
    if (isset($_POST['case_study_duration'])) {
        update_post_meta($post_id, '_case_study_duration', sanitize_text_field($_POST['case_study_duration']));
    }
    
    if (isset($_POST['case_study_technologies'])) {
        update_post_meta($post_id, '_case_study_technologies', sanitize_text_field($_POST['case_study_technologies']));
    }
    
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
}
add_action('save_post', 'omniworks_save_meta_box_data');

/**
 * Custom Shortcodes
 */
// Hero Section Shortcode
function omniworks_hero_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'We build digital products that people love',
        'subtitle' => 'Custom web and software development for businesses and startups',
        'button_text' => 'Get in touch',
        'button_url' => '#contact',
        'background' => get_template_directory_uri() . '/images/hero-bg.jpg',
    ), $atts);
    
    ob_start();
    ?>
    <section class="hero-section" style="background-image: url('<?php echo esc_url($atts['background']); ?>');">
        <div class="hero-content">
            <h1 data-aos="fade-up"><?php echo esc_html($atts['title']); ?></h1>
            <p data-aos="fade-up" data-aos-delay="200"><?php echo esc_html($atts['subtitle']); ?></p>
            <a href="<?php echo esc_url($atts['button_url']); ?>" class="btn-primary" data-aos="fade-up" data-aos-delay="400"><?php echo esc_html($atts['button_text']); ?></a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('omniworks_hero', 'omniworks_hero_shortcode');

// Services Grid Shortcode
function omniworks_services_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 6,
        'title' => 'Our Services',
        'subtitle' => 'What we can do for you',
    ), $atts);
    
    $args = array(
        'post_type' => 'service',
        'posts_per_page' => $atts['count'],
    );
    
    $services = new WP_Query($args);
    
    ob_start();
    ?>
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php echo esc_html($atts['title']); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($atts['subtitle']); ?></p>
            </div>
            
            <div class="services-grid">
                <?php 
                if ($services->have_posts()) :
                    $delay = 200;
                    while ($services->have_posts()) : $services->the_post();
                    ?>
                    <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="service-icon">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <div class="service-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-secondary">Learn more</a>
                    </div>
                    <?php
                    $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No services found.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('omniworks_services', 'omniworks_services_grid_shortcode');

// Case Studies Shortcode
function omniworks_case_studies_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 3,
        'title' => 'Case Studies',
        'subtitle' => 'See how we helped our clients',
    ), $atts);
    
    $args = array(
        'post_type' => 'case_study',
        'posts_per_page' => $atts['count'],
    );
    
    $case_studies = new WP_Query($args);
    
    ob_start();
    ?>
    <section class="case-studies-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php echo esc_html($atts['title']); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($atts['subtitle']); ?></p>
            </div>
            
            <div class="case-studies-grid">
                <?php 
                if ($case_studies->have_posts()) :
                    $delay = 200;
                    while ($case_studies->have_posts()) : $case_studies->the_post();
                    ?>
                    <div class="case-study-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="case-study-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="case-study-content">
                            <h3><?php the_title(); ?></h3>
                            <div class="case-study-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn-tertiary">View case study</a>
                        </div>
                    </div>
                    <?php
                    $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No case studies found.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('omniworks_case_studies', 'omniworks_case_studies_shortcode');

// Team Members Shortcode
function omniworks_team_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 4,
        'title' => 'Our Team',
        'subtitle' => 'Meet the people behind Omniworks',
    ), $atts);
    
    $args = array(
        'post_type' => 'team_member',
        'posts_per_page' => $atts['count'],
    );
    
    $team_members = new WP_Query($args);
    
    ob_start();
    ?>
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php echo esc_html($atts['title']); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($atts['subtitle']); ?></p>
            </div>
            
            <div class="team-grid">
                <?php 
                if ($team_members->have_posts()) :
                    $delay = 200;
                    while ($team_members->have_posts()) : $team_members->the_post();
                    ?>
                    <div class="team-member-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="team-member-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="team-member-content">
                            <h3><?php the_title(); ?></h3>
                            <?php 
                            $position = get_post_meta(get_the_ID(), '_team_member_position', true);
                            if ($position) : ?>
                            <p class="team-member-position"><?php echo esc_html($position); ?></p>
                            <?php endif; ?>
                            <div class="team-member-bio">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No team members found.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('omniworks_team', 'omniworks_team_shortcode');

// Contact Form Shortcode
function omniworks_contact_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Get in Touch',
        'subtitle' => 'Let\'s discuss your project',
    ), $atts);
    
    ob_start();
    ?>
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php echo esc_html($atts['title']); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($atts['subtitle']); ?></p>
            </div>
            
            <div class="contact-form-wrapper" data-aos="fade-up" data-aos-delay="200">
                <?php 
                if (shortcode_exists('contact-form-7')) {
                    echo do_shortcode('[contact-form-7 id="contact-form" title="Contact Form"]');
                } else {
                    ?>
                    <div class="contact-form-notice">
                        <p>Please install and activate Contact Form 7 plugin to display the contact form.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('omniworks_contact', 'omniworks_contact_form_shortcode');

/**
 * Custom Omniworks Pagination
 */
function omniworks_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $big = 999999999; // Need an unlikely integer
    
    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
        'type' => 'array',
        'end_size' => 1,
        'mid_size' => 2,
    ));
    
    if ($links) :
    ?>
    <nav class="pagination">
        <ul>
            <?php foreach ($links as $link) : ?>
                <li><?php echo $link; ?></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
    endif;
}

/**
 * Breadcrumbs
 */
function omniworks_breadcrumbs() {
    // Settings
    $separator = '<i class="fas fa-chevron-right"></i>';
    $home_title = 'Home';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {
        echo '<div class="breadcrumbs">';
        echo '<div class="container">';

        // Home page
        echo '<a href="' . get_home_url() . '">' . $home_title . '</a> ' . $separator . ' ';

        if (is_home()) {
            // Blog page
            echo single_post_title('', false);
        } elseif (is_archive() || is_category() || is_tag()) {
            // Archives
            echo get_the_archive_title();
        } elseif (is_search()) {
            // Search results page
            echo 'Search results for "' . get_search_query() . '"';
        } elseif (is_single()) {
            // Single post
            $post_type = get_post_type();
            
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<a href="' . $post_type_archive . '">' . $post_type_object->labels->name . '</a> ' . $separator . ' ';
            } else {
                // If it's a regular post, show category
                $category = get_the_category();
                if (!empty($category)) {
                    $category_values = array_values($category);
                    $last_category = end($category_values);
                    $category_link = get_category_link($last_category->term_id);
                    echo '<a href="' . $category_link . '">' . $last_category->name . '</a> ' . $separator . ' ';
                }
            }
            
            echo get_the_title();
            
        } elseif (is_page()) {
            // Standard page
            if ($post->post_parent) {
                // If child page, get parents
                $ancestors = get_post_ancestors($post->ID);
                $ancestors = array_reverse($ancestors);
                
                foreach ($ancestors as $ancestor) {
                    echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> ' . $separator . ' ';
                }
            }
            
            echo get_the_title();
            
        } else {
            // Default (if nothing else matches)
            echo get_the_title();
        }
        
        echo '</div>';
        echo '</div>';
    }
}

/**
 * Custom Excerpt Length
 */
function omniworks_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'omniworks_custom_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function omniworks_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'omniworks_custom_excerpt_more');

/**
 * Add classes to body based on template
 */
function omniworks_body_classes($classes) {
    // Add class if we're viewing the Customizer for easier styling
    if (is_customize_preview()) {
        $classes[] = 'customizer-preview';
    }
    
    // Add class on front page
    if (is_front_page() && !is_home()) {
        $classes[] = 'front-page';
    }
    
    // Add class if no custom header or featured image is in use
    if (!has_header_image() && !has_post_thumbnail()) {
        $classes[] = 'no-header-image';
    }
    
    // Add class if sidebar is used
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for specific post types
    if (is_singular()) {
        $post_type = get_post_type();
        $classes[] = 'single-' . $post_type;
    }
    
    // Add class for archive pages
    if (is_archive()) {
        $post_type = get_post_type();
        
        if ($post_type) {
            $classes[] = $post_type . '-archive';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'omniworks_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function omniworks_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'omniworks_pingback_header');

/**
 * Add custom header to ACF admin to match Omniworks style
 */
function omniworks_acf_admin_head() {
    ?>
    <style type="text/css">
    .acf-field .acf-label {
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .acf-field input[type="text"],
    .acf-field input[type="password"],
    .acf-field input[type="email"],
    .acf-field input[type="url"],
    .acf-field textarea {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    
    .acf-field select {
        padding: 10px;
        height: auto;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    
    .acf-field .acf-input-wrap {
        position: relative;
    }
    
    .acf-field .acf-input-append,
    .acf-field .acf-input-prepend {
        padding: 6px 10px;
        border-radius: 4px;
        background: #f9f9f9;
    }
    
    .acf-field .button {
        padding: 8px 15px;
        border-radius: 4px;
        background: #1a237e;
        color: #fff;
        border: none;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    
    .acf-field .button:hover {
        background: #0c125e;
    }
    </style>
    <?php
}
add_action('acf/input/admin_head', 'omniworks_acf_admin_head');

/**
 * Add Schema.org structured data
 */
function omniworks_add_schema_to_webpage() {
    // Basic WebPage schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'url' => get_permalink(),
        'name' => get_the_title(),
        'description' => get_the_excerpt()
    );
    
    // Add Organization schema
    $schema['publisher'] = array(
        '@type' => 'Organization',
        'name' => get_bloginfo('name'),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => get_template_directory_uri() . '/images/logo.png'
        )
    );
    
    // If it's a single post
    if (is_singular('post')) {
        $schema['@type'] = 'BlogPosting';
        $schema['datePublished'] = get_the_date('c');
        $schema['dateModified'] = get_the_modified_date('c');
        
        // Add author information
        $schema['author'] = array(
            '@type' => 'Person',
            'name' => get_the_author()
        );
        
        // Add featured image if available
        if (has_post_thumbnail()) {
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $featured_img_url
            );
        }
    }
    
    // If it's a case study
    if (is_singular('case_study')) {
        $schema['@type'] = 'Article';
        $schema['headline'] = get_the_title();
        $schema['datePublished'] = get_the_date('c');
        $schema['dateModified'] = get_the_modified_date('c');
        
        // Add client information if available
        $client = get_post_meta(get_the_ID(), '_case_study_client', true);
        if ($client) {
            $schema['about'] = array(
                '@type' => 'Organization',
                'name' => $client
            );
        }
        
        // Add featured image if available
        if (has_post_thumbnail()) {
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $featured_img_url
            );
        }
    }
    
    // Output the schema markup in the head
    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}
add_action('wp_head', 'omniworks_add_schema_to_webpage');

/**
 * Customize the excerpt read more link
 */
function omniworks_excerpt_more_link($excerpt) {
    if (!is_single()) {
        $excerpt .= '<p><a class="read-more-link" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'omniworks-clone') . ' <i class="fas fa-arrow-right"></i></a></p>';
    }
    return $excerpt;
}
add_filter('the_excerpt', 'omniworks_excerpt_more_link');

/**
 * Filters the archive title to remove prefix
 */
function omniworks_archive_title_prefix($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}
add_filter('get_the_archive_title', 'omniworks_archive_title_prefix');

/**
 * Add responsive classes to images and iframes in content
 */
function omniworks_content_filter($content) {
    // Add responsive class to all images
    $content = preg_replace('/<img(.*?)class="(.*?)"(.*?)>/i', '<img$1class="$2 img-fluid"$3>', $content);
    $content = preg_replace('/<img((?:(?!class=).)*?)>/i', '<img class="img-fluid"$1>', $content);
    
    // Add responsive class to all iframes
    $content = preg_replace('/<iframe(.*?)class="(.*?)"(.*?)>/i', '<iframe$1class="$2 embed-responsive-item"$3>', $content);
    $content = preg_replace('/<iframe((?:(?!class=).)*?)>/i', '<iframe class="embed-responsive-item"$1>', $content);
    
    // Wrap all iframes in responsive containers
    $content = preg_replace('/<iframe(.*?)><\/iframe>/i', '<div class="embed-responsive embed-responsive-16by9"><iframe$1></iframe></div>', $content);
    
    return $content;
}
add_filter('the_content', 'omniworks_content_filter');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';