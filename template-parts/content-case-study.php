<?php
/**
 * Template part for displaying case studies
 *
 * @package Omniworks_Clone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('case-study-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <div class="case-study-image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('large'); ?>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="case-study-content">
        <h3>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <?php
        // Display client name if available
        $client = get_post_meta(get_the_ID(), '_case_study_client', true);
        if ($client) : ?>
        <div class="case-study-client">
            <strong><?php _e('Client:', 'omniworks-clone'); ?></strong> <?php echo esc_html($client); ?>
        </div>
        <?php endif; ?>
        
        <div class="case-study-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn-tertiary"><?php _e('View case study', 'omniworks-clone'); ?></a>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
