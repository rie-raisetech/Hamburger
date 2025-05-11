<?php get_header(); ?>

<main class="l-main">
    <div class="p-card p-card--archive">
        <div class="c-inner p-card__inner p-card__inner--archive"></div>
        <div class="c-container p-card__block">
            <h2 class="p-card__title p-card__title--archive">Tag:</h2>
            <small class="p-card__sub"><?php echo esc_html(single_tag_title('', false)); ?></small>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <figure class="c-container p-archive__box">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full') ?: get_template_directory_uri() . '/images/no_image.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="c-image p-archive__image">
                <figcaption class="c-container p-archive__textbox">
                    <h4 class="p-archive__heading"><?php the_title(); ?></h4>
                    <h5 class="p-archive__subheading"><?php the_field('subheading'); ?></h5>
                    <div class="p-archive__text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 60, '_')); ?></div>
                    <a href="<?php the_permalink(); ?>" class="c-flex p-archive__link">詳しく見る</a>
                </figcaption>
            </figure>
        <?php endwhile; ?>

        <?php if (function_exists('wp_pagenavi')) : ?>
            <?php wp_pagenavi(); ?>
        <?php endif; ?>

    <?php else : ?>
        <p class="p-content__none">このタグに該当する投稿はありません。</p>
    <?php endif; ?>
</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>