<?php

namespace TB\Navigation;

class Navigation implements Node
{
    /** @var Section[] */
    public array $children;

    public array $menuItems;

    public function __construct()
    {
        $this->children = [];
    }

    public static function make(): static
    {
        return new static;
    }

    public function for(string $location): self
    {
        $locations = get_nav_menu_locations();
        $menu = null;
        if (isset($locations[$location])) {
            $menu = wp_get_nav_menu_object($locations[$location]);
        }
        $this->menuItems = [];
        if ($menu) {
            $this->menuItems = wp_get_nav_menu_items($menu->term_id, ['update_post_term_cache' => false]);
        }

        $sortedMenuItems = [];
//        $menuItemsWithChildren = [];
        foreach ((array)$this->menuItems as $menuItem) {
            if ((string)$menuItem->ID === (string)$menuItem->menu_item_parent) {
                $menuItem->menu_item_parent = 0;
            }

            $sortedMenuItems[$menuItem->menu_order] = $menuItem;
//            if ($menuItem->menu_item_parent) {
//                $menuItemsWithChildren[$menuItem->menu_item_parent] = true;
//            }
        }

        $top_level_elements = array();
        $children_elements = array();
        foreach ($sortedMenuItems as $e) {
            if (empty($e->menu_item_parent)) {
                $top_level_elements[] = $e;
            } else {
                $children_elements[$e->menu_item_parent][] = $e;
            }
        }

        foreach ($top_level_elements as $element) {
            $this->add($element->title, $element-> url, function (Section $section) use ($children_elements, $element) {
                $this->addSection($section, $element, $children_elements);
            }, [
                'classes' => $element->classes,
                'columns' => get_field('number_of_columns', $element->db_id),
                'images' => get_field('image_block', $element->db_id),
            ]);
        }

        return $this;
    }

    private function addSection($section, $element, $children): void
    {
        if (isset($children[$element->db_id])) {
            foreach ($children[$element->db_id] as $child) {
                $section->add($child->title, $child->url, function (Section $section) use ($child, $children) {
                    $this->addSection($section, $child, $children);
                }, [
                    'classes' => $child->classes,
                    'column' => get_field('column', $child->db_id),
                ]);
            }
        }
    }

    public function add(string $title = '', string $url = '', ?callable $configure = null, ?array $attributes = null): self
    {
        $section = new Section($this, $title, $url);

        if ($configure) {
            $configure($section);
        }

        if ($attributes) {
            $section->attributes($attributes);
        }

        $this->children[] = $section;

        return $this;
    }

    public function filter(callable $callback): array
    {
        return $this->filterSections($this->children, $callback);
    }

    private function filterSections(array $sections, callable $callback): array
    {
        $filtered = [];

        foreach ($sections as $section) {
            if ($callback($section)) {
                $filtered[] = $section;
            }

            foreach ($this->filterSections($section->children, $callback) as $innerSection) {
                $filtered[] = $innerSection;
            }
        }

        return $filtered;
    }

    public function tree(): array
    {
        return (new TreeRenderer($this))->render();
    }

    public function getParent(): ?Node
    {
        return null;
    }

    /** @return Node[] */
    public function getParents(): array
    {
        return [];
    }
}
