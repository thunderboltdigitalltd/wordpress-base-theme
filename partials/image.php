<?php
$image = $args['image'];
$size = $args['size'] ?? 'full';
$attributes = $args['attributes'] ?? [];

if (!empty($image)) {
    echo wp_get_attachment_image($image['id'], $size, false , $attributes);
}
