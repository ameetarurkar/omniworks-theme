<?php
/**
 * The template for displaying team member archives
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main team-archive">
    <header class="page-header">
        <div class="container">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            <div class="archive-description">
                <p><?php _e('Meet our talented team of professionals who make everything we do possible.', 'omniworks-clone'); ?></p>
            </div>
            <?php omniworks_breadcrumbs(); ?>
        </div>
    </header>

    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="team-grid">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'team_member');
                endwhile;
                ?>
            </div>

            <?php
            omniworks_pagination();

        else :

            get_template_part('template-parts/content', 'none');

        endif;
        ?>
        
        <!-- Join Us Section -->
        <div class="team-join-section">
            <div class="team-join-content">
                <h2><?php _e('Join Our Team', 'omniworks-clone'); ?></h2>
                <p><?php _e('Are you passionate about technology and innovation? We\'re always looking for talented individuals to join our team.', 'omniworks-clone'); ?></p>
                <a href="<?php echo esc_url(home_url('/careers/')); ?>" class="btn-primary"><?php _e('View open positions', 'omniworks-clone'); ?></a>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
