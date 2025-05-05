<?php get_header(); ?>



<main class="l-main">
    <div class="p-card">
        <div class="c-inner p-card__inner"></div>
        <h2 class="p-card__title">ダミーサイト</h2>
    </div>

    <div class="c-container p-food-choices__wrapper">
        <div class="c-inner p-food-choices--top">
            <div class="c-container p-food-choices__block">
                <h3 class="p-food-choices__title">Take Out</h3>
                <div class="p-food-choices__textbox-wrapper">
                    <div class="c-container p-textbox__block">
                        <div class="p-textbox">
                            <h4 class="p-textbox__title">Take Out</h4>
                            <?php if (get_field('takeout_text', 15)) : ?>
                                <p class="p-textbox__text">
                                    <?php the_field('takeout_text', 15); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="p-textbox">
                            <h4 class="p-textbox__title">Take Out</h4>
                            <?php if (get_field('takeout_text', 15)) : ?>
                                <p class="p-textbox__text">
                                    <?php the_field('takeout_text', 15); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-inner p-food-choices--bottom">
            <div class="c-container p-food-choices__block">
                <h3 class="p-food-choices__title">Eat In</h3>
                <div class="p-food-choices__textbox-wrapper">
                    <div class="c-container p-textbox__block">
                        <div class="p-textbox">
                            <h4 class="p-textbox__title">Eat In</h4>
                            <?php if (get_field('eatin_text', 15)) : ?>
                                <p class="p-textbox__text">
                                    <?php the_field('eatin_text', 15); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="p-textbox">
                            <h4 class="p-textbox__title">Eat In</h4>
                            <?php if (get_field('eatin_text', 15)) : ?>
                                <p class="p-textbox__text">
                                    <?php the_field('eatin_text', 15); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<section class="c-container p-location">
    <?php if (get_field('location_map', 61)) : ?>
        <div class="p-location__map">
            <?php
            $map_iframe = get_field('location_map', 61);
            $map_iframe = str_replace('<iframe', '<iframe class="p-location__iframe"', $map_iframe);
            echo $map_iframe;
            ?>
        </div>
    <?php endif; ?>
    <div class="c-inner p-location__inner">
        <div class="p-location__content">
            <?php if (get_field('location_title', 61)) : ?>
                <h5 class="p-location__title"><?php the_field('location_title', 61); ?></h5>
            <?php endif; ?>
            <?php if (get_field('location_text', 61)) : ?>
                <p class="p-location__text">
                    <?php the_field('location_text', 61); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
</article>

<?php get_sidebar(); ?>

<?php get_footer(); ?>