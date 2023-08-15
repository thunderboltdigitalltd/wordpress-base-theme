<?php

namespace TB\StageSwitcher;

class StageSwitcher
{
    private array $stages;

    public function __construct()
    {
        add_action('admin_bar_menu', [$this, 'admin_bar_stage_switcher']);
        add_action('wp_before_admin_bar_render', [$this, 'admin_css']);
    }

    public function admin_bar_stage_switcher($admin_bar)
    {
        if (!defined('ENVIRONMENTS') || !defined('WP_ENV')) {
            return;
        }

        $this->stages = maybe_unserialize(ENVIRONMENTS);
        $subdomain_multisite = is_multisite() && is_subdomain_install();

        $admin_bar->add_menu([
            'id' => 'environment',
            'parent' => 'top-secondary',
            'title' => ucwords(WP_ENV),
            'href' => '#',
            'meta' => [
                'class' => 'environment-' . sanitize_html_class(strtolower(WP_ENV)),
            ],
        ]);

        foreach ($this->stages as $stage => $url) {
            if ($stage === WP_ENV) {
                continue;
            }

            if ($subdomain_multisite) {
                $url = $this->multisite_url($url);
            }

            $url = apply_filters('stage_switcher_url', rtrim($url, '/') . $_SERVER['REQUEST_URI'], $url, $stage);

            $admin_bar->add_menu([
                'id' => "stage_$stage",
                'parent' => 'environment',
                'title' => ucwords($stage),
                'href' => $url,
                'meta' => [
                    'class' => 'environment-' . sanitize_html_class(strtolower($stage)),
                ]
            ]);
        }
    }

    public function admin_css()
    {
        ?>
        <style>
            #wpadminbar #wp-admin-bar-environment > .ab-item:before {
                content: "\f177";
                top: 2px;
            }
        </style>
        <?php
    }

    private function multisite_url($url) {
        // Normalize URL to ensure it can be successfully parsed
        $url = esc_url($url);

        $current_host = wp_parse_url(get_home_url(get_current_blog_id()), PHP_URL_HOST);
        $current_stage_host_suffix = wp_parse_url($this->stages[WP_ENV], PHP_URL_HOST);
        $target_stage_host_suffix = wp_parse_url($url, PHP_URL_HOST);

        // Using preg_replace to anchor to the end of the host string
        $target_host = preg_replace('/' . preg_quote($current_stage_host_suffix) . '$/', $target_stage_host_suffix, $current_host);

        // Use the stage URL as the base for replacement to keep scheme/port
        return str_replace($target_stage_host_suffix, $target_host, $url);
    }
}
