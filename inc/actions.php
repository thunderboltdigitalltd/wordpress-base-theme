<?php

add_action('acfe/init', function () {
    if (wp_get_environment_type() !== 'production') {
        acfe_update_setting('dev', true);
    }
    acfe_update_setting('modules/post_types', false);
});
