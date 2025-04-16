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
function omniworks_body_classes_enhance($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'omniworks_body_classes_enhance');

/**
 * Add a "Read More" link to excerpts - different name to avoid conflict
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
 * Filters the archive title prefix - different name to avoid conflict
 */
function omniworks_archive_title_format($title) {
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
add_filter('get_the_archive_title', 'omniworks_archive_title_format');

/**
 * Filters WYSIWYG content with custom styles - different name to avoid conflict
 */
function omniworks_content_filter_enhance($content) {
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
add_filter('the_content', 'omniworks_content_filter_enhance');

/**
 * Add custom header to ACF admin to match Omniworks style - different name to avoid conflict
 */
function omniworks_acf_admin_head_style() {
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
add_action('acf/input/admin_head', 'omniworks_acf_admin_head_style');

/**
 * Add Schema.org structured data - different name to avoid conflict
 */
function omniworks_add_schema_data() {
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
add_action('wp_head', 'omniworks_add_schema_data');