<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.bunny.net">

    <?= vite(['assets/css/front.css', 'assets/js/front.js']) ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(['overflow-x-hidden', 'font-sans', env('WP_ENV') === 'local' ? 'debug-screens' : '']) ?>>
<div x-data x-cloak class="overflow-x-hidden">
    <nav x-data="{ mobileNavOpen: false }" class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <?php if ($mobileLogo = get_field('mobile_logo', 'options')) : ?>
                            <img class="block lg:hidden h-8 w-auto" src="<?= $mobileLogo['url'] ?>" alt="<?= $mobileLogo['alt'] ?>">
                        <?php endif; ?>
                        <?php if ($logo = get_field('logo', 'options')) : ?>
                            <img class="hidden lg:block h-8 w-auto" src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>">
                        <?php endif; ?>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex">
                        <?php wp_nav_menu([
                            'theme_location' => 'main-menu',
                            'menu_class' => 'sm:flex sm:space-x-8',
                            'menu_id' => '',
                            'container' => false,
                            'container_class' => 'menu',
                            'container_id' => ''
                        ]) ?>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" @click="mobileNavOpen = !mobileNavOpen" aria-expanded="false" x-bind:aria-expanded="mobileNavOpen.toString()">
                        <span class="sr-only">Open main menu</span>
                        <svg x-description="Icon when menu is closed.
Heroicon name: outline/menu" x-state:on="Menu open" x-state:off="Menu closed" class="h-6 w-6 block" :class="{ 'hidden': mobileNavOpen, 'block': !(mobileNavOpen) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-description="Icon when menu is open.
Heroicon name: outline/x" x-state:on="Menu open" x-state:off="Menu closed" class="h-6 w-6 hidden" :class="{ 'block': mobileNavOpen, 'hidden': !(mobileNavOpen) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-description="Mobile menu, show/hide based on menu state." class="sm:hidden" id="mobile-menu" x-show="mobileNavOpen">
            <div class="pt-2 pb-3 space-y-1">
                <?php wp_nav_menu([
                    'theme_location' => 'mobile-menu',
                    'menu_class' => 'space-y-1',
                    'menu_id' => '',
                    'container' => false,
                    'container_class' => '',
                    'container_id' => ''
                ]) ?>
            </div>
        </div>
    </nav>
