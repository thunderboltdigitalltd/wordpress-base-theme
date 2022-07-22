<?php

namespace TB;

use Exception;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Vite
{
    public function __invoke(string|array $entrypoints, string $buildDirectory = 'public/build'): HtmlString
    {
        static $manifests = [];

        $entrypoints = collect($entrypoints);
        $buildDirectory = Str::start($buildDirectory, '/');

        if (is_file(get_stylesheet_directory().'/public/hot')) {
            $url = rtrim(file_get_contents(get_stylesheet_directory().'/public/hot'));

            return new HtmlString(
                $entrypoints
                    ->map(fn ($entrypoint) => $this->makeTag("{$url}/{$entrypoint}"))
                    ->prepend($this->makeScriptTag("{$url}/@vite/client"))
                    ->join('')
            );
        }

        $manifestPath = get_stylesheet_directory().$buildDirectory.'/manifest.json';

        if (! isset($manifests[$manifestPath])) {
            if (! is_file($manifestPath)) {
                throw new Exception("Vite manifest not found at: {$manifestPath}");
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        $tags = collect();

        foreach ($entrypoints as $entrypoint) {
            if (! isset($manifest[$entrypoint])) {
                throw new Exception("Unable to locate file in Vite manifest: {$entrypoint}.");
            }

            $tags->push($this->makeTag(get_stylesheet_directory_uri()."{$buildDirectory}/{$manifest[$entrypoint]['file']}"));

            if (isset($manifest[$entrypoint]['css'])) {
                foreach ($manifest[$entrypoint]['css'] as $css) {
                    $tags->push($this->makeStylesheetTag(get_stylesheet_directory_uri()."{$buildDirectory}/{$css}"));
                }
            }

            if (isset($manifest[$entrypoint]['imports'])) {
                foreach ($manifest[$entrypoint]['imports'] as $import) {
                    if (isset($manifest[$import]['css'])) {
                        foreach ($manifest[$import]['css'] as $css) {
                            $tags->push($this->makeStylesheetTag(get_stylesheet_directory_uri()."{$buildDirectory}/{$css}"));
                        }
                    }
                }
            }
        }

        [$stylesheets, $scripts] = $tags->partition(fn ($tag) => str_starts_with($tag, '<link'));

        return new HtmlString($stylesheets->join('').$scripts->join(''));
    }

    protected function makeTag(string $url): string
    {
        if ($this->isCssPath($url)) {
            return $this->makeStylesheetTag($url);
        }

        return $this->makeScriptTag($url);
    }

    protected function makeScriptTag(string $url): string
    {
        return sprintf('<script type="module" src="%s"></script>', $url);
    }

    protected function makeStylesheetTag(string $url): string
    {
        return sprintf('<link rel="stylesheet" href="%s" />', $url);
    }

    protected function isCssPath(string $path): bool
    {
        return preg_match('/\.(css|less|sass|scss|styl|stylus|pcss|postcss)$/', $path) === 1;
    }
}
