<?php get_header(); ?>

<main class="l-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article <?php post_class(); ?>>
                <div class="p-card p-card--single">
                    <?php
                    $image_url = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'full')
                        : get_template_directory_uri() . '/images/single2.jpg';
                    ?>
                    <div class="c-inner p-card__inner p-card__inner--single" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                        <h1 class="p-card__title"><?php the_title(); ?></h1>
                    </div>
                </div>

                <div class="p-content">
                    <?php the_content(); ?>
                </div>

        <?php endwhile;
    endif; ?>
</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>