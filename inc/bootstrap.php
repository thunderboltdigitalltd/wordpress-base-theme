<?php

use TB\StageSwitcher\StageSwitcher;

require_once wp_normalize_path(get_template_directory() . '/inc/setup.php');
require_once wp_normalize_path(get_template_directory() . '/inc/filters.php');
require_once wp_normalize_path(get_template_directory() . '/inc/actions.php');
require_once wp_normalize_path(get_template_directory() . '/inc/tidyup.php');

if (is_admin()) {
    require_once wp_normalize_path(get_template_directory() . '/inc/TGMPA/class-foundation-tgm-plugin-activation.php');
    require_once wp_normalize_path(get_template_directory() . '/inc/TGMPA/plugins.php');

    require_once wp_normalize_path(get_template_directory() . '/inc/options-page.php');
}

new StageSwitcher;
