<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Omniworks_Clone
 */

?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="row">
                    <div class="footer-widget-area">
                        <?php if (is_active_sidebar('footer-1')) : ?>
                            <?php dynamic_sidebar('footer-1'); ?>
                        <?php else : ?>
                            <div class="widget">
                                <?php if (has_custom_logo()) : ?>
                                    <div class="footer-logo">
                                        <?php the_custom_logo(); ?>
                                    </div>
                                <?php else : ?>
                                    <h4 class="widget-title"><?php bloginfo('name'); ?></h4>
                                <?php endif; ?>
                                <p><?php _e('Custom web and software development for businesses and startups.', 'omniworks-clone'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="footer-widget-area">
                        <?php if (is_active_sidebar('footer-2')) : ?>
                            <?php dynamic_sidebar('footer-2'); ?>
                        <?php else : ?>
                            <div class="widget">
                                <h4 class="widget-title"><?php _e('Services', 'omniworks-clone'); ?></h4>
                                <ul>
                                    <li><a href="<?php echo esc_url(home_url('/services/web-development/')); ?>"><?php _e('Web Development', 'omniworks-clone'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/services/mobile-development/')); ?>"><?php _e('Mobile Development', 'omniworks-clone'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/services/ui-ux-design/')); ?>"><?php _e('UI/UX Design', 'omniworks-clone'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/services/software-consulting/')); ?>"><?php _e('Software Consulting', 'omniworks-clone'); ?></a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="footer-widget-area">
                        <?php if (is_active_sidebar('footer-3')) : ?>
                            <?php dynamic_sidebar('footer-3'); ?>
                        <?php else : ?>
                            <div class="widget">
                                <h4 class="widget-title"><?php _e('Contact', 'omniworks-clone'); ?></h4>
                                <address>
                                    <p><?php _e('1234 Main Street', 'omniworks-clone'); ?><br>
                                    <?php _e('Suite 100', 'omniworks-clone'); ?><br>
                                    <?php _e('City, State 12345', 'omniworks-clone'); ?></p>
                                    <p><?php _e('Email: info@example.com', 'omniworks-clone'); ?><br>
                                    <?php _e('Phone: (123) 456-7890', 'omniworks-clone'); ?></p>
                                </address>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- .footer-widgets -->

            <div class="site-info">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'omniworks-clone'); ?>
                </div>
                <div class="social-links">
                    <a href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                </div>
            </div><!-- .site-info -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
    
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
