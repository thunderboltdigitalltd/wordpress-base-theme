<?php get_header(); ?>

    <main class="pt-[56px]">
        <?php if (has_flexible('component')) : ?>
            <?php the_flexible('component'); ?>
        <?php endif; ?>
    </main>

<?php get_footer();
