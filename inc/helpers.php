<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\VarDumper\VarDumper;

if (! function_exists('collect')) {
    function collect(array $items = []): Collection
    {
        return Collection::make($items);
    }
}

if (! function_exists('dd')) {
    function dd(...$args): void
    {
        dump(...$args);

        exit(1);
    }
}

if (! function_exists('dump')) {
    function dump(...$args): void
    {
        VarDumper::dump(...$args);
    }
}

if (!function_exists('get_color')) {
    function get_color($color, $type): string
    {
        return match($color) {
            'primary' => $type === 'bg' ? 'bg-primary' : 'text-primary',
            'secondary' => $type === 'bg' ? 'bg-secondary' : 'text-secondary',
            'tertiary' => $type === 'bg' ? 'bg-tertiary' : 'text-tertiary',
            'white' => $type === 'bg' ? 'bg-white' : 'text-white',
            'grey' => $type === 'bg' ? 'bg-grey' : 'text-grey',
            'black' => $type === 'bg' ? 'bg-black' : 'text-black',
            default => $type === 'bg' ? 'bg-['.$color.']' : 'text-['.$color.']',
        };
    }
}

if (!function_exists('get_partial')) {
    function get_partial($name, $args = []): void
    {
        get_template_part('partials/'.$name, false, $args);
    }
}

if (! function_exists('get_setting')) {
    function get_setting(string $option): mixed
    {
        if (function_exists('get_field')) {
            return get_field($option, 'option');
        }

        return null;
    }
}

if (! function_exists('now')) {
    function now(): Carbon
    {
        return Carbon::now();
    }
}

if (! function_exists('today')) {
    function today($tz = null): Carbon
    {
        return Carbon::today($tz);
    }
}

if (! function_exists('vite')) {
    function vite($entrypoints) {
        return (new \TB\Vite)($entrypoints);
    }
}
