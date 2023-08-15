<?php

function disable_feeds(): void
{
    wp_redirect(home_url());
    exit;
}

// Disable feeds.
add_action('do_feed', 'disable_feeds', 1);
add_action('do_feed_rdf', 'disable_feeds', 1);
add_action('do_feed_rss', 'disable_feeds', 1);
add_action('do_feed_rss2', 'disable_feeds', 1);
add_action('do_feed_atom', 'disable_feeds', 1);
add_action('do_feed_rss2_comments', 'disable_feeds', 1);
add_action('do_feed_atom_comments', 'disable_feeds', 1);

// Disable comments.
add_filter('comments_open', '__return_false');

// Remove language dropdown on login screen.
add_filter('login_display_language_dropdown', '__return_false');

// Disable XML RPC for security.
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', '__return_false');

// Remove WordPress version.
remove_action('wp_head', 'wp_generator');

// Remove generated icons.
remove_action('wp_head', 'wp_site_icon', 99);

// Remove shortlink tag from <head>.
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

// Remove shortlink tag from HTML headers.
remove_action('template_redirect', 'wp_shortlink_header', 11);

// Remove Really Simple Discovery link.
remove_action('wp_head', 'rsd_link');

// Remove RSS feed links.
remove_action('wp_head', 'feed_links', 2);

// Remove all extra RSS feed links.
remove_action('wp_head', 'feed_links_extra', 3);

// Remove wlwmanifest.xml.
remove_action('wp_head', 'wlwmanifest_link');

// Remove meta rel=dns-prefetch href=//s.w.org
remove_action('wp_head', 'wp_resource_hints', 2);

// Remove relational links for the posts.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

// Remove REST API link tag from <head>.
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Remove REST API link tag from HTML headers.
remove_action('template_redirect', 'rest_output_link_header', 11);

// Remove emojis.
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// Remove oEmbeds.
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');

// Disable default users API endpoints for security.
// https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username/
add_filter('rest_endpoints', function (array $endpoints): array {
    if (!is_user_logged_in()) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }

        if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        }
    }

    return $endpoints;
});

// Remove JPEG compression.
add_filter('jpeg_quality', function (): int {
    return 100;
});

// Update login page image link URL.
add_filter('login_headerurl', function (): string {
    return home_url();
});

// Update login page link title.
add_filter('login_headertext', function (): string {
    return get_bloginfo('name');
});

add_action('wp_enqueue_scripts', function (): void {
    // Remove Gutenberg's front-end block styles.
    wp_deregister_style('wp-block-library');
    wp_dequeue_style('wp-block-library');
    // Remove Gutenberg's global styles.
    wp_dequeue_style('global-styles');
    // Remove classic theme styles.
    wp_dequeue_style('classic-theme-styles');
});

// Discourage search engines from indexing in non-production environments.
add_action('pre_option_blog_public', function (): bool {
    return wp_get_environment_type() === 'production';
});

//add_action('footer', function () {
//    wp_deregister_script('wp-embed');
//});

