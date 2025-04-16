<?php
/**
 * Custom search form template
 *
 * @package Omniworks_Clone
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="screen-reader-text"><?php _ex('Search for:', 'label', 'omniworks-clone'); ?></label>
    <div class="search-form-inner">
        <input type="search" id="search-field" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'omniworks-clone'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit"><i class="fas fa-search"></i><span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'omniworks-clone'); ?></span></button>
    </div>
</form>
