<?php
/**
 * The template for displaying the homepage
 *
 * @package Omniworks_Clone
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    // Hero Section
    echo do_shortcode('[omniworks_hero title="We build digital products that people love" subtitle="Custom web and software development for businesses and startups" button_text="Get in touch" button_url="#contact"]');
    
    // Services Section
    echo do_shortcode('[omniworks_services count="6" title="Our Services" subtitle="What we can do for you"]');
    
    // Case Studies Section
    echo do_shortcode('[omniworks_case_studies count="3" title="Case Studies" subtitle="See how we helped our clients"]');
    
    // Why Choose Us Section
    ?>
    <section class="why-choose-us-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php _e('Why Choose Us', 'omniworks-clone'); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php _e('Reasons to work with our team', 'omniworks-clone'); ?></p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3><?php _e('Expertise & Experience', 'omniworks-clone'); ?></h3>
                    <p><?php _e('Our team has years of experience developing custom software solutions for various industries.', 'omniworks-clone'); ?></p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3><?php _e('Client-Centered Approach', 'omniworks-clone'); ?></h3>
                    <p><?php _e('We work closely with you to understand your unique needs and deliver tailored solutions.', 'omniworks-clone'); ?></p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3><?php _e('Timely Delivery', 'omniworks-clone'); ?></h3>
                    <p><?php _e('We value your time and ensure that your project is completed on schedule.', 'omniworks-clone'); ?></p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3><?php _e('Ongoing Support', 'omniworks-clone'); ?></h3>
                    <p><?php _e('Our relationship doesn\'t end after delivery - we provide continuous support and maintenance.', 'omniworks-clone'); ?></p>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    // Team Section
    echo do_shortcode('[omniworks_team count="4" title="Our Team" subtitle="Meet the people behind Omniworks"]');
    
    // Testimonials Section
    ?>
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2 data-aos="fade-up"><?php _e('What Our Clients Say', 'omniworks-clone'); ?></h2>
                <p data-aos="fade-up" data-aos-delay="100"><?php _e('Testimonials from people we\'ve worked with', 'omniworks-clone'); ?></p>
            </div>
            
            <div class="testimonial-slider" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"The team at Omniworks understood our requirements perfectly and delivered a solution that exceeded our expectations. Their technical expertise and professionalism made the entire process smooth."</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>John Doe</h4>
                        <p>CEO, Example Company</p>
                    </div>
                </div>
                
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Working with Omniworks was a game-changer for our business. They took our outdated platform and transformed it into a modern, user-friendly system that has significantly improved our efficiency."</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>Jane Smith</h4>
                        <p>CTO, Another Example</p>
                    </div>
                </div>
                
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"I was impressed by how quickly Omniworks grasped our complex business requirements and delivered a solution that perfectly fit our needs. Their ongoing support has been exceptional."</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>Robert Johnson</h4>
                        <p>Operations Manager, Third Example</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    // Contact Section
    echo do_shortcode('[omniworks_contact title="Get in Touch" subtitle="Let\'s discuss your project"]');
    ?>
</main><!-- #main -->

<?php
get_footer();
