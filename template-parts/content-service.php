<?php
/**
 * Template part for displaying services
 *
 * @package Omniworks_Clone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('service-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <div class="service-icon">
        <?php the_post_thumbnail('thumbnail'); ?>
    </div>
    <?php endif; ?>
    
    <h3><?php the_title(); ?></h3>
    
    <div class="service-excerpt">
        <?php the_excerpt(); ?>
    </div>
    
    <a href="<?php the_permalink(); ?>" class="btn-secondary"><?php _e('Learn more', 'omniworks-clone'); ?></a>
</article><!-- #post-<?php the_ID(); ?> -->
