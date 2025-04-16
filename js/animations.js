/**
 * File animations.js.
 *
 * Handles animations and enhanced visual effects for the theme.
 */
(function($) {
    'use strict';
    
    // Initialize AOS (Animate On Scroll) library
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 50
    });
    
    // Refresh AOS on window resize
    $(window).on('resize', function() {
        AOS.refresh();
    });
    
    // Add fade-in animation to elements
    $('.fade-in').each(function() {
        $(this).addClass('animated');
    });
    
    // Initialize counter animations
    $('.counter').each(function() {
        var $this = $(this);
        var countTo = $this.attr('data-count');
        
        $({ countNum: 0 }).animate(
            {
                countNum: countTo
            },
            {
                duration: 2000,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            }
        );
    });
    
    // Parallax effect for hero section
    $(window).on('scroll', function() {
        var scrollPosition = $(this).scrollTop();
        
        if ($('.hero-section').length) {
            $('.hero-section').css({
                'background-position': 'center ' + (scrollPosition * 0.2) + 'px'
            });
        }
    });
    
    // Services hover effect
    $('.service-card').on('mouseenter', function() {
        $(this).addClass('hover');
    }).on('mouseleave', function() {
        $(this).removeClass('hover');
    });
    
    // Team member bio expand on mobile
    if ($(window).width() < 768) {
        $('.team-member-card').on('click', function() {
            $(this).toggleClass('expanded');
        });
    }
    
    // Filter for case studies
    $('.case-study-filter li').on('click', function() {
        var filterValue = $(this).attr('data-filter');
        
        // Active class
        $('.case-study-filter li').removeClass('active');
        $(this).addClass('active');
        
        if (filterValue === '*') {
            $('.case-study-card').show();
        } else {
            $('.case-study-card').hide();
            $('.case-study-card' + filterValue).show();
        }
        
        // Refresh AOS
        setTimeout(function() {
            AOS.refresh();
        }, 300);
    });
    
    // Search form toggle
    $('.search-toggle').on('click', function(e) {
        e.preventDefault();
        $('.search-form-container').toggleClass('active');
        
        if ($('.search-form-container').hasClass('active')) {
            setTimeout(function() {
                $('.search-form-container input[type="search"]').focus();
            }, 300);
        }
    });
    
    // Close search form on ESC key
    $(document).on('keyup', function(e) {
        if (e.keyCode === 27 && $('.search-form-container').hasClass('active')) {
            $('.search-form-container').removeClass('active');
        }
    });
    
    // Testimonial slider
    if ($('.testimonial-slider').length) {
        $('.testimonial-slider').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 5000
        });
    }
    
    // Portfolio gallery
    if ($('.case-study-gallery').length) {
        $('.case-study-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                titleSrc: 'title'
            }
        });
    }
    
    // Back to top button
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 200) {
            $('.back-to-top').addClass('visible');
        } else {
            $('.back-to-top').removeClass('visible');
        }
    });
    
    $('.back-to-top').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });
    
})(jQuery);
