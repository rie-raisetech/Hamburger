<form class="p-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" name="s" class="p-search__input" placeholder="検索ワードを入力" value="<?php echo esc_html(get_search_query()); ?>" id="s">
    <input type="hidden" name="post_type" value="hamburger">
    <button type="submit" class="p-search__button">検索</button>
</form>