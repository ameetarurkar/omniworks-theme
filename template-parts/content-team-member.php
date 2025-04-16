<?php
/**
 * Template part for displaying team members
 *
 * @package Omniworks_Clone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('team-member-card'); ?>>
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
</article><!-- #post-<?php the_ID(); ?> -->
