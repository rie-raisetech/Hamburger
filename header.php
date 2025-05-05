<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ハンバーガーショップ">

    <?php wp_head(); ?>

</head>

<body>
    <div class="c-layout">

        <article class="c-layout__main">
            <header class="l-header">
                <div class="l-header__contents">
                    <button class="c-button p-header__button js-hamburger">
                        <span>Menu</span>
                    </button>
                    <h1 class="p-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>

                    <?php get_search_form(); ?>
                </div>
            </header>