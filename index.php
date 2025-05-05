<?php get_header(); ?>

<main class="l-main">
    <div class="l-inner">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div>
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p class="p-404__message">投稿が見つかりませんでした。</p>
        <?php endif; ?>
    </div>

</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>