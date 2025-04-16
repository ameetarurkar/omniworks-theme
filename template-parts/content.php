<?php
/**
 * Template part for displaying posts
 *
 * @package Omniworks_Clone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium_large'); ?>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="post-content">
        <div class="post-meta">
            <?php 
            omniworks_posted_on();
            echo ' · ';
            omniworks_posted_by();
            ?>
        </div>
        
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        
        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn-tertiary"><?php _e('Read More', 'omniworks-clone'); ?></a>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
