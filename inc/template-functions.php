<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Omniworks_Clone
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function omniworks_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
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
 * Add a "Read More" link to excerpts
 *
 * @param string $excerpt The excerpt.
 * @return string
 */
function omniworks_excerpt_more_link($excerpt) {
    if (!is_single()) {
        $excerpt .= '<p><a class="read-more-link" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'omniworks-clone') . ' <i class="fas fa-arrow-right"></i></a></p>';
    }
    return $excerpt;
}
add_filter('the_excerpt', 'omniworks_excerpt_more_link');

/**
 * Filters the archive title prefix
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
 * Filters WYSIWYG content with custom styles
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
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function omniworks_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'omniworks_pingback_header');

/**
 * Breadcrumbs for pages
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
    }
}

/**
 * Add Schema.org structured data
 */
function omniworks_add_schema_data() {
    // Don't run if not a singular item
    if (!is_singular()) {
        return;
    }

    // Basic WebPage schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'url' => get_permalink(),
        'name' => get_the_title(),
    );
    
    // Add description if we have an excerpt
    if (has_excerpt()) {
        $schema['description'] = get_the_excerpt();
    }
    
    // Add Organization schema
    $schema['publisher'] = array(
        '@type' => 'Organization',
        'name' => get_bloginfo('name'),
    );
    
    // Add logo if we have one
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_image = wp_get_attachment_image_src($custom_logo_id, 'full');
        if ($logo_image) {
            $schema['publisher']['logo'] = array(
                '@type' => 'ImageObject',
                'url' => $logo_image[0]
            );
        }
    }
    
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
add_action('wp_head', 'omniworks_add_schema_data');

/**
 * Modify wp_nav_menu to use custom menu walker
 */
function omniworks_modify_nav_menu_args($args) {
    if (isset($args['theme_location']) && $args['theme_location'] === 'primary') {
        $args['walker'] = new Omniworks_Menu_Walker();
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'omniworks_modify_nav_menu_args');

/**
 * Modify the excerpt length
 */
function omniworks_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'omniworks_custom_excerpt_length', 999);

/**
 * Modify the excerpt more string
 */
function omniworks_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'omniworks_custom_excerpt_more');

/**
 * Add custom classes to post navigation links
 */
function omniworks_post_nav_class($links) {
    if (is_array($links)) {
        $links['prev_text'] = str_replace('<a ', '<a class="nav-previous" ', $links['prev_text']);
        $links['next_text'] = str_replace('<a ', '<a class="nav-next" ', $links['next_text']);
    }
    return $links;
}
add_filter('the_post_navigation_args', 'omniworks_post_nav_class');

/**
 * Add custom ACF admin styles
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
// Only add if ACF is active
if (function_exists('acf_add_local_field_group')) {
    add_action('acf/input/admin_head', 'omniworks_acf_admin_head');
}

/**
 * Fix Font Awesome implementation
 */
function omniworks_fix_font_awesome() {
    // Remove kit.fontawesome.com script which may cause issues
    wp_dequeue_script('font-awesome');
    
    // Add Font Awesome from CDN
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
}
add_action('wp_enqueue_scripts', 'omniworks_fix_font_awesome', 20);

/**
 * Add responsive container for embedded videos and iframes
 */
function omniworks_responsive_embeds($html) {
    if (strpos($html, '<iframe') !== false) {
        $html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
    }
    return $html;
}
add_filter('embed_oembed_html', 'omniworks_responsive_embeds', 10, 3);

/**
 * Add animation classes to blocks
 */
function omniworks_block_wrapper($block_content, $block) {
    // Skip if empty
    if (empty($block_content)) {
        return $block_content;
    }
    
    // Add animation to headings
    if (isset($block['blockName']) && strpos($block['blockName'], 'core/heading') !== false) {
        $block_content = str_replace('<h', '<h data-aos="fade-up"', $block_content);
    }
    
    return $block_content;
}
add_filter('render_block', 'omniworks_block_wrapper', 10, 2);

/**
 * Add custom image sizes
 */
function omniworks_custom_image_sizes() {
    // Case study featured image
    add_image_size('case-study-featured', 1200, 675, true);
    
    // Team member photo
    add_image_size('team-member-photo', 400, 500, true);
    
    // Service icon
    add_image_size('service-icon', 120, 120, false);
}
add_action('after_setup_theme', 'omniworks_custom_image_sizes');

/**
 * Add proper CSS classes to main content container
 */
function omniworks_content_class() {
    $classes = 'site-content';
    
    if (is_page_template('templates/full-width.php')) {
        $classes .= ' full-width-content';
    } elseif (is_active_sidebar('sidebar-1') && !is_page() && !is_singular('case_study') && !is_singular('service') && !is_singular('team_member')) {
        $classes .= ' has-sidebar';
    }
    
    return esc_attr($classes);
}
