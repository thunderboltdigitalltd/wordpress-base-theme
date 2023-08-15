<?php
$button = $args['button'];
$type = $args['type'] ?? 'link';
$color = $args['color'] ?? 'primary';
$attributes = $args['attributes'] ?? [];

$colorClasses = match ($color) {
    'primary' => 'text-grey border-grey hover:bg-primary hover:text-white hover:border-primary',
    'secondary' => 'text-grey border-grey hover:bg-secondary hover:text-white hover:border-secondary',
};

$classes = 'text-[17px] font-semibold px-[20px] py-[11px] lg:px-[33px] lg:py-[12px] transition';

if (!empty($button['link'])) :
    if ($type === 'button') : ?>
        <button
            class="inline-block bg-transparent transition border <?= $colorClasses ?> <?= $classes ?>" <?= implode('', $attributes) ?>>
            <?= !empty($button['link']['title']) ? $button['link']['title'] : $button['link']['name'] ?>
        </button>
    <?php else : ?>
        <a class="inline-block bg-transparent transition border <?= $colorClasses ?> <?= $classes ?>"
           href="<?= $button['link']['url'] ?>" <?= implode('', $attributes) ?>>
            <?= !empty($button['link']['title']) ? $button['link']['title'] : $button['link']['name'] ?>
        </a>
    <?php endif;
endif;
