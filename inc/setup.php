<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'fonts',
        'https://fonts.bunny.net/css?family=Montserrat:wght@500&family=Red+Hat+Display:wght@400;700&display=swap',
        [],
        null
    );

//    if (get_option('options_map_api_key')) {
//        wp_register_script('maps',
//            'https://maps.googleapis.com/maps/api/js?key='.get_option('options_map_api_key').'&callback=initMap&libraries=&v=weekly');
//        wp_script_add_data('maps', 'defer', true);
//    }
}, 100);

add_action('after_setup_theme', function () {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support(
        'custom-logo',
        [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]
    );
    if (
        class_exists('WooCommerce')
        && in_array('woocommerce', (array)get_option('active_plugins', []), true)
    ) {
        add_theme_support('woocommerce');
    }
}, 20);

add_action('after_setup_theme', function () {
    register_nav_menus([
        'main-menu' => __('Main Menu', ''),
        'mobile-menu' => __('Mobile Menu', ''),
        'footer-menu' => __('Footer Menu', ''),
        'legal-menu' => __('Legal Menu', ''),
    ]);
}, 20);

add_action('init', function () {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
});

add_action('widgets_init', function () {
    //
});
