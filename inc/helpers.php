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
