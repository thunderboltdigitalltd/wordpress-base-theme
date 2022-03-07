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
