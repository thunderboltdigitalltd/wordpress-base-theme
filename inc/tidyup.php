<?php

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
