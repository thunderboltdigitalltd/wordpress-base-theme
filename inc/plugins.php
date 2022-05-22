<?php

add_action('tgmpa_register', function () {
    $plugins = [
        [
            'name' => 'Advanced Custom Fields PRO',
            'slug' => 'advanced-custom-fields-pro',
//            'source' => get_template_directory().'/plugins/advanced-custom-fields-pro.zip',
            'source' => 'https://drive.google.com/uc?export=download&id=1IezoC6bNRszYfmLRqDd5sKTGEiSKqTHR',
            'required' => true,
            'force_activation' => true,
        ],
        [
            'name' => 'EWWW Image Optimizer',
            'slug' => 'ewww-image-optimizer',
            'required' => true,
            'force_activation' => true,
        ],
        [
            'name' => 'WP Rocket',
            'slug' => 'wp-rocket',
//            'source' => get_template_directory().'/plugins/wp-rocket_3.10.8.zip',
            'source' => 'https://drive.google.com/uc?export=download&id=1pIvQFKjoWKlwHxG84C3yEnPh-lQfPyMR',
            'required' => true,
        ],
        [
            'name' => 'Yoast SEO',
            'slug' => 'wordpress-seo',
//            'required' => true,
        ],
        [
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
//            'required' => true,
        ],
        [
            'name' => 'Redirection',
            'slug' => 'redirection',
//            'required' => true,
        ],
        [
            'name' => 'Query Monitor',
            'slug' => 'query-monitor',
//            'required' => true,
        ],
        [
            'name' => 'iThemes Security',
            'slug' => 'better-wp-security',
//            'required' => true,
        ],
        [
            'name' => 'ManageWP Worker',
            'slug' => 'worker',
//            'required' => true,
        ],
    ];

    $config = [
        'id' => 'tb',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => 'themes.php',
        'capability' => 'edit_theme_options',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
    ];

    tgmpa($plugins, $config);
});
