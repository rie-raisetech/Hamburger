<?php get_header(); ?>

<main class="l-main">
    <div class="p-card p-card--archive">
        <div class="c-inner p-card__inner p-card__inner--archive"></div>
        <div class="c-container p-card__block">
            <h2 class="p-card__title p-card__title--archive">Search:</h2>
            <small class="p-card__sub">
                <?php echo esc_html(get_search_query()); ?>
            </small>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <?php
        // 「search」というスラッグの固定ページからカスタムフィールド取得
        $search_page = get_page_by_path('search');
        if ($search_page) {
            $about_title = get_field('search_title', $search_page->ID);
            $about_text  = get_field('search_text', $search_page->ID);
            if ($about_title || $about_text) : ?>
                <div class="c-container p-about">
                    <?php if ($about_title) : ?>
                        <h3 class="p-about__title"><?php echo esc_html($about_title); ?></h3>
                    <?php endif; ?>
                    <?php if ($about_text) : ?>
                        <p class="p-about__text p-about__text--search"><?php echo esc_html($about_text); ?></p>
                    <?php endif; ?>
                </div>
        <?php endif;
        }
        ?>

        <p class="p-search__results">
            検索結果：<?php echo esc_html($wp_query->found_posts); ?>件
        </p>

        <?php while (have_posts()) : the_post(); ?>
            <figure class="c-container p-archive__box">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full') ?: get_template_directory_uri() . '/images/no_image.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="c-image p-archive__image">
                <figcaption class="c-container p-archive__textbox">
                    <h4 class="p-archive__heading"><?php echo esc_html(get_the_title()); ?></h4>
                    <h5 class="p-archive__subheading"><?php echo esc_html(get_field('subheading')); ?></h5>
                    <div class="p-archive__text"><?php echo wp_trim_words(get_the_excerpt(), 60, '_'); ?></div>
                    <a href="<?php the_permalink(); ?>" class="c-flex p-archive__link">詳しく見る</a>
                </figcaption>
            </figure>
        <?php endwhile; ?>

        <?php if (function_exists('wp_pagenavi')) : ?>
            <?php wp_pagenavi(); ?>
        <?php endif; ?>

    <?php else : ?>
        <p class="p-search__results">検索結果:</p>
        <p class="p-search__contents">「<?php echo esc_html(get_search_query()); ?>」に一致する情報は見つかりませんでした。</p>
    <?php endif; ?>
</main>

</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>