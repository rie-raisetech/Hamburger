<footer class="l-footer">
  <div class="c-inner p-footer__inner">
    <div class="c-container p-footer__block">
      <?php
      $page = get_page_by_path('footer');
      $post_id = $page->ID;
      $link1 = get_field('footer_information', $post_id);
      $link2 = get_field('footer_information2', $post_id);
      ?>
      <p class="p-footer__information">
        <?php if ($link1): ?>
          <a href="<?php echo esc_url($link1['url']); ?>"
            class="p-footer__information--link"
            <?php if (!empty($link1['target'])) echo 'target="' . esc_attr($link1['target']) . '"'; ?>>
            <?php echo esc_html($link1['title']); ?>
          </a>
        <?php endif; ?>

        <?php if ($link1 && $link2): ?><?php echo esc_html('｜'); ?><?php endif; ?>
        <?php if ($link2): ?>
          <a href="<?php echo esc_url($link2['url']); ?>" class="p-footer__information--link" <?php if ($link2['target']) echo 'target="' . esc_attr($link2['target']) . '"'; ?>>
            <?php echo esc_html($link2['title']); ?>
          </a>
        <?php endif; ?>
      </p>
      <small class="p-footer__copy">Copyright: RaiseTech</small>
    </div>
  </div>

</footer>

</body>
<?php wp_footer(); ?>

</html>