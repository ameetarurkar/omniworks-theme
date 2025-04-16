<?php
/**
 * Custom template tags for this theme
 *
 * @package Omniworks_Clone
 */

if (!function_exists('omniworks_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function omniworks_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<span class="posted-on"><i class="far fa-calendar-alt"></i> ' . $time_string . '</span>';
    }
endif;

if (!function_exists('omniworks_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function omniworks_posted_by() {
        echo '<span class="byline"><i class="far fa-user"></i> ' . 
            '<span class="author vcard">' .
                '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . 
                    esc_html(get_the_author()) . 
                '</a>' . 
            '</span>' . 
        '</span>';
    }
endif;

if (!function_exists('omniworks_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function omniworks_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'omniworks-clone'));
            if ($categories_list) {
                echo '<span class="cat-links"><i class="far fa-folder-open"></i> ' . $categories_list . '</span>';
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'omniworks-clone'));
            if ($tags_list) {
                echo '<span class="tags-links"><i class="fas fa-tags"></i> ' . $tags_list . '</span>';
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link"><i class="far fa-comment"></i> ';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'omniworks-clone'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'omniworks-clone'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link"><i class="fas fa-pencil-alt"></i> ',
            '</span>'
        );
    }
endif;

if (!function_exists('omniworks_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function omniworks_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>
        <?php
        endif;
    }
endif;

if (!function_exists('omniworks_case_study_meta')) :
    /**
     * Displays the case study meta information
     */
    function omniworks_case_study_meta() {
        $client = get_post_meta(get_the_ID(), '_case_study_client', true);
        $duration = get_post_meta(get_the_ID(), '_case_study_duration', true);
        $technologies = get_post_meta(get_the_ID(), '_case_study_technologies', true);
        
        if ($client || $duration || $technologies) :
        ?>
        <div class="case-study-meta">
            <?php if ($client) : ?>
            <div class="case-study-meta-item">
                <h4><?php _e('Client:', 'omniworks-clone'); ?></h4>
                <p><?php echo esc_html($client); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($duration) : ?>
            <div class="case-study-meta-item">
                <h4><?php _e('Project Duration:', 'omniworks-clone'); ?></h4>
                <p><?php echo esc_html($duration); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($technologies) : ?>
            <div class="case-study-meta-item">
                <h4><?php _e('Technologies Used:', 'omniworks-clone'); ?></h4>
                <p>
                <?php 
                $tech_array = explode(',', $technologies);
                foreach ($tech_array as $tech) {
                    echo '<span class="tech-tag">' . esc_html(trim($tech)) . '</span> ';
                }
                ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
        <?php
        endif;
    }
endif;
