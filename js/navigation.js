/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function($) {
    'use strict';
    
    // Toggle mobile menu
    $('.menu-toggle').on('click', function() {
        var isExpanded = $(this).attr('aria-expanded') === 'true';
        
        $(this).attr('aria-expanded', !isExpanded);
        
        if (isExpanded) {
            $('.primary-menu').slideUp(200);
        } else {
            $('.primary-menu').slideDown(200);
        }
    });
    
    // Header scroll effect
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });
    
    // Add dropdown toggles for mobile menu
    $('.primary-menu .menu-item-has-children > a').append('<span class="dropdown-toggle" tabindex="-1"><i class="fas fa-chevron-down"></i></span>');
    
    // Show/hide dropdowns on mobile
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var $parent = $(this).closest('li');
        $parent.toggleClass('toggled-on');
        
        if ($parent.hasClass('toggled-on')) {
            $parent.children('.sub-menu').slideDown(200);
            $(this).html('<i class="fas fa-chevron-up"></i>');
        } else {
            $parent.children('.sub-menu').slideUp(200);
            $(this).html('<i class="fas fa-chevron-down"></i>');
        }
    });
    
    // Handle keyboard navigation
    $('.primary-menu li > a').on('keydown', function(e) {
        const $this = $(this);
        const $parent = $this.parent('li');
        const isMenu = $parent.hasClass('menu-item-has-children');
        
        // Space key opens sub-menu if this is a dropdown menu item
        if (isMenu && e.keyCode === 32) {
            e.preventDefault();
            $parent.children('.dropdown-toggle').click();
        }
        
        // DOWN key
        if (e.keyCode === 40) {
            e.preventDefault();
            
            // If menu is open, focus first sub-menu item
            if (isMenu && $parent.hasClass('toggled-on')) {
                $parent.find('.sub-menu li:first-child > a').focus();
            } 
            // Otherwise focus next menu item
            else {
                $parent.next('li').children('a').focus();
            }
        }
        
        // UP key
        if (e.keyCode === 38) {
            e.preventDefault();
            
            // If this is in a sub-menu, and it's the first item, focus the parent menu item
            if ($parent.parent().hasClass('sub-menu') && $parent.is(':first-child')) {
                $parent.parent().siblings('a').focus();
            } 
            // Otherwise, focus the previous menu item
            else {
                $parent.prev('li').children('a').focus();
            }
        }
        
        // LEFT key (closes sub-menu)
        if (e.keyCode === 37 && $parent.parent().hasClass('sub-menu')) {
            e.preventDefault();
            $parent.parent().siblings('a').focus();
            if ($(window).width() < 768) {
                $parent.parent().slideUp(200);
                $parent.parent().parent('li').removeClass('toggled-on');
                $parent.parent().siblings('.dropdown-toggle').html('<i class="fas fa-chevron-down"></i>');
            }
        }
        
        // RIGHT key (opens sub-menu)
        if (e.keyCode === 39 && isMenu) {
            e.preventDefault();
            $parent.children('.dropdown-toggle').click();
            setTimeout(function() {
                $parent.find('.sub-menu li:first-child > a').focus();
            }, 200);
        }
        
        // ESC key (closes sub-menu)
        if (e.keyCode === 27 && $parent.parent().hasClass('sub-menu')) {
            e.preventDefault();
            $parent.parent().siblings('a').focus();
            if ($(window).width() < 768) {
                $parent.parent().slideUp(200);
                $parent.parent().parent('li').removeClass('toggled-on');
                $parent.parent().siblings('.dropdown-toggle').html('<i class="fas fa-chevron-down"></i>');
            }
        }
    });
    
    // Close menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.main-navigation').length && $('.menu-toggle').attr('aria-expanded') === 'true') {
            $('.menu-toggle').click();
        }
    });
    
    // Smooth scroll for anchor links
    $('a[href*="#"]:not([href="#"])').on('click', function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
                
                return false;
            }
        }
    });
    
    // Function to set the submenu alignment to prevent overflow
    function setSubmenuAlignment() {
        $('.primary-menu > li > .sub-menu').each(function() {
            var windowWidth = $(window).width();
            var submenuWidth = $(this).outerWidth();
            var submenuOffset = $(this).offset().left;
            
            if (submenuOffset + submenuWidth > windowWidth) {
                $(this).css('left', 'auto');
                $(this).css('right', '0');
            } else {
                $(this).css('left', '0');
                $(this).css('right', 'auto');
            }
        });
    }
    
    // Call setSubmenuAlignment on page load and window resize
    $(window).on('load resize', function() {
        setSubmenuAlignment();
    });
    
    // Accessibility improvements
    $('.primary-menu, .primary-menu .sub-menu').attr('aria-label', 'Main Navigation');
    
    // Append screen reader description to mobile menu toggle
    $('.menu-toggle').attr('aria-label', 'Toggle Navigation Menu');
    
    // Make menu items with submenus more accessible
    $('.menu-item-has-children > a').each(function() {
        var $this = $(this);
        var menuText = $this.text();
        
        // Add a screen reader text to indicate this item has a submenu
        $this.append('<span class="screen-reader-text"> (has submenu)</span>');
        
        // Add aria-haspopup attribute
        $this.attr('aria-haspopup', 'true');
        
        // Add aria-expanded attribute (default to false)
        $this.attr('aria-expanded', 'false');
        
        // Update aria-expanded when toggling the menu
        $this.next('.dropdown-toggle').on('click', function() {
            var isExpanded = $this.attr('aria-expanded') === 'true';
            $this.attr('aria-expanded', !isExpanded);
        });
    });
    
    // Add support for fixed header on scroll
    $(window).on('scroll', function() {
        var scrollTop = $(window).scrollTop();
        
        if (scrollTop > 200) {
            $('.site-header').addClass('fixed-header');
            $('body').addClass('has-fixed-header');
        } else {
            $('.site-header').removeClass('fixed-header');
            $('body').removeClass('has-fixed-header');
        }
    });
    
    // Initialize mobile menu state
    $(window).on('load resize', function() {
        if ($(window).width() > 768) {
            $('.primary-menu').show();
            $('.menu-toggle').attr('aria-expanded', 'true');
        } else {
            $('.primary-menu').hide();
            $('.menu-toggle').attr('aria-expanded', 'false');
        }
    });
    
})(jQuery);
