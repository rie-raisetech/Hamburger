<aside class="l-sidebar js-sidebar">
    <div class="l-sidebar__icon"></div>
    <div class="l-sidebar__close js-close"></div>
    <nav class="p-menu">
        <button class="c-button p-menu__button">
            <span>Menu</span>
        </button>
        <div class="p-menu__block">
            <?php
            if (has_nav_menu('menu_category')) {
                wp_nav_menu(array(
                    'theme_location' => 'menu_category',
                    'walker' => new Custom_Menu_Walker(),
                    'container' => false,
                    'fallback_cb' => false
                ));
            }
            ?>
        </div>
    </nav>
</aside>
<div class="js-overlay"></div>
</div>