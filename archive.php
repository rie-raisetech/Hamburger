<?php get_header(); ?>

<main class="l-main">

    <?php
    $term = get_queried_object();
    if (is_category() || is_tax()) {
        if ($term && !is_wp_error($term)) {
            $about_title = get_field('about_title', $term);
            $about_text  = get_field('about_text', $term);
            if ($about_title || $about_text) : ?>
                <div class="c-container p-about">
                    <?php if ($about_title) : ?>
                        <h3 class="p-about__title"><?php echo esc_html($about_title); ?></h3>
                    <?php endif; ?>
                    <?php if ($about_text) : ?>
                        <p class="p-about__text"><?php echo esc_html($about_text); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif;
        }
    } elseif (is_post_type_archive('hamburger')) {
        $about_title = get_field('about_title', '$page_id');
        $about_text  = get_field('about_text', '$page_id');
        if ($about_title || $about_text) : ?>
            <div class="c-container p-about">
                <?php if ($about_title) : ?>
                    <h3 class="p-about__title"><?php echo esc_html($about_title); ?></h3>
                <?php endif; ?>
                <?php if ($about_text) : ?>
                    <p class="p-about__text"><?php echo esc_html($about_text); ?></p>
                <?php endif; ?>
            </div>
    <?php endif;
    }
    ?>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <figure class="c-container p-archive__box">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full') ?: get_template_directory_uri() . '/images/no_image.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="c-image p-archive__image">
                <figcaption class="c-container p-archive__textbox">
                    <h4 class="p-archive__heading"><?php echo esc_html(get_the_title()); ?></h4>
                    <h5 class="p-archive__subheading"><?php echo esc_html(get_field('subheading')); ?></h5>
                    <div class="p-archive__text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 60, '…')); ?></div>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="c-flex p-archive__link">詳しく見る</a>
                </figcaption>
            </figure>
        <?php endwhile; ?>

        <?php if (function_exists('wp_pagenavi')) : ?>
            <?php wp_pagenavi(); ?>
        <?php else : ?>
            <?php the_posts_pagination(); ?>
        <?php endif; ?>
    <?php else : ?>
        <p class="p-content__none">投稿はありません。</p>
    <?php endif; ?>

</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>