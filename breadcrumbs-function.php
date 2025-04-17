<?php
/**
 * Breadcrumbs
 * This function should be added to your functions.php file
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
        echo '<span class="breadcrumb-item">';
        echo '<a href="' . get_home_url() . '">' . $home_title . '</a> ' . $separator . ' ';
        echo '</span>';

        if (is_home()) {
            // Blog page
            echo '<span class="breadcrumb-item current">' . single_post_title('', false) . '</span>';
        } elseif (is_archive() || is_category() || is_tag()) {
            // Archives
            echo '<span class="breadcrumb-item current">' . get_the_archive_title() . '</span>';
        } elseif (is_search()) {
            // Search results page
            echo '<span class="breadcrumb-item current">Search results for "' . get_search_query() . '"</span>';
        } elseif (is_single()) {
            // Single post
            $post_type = get_post_type();
            
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<span class="breadcrumb-item"><a href="' . $post_type_archive . '">' . $post_type_object->labels->name . '</a> ' . $separator . ' </span>';
            } else {
                // If it's a regular post, show category
                $category = get_the_category();
                if (!empty($category)) {
                    $category_values = array_values($category);
                    $last_category = end($category_values);
                    $category_link = get_category_link($last_category->term_id);
                    echo '<span class="breadcrumb-item"><a href="' . $category_link . '">' . $last_category->name . '</a> ' . $separator . ' </span>';
                }
            }
            
            echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
            
        } elseif (is_page()) {
            // Standard page
            if ($post->post_parent) {
                // If child page, get parents
                $ancestors = get_post_ancestors($post->ID);
                $ancestors = array_reverse($ancestors);
                
                foreach ($ancestors as $ancestor) {
                    echo '<span class="breadcrumb-item"><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> ' . $separator . ' </span>';
                }
            }
            
            echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
            
        } else {
            // Default (if nothing else matches)
            echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
        }
        
        echo '</div>';
    }
}