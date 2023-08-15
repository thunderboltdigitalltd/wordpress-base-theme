<?php

add_filter('wpseo_metabox_prio', '__return_false');
add_filter('feed_links_show_comments_feed', '__return_false');
add_filter('show_recent_comments_widget_style', '__return_false');

add_filter('tiny_mce_plugins', function (array $plugins): array {
    return array_diff(
        $plugins,
        ['wpemoji']
    );
});

add_filter('acf/settings/show_admin', function ($show) {
    return current_user_can('manage_options');
});

add_filter('acfe/flexible/thumbnail', function ($thumbnail, $field, $layout) {
    if (file_exists(
        get_stylesheet_directory() . '/assets/images/components/' . str_replace('_', '-', $layout['name']) . '.png'
    )) {
        return get_stylesheet_directory_uri() . '/assets/images/components/' . str_replace('_', '-', $layout['name']) . '.png';
    }

    return $thumbnail;
}, 10, 3);

add_filter('copyright_text', function ($text) {
    return str_replace(['{year}', '{site_name}'], [get_the_date('Y'), get_bloginfo('site_name')], $text);
});
