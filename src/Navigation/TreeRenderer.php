<?php

namespace TB\Navigation;

class TreeRenderer
{
    private $navigation;

    public function __construct($navigation)
    {
        $this->navigation = $navigation;
    }

    public function render(): array
    {
        return $this->renderSections($this->navigation->children);
    }

    private function renderSections(array $sections): array
    {
        return array_map(function ($section) {
            return [
                'url' => $section->url,
                'title' => $section->title,
                'attributes' => $section->attributes,
                'children' => $this->renderSections($section->children),
                'depth' => $section->getDepth(),
            ];
        }, $sections);
    }
}
