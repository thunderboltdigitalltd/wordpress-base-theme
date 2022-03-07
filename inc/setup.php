<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Red+Hat+Display:wght@400;700&display=swap',
        [],
        null
    );
    wp_enqueue_style('style', get_stylesheet_directory_uri().'/public/css/front.css', [], null);

//    if (get_option('options_map_api_key')) {
//        wp_register_script('maps',
//            'https://maps.googleapis.com/maps/api/js?key='.get_option('options_map_api_key').'&callback=initMap&libraries=&v=weekly');
//        wp_script_add_data('maps', 'defer', true);
//    }

    wp_enqueue_script('vendor', get_stylesheet_directory_uri().'/public/js/vendor.js', [], null, true);
    wp_script_add_data('vendor', 'async', true);
    wp_enqueue_script('script', get_stylesheet_directory_uri().'/public/js/front.js', ['vendor'], null, true);
    wp_script_add_data('script', 'async', true);
    wp_add_inline_script('vendor', file_get_contents(get_stylesheet_directory().'/public/js/manifest.js'), 'before');
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
}, 20);

add_action('after_setup_theme', function () {
    register_nav_menus([
        'main-menu' => __('Main Menu', ''),
        'mobile-menu' => __('Mobile Menu', ''),
        'footer-menu' => __('Footer Menu', ''),
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

add_action('wp_resource_hints', function (array $urls): array {
    for ($i = 0, $iMax = count($urls); $i < $iMax; $i++) {
        // Removes <link rel="dns-prefetch" href="//s.w.org"> which is
        // preloaded for emojis...
        if (strpos($urls[$i], 'emoji') !== false) {
            unset($urls[$i]);
            break;
        }
    }

    return $urls;
});

add_action('footer', function () {
    wp_deregister_script('wp-embed');
});

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
