<?php get_header(); ?>

<main class="l-main">

    <div class="p-card p-card--archive">
        <div class="c-inner p-card__inner p-card__inner--archive"></div>
        <div class="c-container p-card__block">
            <h2 class="p-card__title p-card__title--archive">Menu:</h2>
            <?php if (single_cat_title('', false)) : ?>
                <small class="p-card__sub"><?php echo esc_html(single_cat_title('', false)); ?></small>
            <?php endif; ?>
        </div>
    </div>

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

        $args = [
            'post_type' => 'hamburger',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $term->slug,
                ],
            ],
            'posts_per_page' => 10,
            'paged' => get_query_var('paged', 1),
        ];
    } elseif (is_post_type_archive('hamburger')) {

        $about_title = get_field('about_title', 'option');
        $about_text  = get_field('about_text', 'option');

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

        $args = [
            'post_type' => 'hamburger',
            'posts_per_page' => 3,
            'paged' => get_query_var('paged', 1),
        ];
    }


    if (!empty($args)) :
        $custom_query = new WP_Query($args);

        if ($custom_query->have_posts()) :
            while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                <figure class="c-container p-archive__box">
                    <img src="<?php echo get_the_post_thumbnail_url(null, 'full') ? get_the_post_thumbnail_url(null, 'full') : get_template_directory_uri() . '/images/no_image.jpg'; ?>" alt="<?php the_title(); ?>" class="c-image p-archive__image">
                    <figcaption class="c-container p-archive__textbox">
                        <h4 class="p-archive__heading"><?php the_title(); ?></h4>
                        <h5 class="p-archive__subheading"><?php the_field('subheading'); ?></h5>

                        <div class="p-archive__text"><?php echo wp_trim_words(get_the_excerpt(), 60, '_'); ?></div>
                        <a href="<?php the_permalink(); ?>" class="c-flex p-archive__link">詳しく見る</a>
                    </figcaption>
                </figure>
            <?php endwhile; ?>

            <!-- ページネーションの表示 -->
            <?php if (function_exists('wp_pagenavi')) : ?>
                <?php wp_pagenavi(array('query' => $custom_query)); ?>
            <?php endif; ?>

    <?php endif;
        wp_reset_postdata();
    endif;
    ?>





</main>
</article>

<?php get_sidebar(); ?>

<?php get_footer(); ?>