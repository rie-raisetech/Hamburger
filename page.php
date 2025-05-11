<?php get_header(); ?>

<main class="l-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article <?php post_class(); ?>>
                <div class="p-card p-card--single">
                    <?php
                    $image_url = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'full')
                        : get_template_directory_uri() . '/images/page2.jpg';
                    ?>
                    <div class="c-inner p-card__inner p-card__inner--page" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                        <h1 class="p-card__title"><?php echo esc_html(get_the_title()); ?></h1>
                    </div>
                </div>
                <div class="p-content">
                    <?php echo wp_kses_post(get_the_content()); ?>
                </div>
                <?php
                if (is_single() && strpos(get_the_content(), '<!--nextpage-->') !== false) {
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'hamburger'),
                        'after'  => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ));
                }
                ?>
        <?php endwhile;
    endif; ?>

</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>